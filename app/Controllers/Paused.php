<?php

namespace App\Controllers;
use App\Models\Paused_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Paused extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Paused_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'partner_application';
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
  			$param['country_dial_code'] = $this->lib->get_country_code();
  	
    	
  			
			return view('Paused/index',$param);
  		}//end if
        
    }//end function


    public function get_record($type){
		$data;
		$request 				= $this->request->getVar();
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

    public function logout(){

    	//audit trail
       	$data['audit']   = array();
		$data['audit'][] = array(
			'record_id' 		=> 0,
			'user_id' 	  		=> $this->session->get('userid'),
			'action' 			=> 'logged out',
			'record_type' 		=> $this->record_type
		);
		$aud 	= $this->audit_trail->add($data);
		if(!$aud){
			throw new \Exception('Error on creation of audit trail.');
		}//end if
       	//end audit trail

		unset($_SESSION['userid']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['usertype']);
		unset($_SESSION['name']);
    	//session_destroy();
    	return redirect()->to(base_url('Login/'));
    }

    
    //TODO
    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
    	
			try{
				
				//$row 					= $this->request->getVar('row');
				//$row_keys 			= array_keys($row);
				//$line_count			= count($row['line']);

				$data['table_name'] 	= 'osignup';
				$data['record_header'] 	= $param['header'];
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['username'];
				$data["dup_filter"] = "username";
				$data["dup_table"] 	= "ousr";
				$res 		= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['name'].".");
				}//end if
				//check duplicate
				//end check duplicate

				
				//Set Audit Trail
				$data['audit'] 	= array();
				$header_keys 	= array_keys($data['record_header']);
				$res 			= $this->audit_trail->get_current_header_record($data['record_header']['id'],$data['table_name']);
				for ($i = 0; $i <= count($header_keys) - 1; $i++) {
					if($data['record_header'][$header_keys[$i]] != $res[0][$header_keys[$i]]){
						$data['audit'][] = array(
							'user_id' 	  				=> $this->session->get('userid'),
							'action' 					=> 'updated',
							'record_id' 				=> $data['record_header']['id'],
							'record_type' 				=> $this->record_type,
							'record_field' 				=> $header_keys[$i],
							'record_field_old_value' 	=> $res[0][$header_keys[$i]],
							'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
						);
					}//End if
				}//End for
				//End Set Audit Trail

				//Insert Audit Trail
				if(count($data['audit']) > 0){
					$res 			= $this->audit_trail->add($data);
					if(!$res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail


				


				//create employer
				if($data['record_header']['status'] == 2){ //approved
					$data['employer'] 	= array();
					$data['employer'][] = "insert into oemployer(company_name,email,location,lat,lng,locality,administrative_area_level_1,country,industry,signup)
									   		select company_name,username,location,lat,lng,locality,administrative_area_level_1,country,industry,id
									   		from osignup where id = '".$data['record_header']['id']."'";
				

					

				}//end if
				//end create employer

				//update record
				$res 		= $this->model->update_record($data);		
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end add record

				//audit trail
				if($res['data']['employer_id'] > 0){
					$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['employer_id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'employer'
					);
				}//end if
		       	
		       	//end audit trail

				//Insert Audit Trail
				if(count($data['audit']) > 0){
					$res 			= $this->audit_trail->add($data);
					if(!$res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				//End Insert Audit Trail


				if($data['record_header']['status'] == 2){
					//send email
					$email = \Config\Services::email();
					//$email->setFrom('phoenixlangaman05@gmail.com', 'Phoenix Langaman');
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo($data['record_header']['username']);
					//$email->setCC('another@another-example.com');
					//$email->setBCC('them@their-example.com');
					$email->setSubject('Hoteleers');
					$email->setMessage("You have have been approved to continue \n
										Please provide the following : \n
										Prefix (Mr/Ms) \n
										Last Name \n
										First Name \n
										Title/Designation \n
										Email address \n
										Telephone number \n
										");
					if(!$email->send()){
						throw new \Exception("Email Failed.");
					}//end if
					//end send email
				}//end if


				
					


			    $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			       	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

}//end class
