<?php

namespace App\Controllers;
use App\Models\Job_post_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Job_post extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Job_post_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'job_post';
		$this->session 			= session();
    }

    public function index(){
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			//get status
  			$res 	= $this->model->get_master_data('status');
  			$param 	= array();
  			if($res['num_rows'] > 0){
  				$param['status'] = $res['data'];
  			}//end if

  			$param['employer_id'] 		= $this->session->get('employer');
  			$param['country_dial_code'] = $this->lib->get_country_code();
  	
    	
  			
			return view('Job_post/index',$param);
  		}//end if
        
    }//end function


    public function get_record($type){
		$data;
		$request 				= $this->request->getVar();
		$request["employer"] 	= $this->session->get('employer');
		$param 					= [];


		$param["request"] 		= json_encode($request);
		
		//pagination
		$res 			= $this->model->get_record($type,$request,null,null);
		if($res['num_rows'] > 0){
			$data 			= $res['data'];
    		$total_result 	= $res['num_rows'];
    		$page 			= (int)(($this->request->getVar('page')!==null && $this->request->getVar('page')!=0)?$this->request->getVar('page'):1)-1;
    		$per_page 		= 15;
	    	$offset 		= $page * $per_page;
	    	$total_page 	= ceil($total_result/$per_page);


	    	$res 					= $this->model->get_record($type,$request,$per_page,$offset);
	    	$param["data"] 			= $res['data'];
	    	$param["data_keys"] 	= array_keys($res['data'][0]);
	    	$param["total_page"] 	= $total_page;
	    	$param["total_result"] 	= $total_result;
	    	$param["per_page"] 		= $per_page;

		}else{
			$param["data"] 			= null;
	    	$param["total_page"] 	= 0;
	    	$param["total_result"] 		= 0;
		}//end if
		
    	echo json_encode($param);
    	//end pagination
    	
	}//end if

	

	public function get_master_data($type){
		$data;
		$param 			= [];
		//pagination
		$res 			= $this->model->get_master_data($type);
		if($res['num_rows'] > 0){
	    	$param["data"] 			= $res['data'];
	    	$param["num_rows"] 		= $res['num_rows'];
		}else{
			$param["data"] 			= null;
	    	$param["num_rows"] 		= 0;
		}//end if
		
    	echo json_encode($param);
    	//end pagination
	}//end function

    

    public function delete_data(){
    	$validator 	= [];
    	$param 		= $this->request->getVar();
    	
			try{

				$data 					= array();
				$header 				= $this->request->getVar();
				$data['table_name'] 	= 'ojob_post_template';
				$data['record_header'] 	= $header;
				$data['audit'] 					= array();
				//throw new \Exception(json_encode($data['record_header']));

				//check if already 48 hours posted to disable editing and deleting
				$expiration = $this->model->get_current_job_post($data);
				if(!$expiration["success"]){
					throw new \Exception($expiration["message"]);
				}//end if
				
				//check related records
				/*
				//signup
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "industry";
				$data["rr_table"] 				= "osignup";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end if
				*/

				

				//---------------------------------------update query---------------------------------------
				$data['for_update'] 		= array();										
				$data['for_update'][] 		= "UPDATE ".$data['table_name']." 
												SET remove_on = DATE_FORMAT((DATE_ADD(NOW(), INTERVAL 30 DAY)),'%m/%d/%Y %h:%i %p')
												WHERE id = '".$data['record_header']['id']."'";												
				//---------------------------------------update query---------------------------------------

				if($expiration["data"][0]['date_posted_diff'] > 2){
					/*//---------------------------------------Set Audit Trail---------------------------------------
					$header_keys 	= array_keys($data['record_header']);
					$audit_res 			= $this->audit_trail->get_current_header_record($data['record_header']['id'],$data['table_name']);
					for ($i = 0; $i <= count($header_keys) - 1; $i++) {
						if($data['record_header'][$header_keys[$i]] != $audit_res[0][$header_keys[$i]]){
							$data['audit'][] = array(
								'user_id' 	  				=> $this->session->get('userid'),
								'action' 					=> 'updated',
								'record_id' 				=> $data['record_header']['id'],
								'record_type' 				=> 'job_post',
								'record_field' 				=> $header_keys[$i],
								'record_field_old_value' 	=> $audit_res[0][$header_keys[$i]],
								'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
							);
						}//End if
					}//End for
					//---------------------------------------Set Audit Trail---------------------------------------
					$res 		= $this->model->update_record($data);
					*/

					//---------------------------------------collect audit trail---------------------------------------
					$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> $data['record_header']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'deleted',
						'record_type' 		=> $this->record_type
					);
					//---------------------------------------collect audit trail---------------------------------------

					$res 		= $this->model->delete_record($data);
				}else{

					//---------------------------------------collect audit trail---------------------------------------
					$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> $data['record_header']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'deleted',
						'record_type' 		=> $this->record_type
					);
					//---------------------------------------collect audit trail---------------------------------------

					$res 		= $this->model->delete_record($data);
				}//end if

				

		       	//---------------------------------------commit audit trail---------------------------------------
				$aud 	= $this->audit_trail->add($data);
				if(!$aud){
					throw new \Exception('Error on creation of audit trail.');
				}//end if
		       	//end audit trail
				//---------------------------------------commit audit trail---------------------------------------

		       	$validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			       	
			       	
				
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function


	public function pin_job_post(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{
				$data['response'] 					= array();
				$data['table_name'] 				= 'ojob_post_template';
				$data['record_header'] 				= array();

				$data['record_header']['id']  		= $param['header']['id'];
				$data['record_header']['pinned']  	= $param['header']['pinned'];
				//$data['record_header']['id'] 			= $this->session->get('userid');
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");
					
				}//end if

				
				
				
				
				//check duplicate
				/*
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['id'];
				$data["dup_filter"] = "id";
				$data["dup_table"] 	= "ojob_post";
				$res 				= $this->model->check_pinned($data);
				if($res['num_rows'] > 0){
					throw new \Exception("You have already pinned this job!");
				}//end if
				//check duplicate
				*/
				//end check duplicate

				

	
					//add record
					//--------------------------------------------------------------------------------------------------
					//update record
					$res 		= $this->model->update_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					

					
					$data['response'] = array(
						'id' => $data['record_header']['id']
					);

					//set Audit Trail
					/*
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'favorites'
					);
					*/
					//End Audit Trail
					//--------------------------------------------------------------------------------------------------
					//end add record
				
		


				//Insert Audit Trail header
				/*
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail!");
					}//End if
				}//End if
				$data['audit']   = array();
				*/
				//End Insert Audit Trail header

				

			

			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		echo json_encode($validator);
	
    }//end function

    
    

}//end class
