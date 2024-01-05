<?php

namespace App\Controllers;
use App\Models\Job_search_vw_model;
use App\Models\Home_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Job_search_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Job_search_vw_model();
		$this->home_model 		= new Home_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'job_post';
		$this->session 			= session();
		$this->permission 		= array();
    }

    

    public function index($mod_state,$type,$id){

    	
    
		//if(!$this->session->has('username')){
			//return redirect()->to(base_url('login/'));
  		//}else{



  			
  			$param['country_dial_code'] = $this->lib->get_country_code();
  			$param['id'] 				= $id;
  			$param['mod_state'] 		= $mod_state;
  			$param['type'] 				= $type;

  			//get perks and benefits
  			$request = array();
  			$request['table_name'] 		= 'operks_and_benefits';
  			$request['filter_field'] 		= 'inactive';
  			$request['filter_operator'] 	= '=';
  			$request['filter_value'] 		= 0;
  			$res 	= $this->model->get_master_data($request);
  			if($res['num_rows'] > 0){
  				$param['perks_and_benefits'] = $res['data'];
  			}//end if
  			//end get perks and benefits

  			//check if applied
  			$request = array();
  			$request['dup_table'] 			= 'job_post_applicant';
  			$request['dup_id'] 				= $id;
  			$request["dup_filter"] 			= "user_id";
  			$request["names"][] 			= $this->session->get('userid');
		
  			$request['filter_value'] 		= 0;
  			$res 	= $this->model->check_duplicate($request);
  			if($res['num_rows'] > 0){
  				$param['applied'] = 1;
  			}else{
  				$param['applied'] = 0;
  			}//end if
  			//end check if applied

  			//check if added to favorites
  			$request = array();
  			$request['dup_table'] 			= 'usr_job_post_fav';
  			$request['dup_id'] 				= $this->session->get('userid');
  			$request["dup_filter"] 			= "job_post";
  			$request["names"][] 			= $id;


  			$request['filter_value'] 		= 0;
  			$res 	= $this->model->check_duplicate($request);
  			if($res['num_rows'] > 0){
  				$param['favorites'] = 1;
  			}else{
  				$param['favorites'] = 0;
  			}//end if
  			//end check if added to favorites

  			//add job post view
  			$request = array();
  			$request['table_name'] 					= 'job_post_views';
  			$request['record_header']['id'] 		= $id;
  			$request['record_header']['points'] 	= 1;
  			$request['record_header']['user_id'] 	= $this->session->get('userid');
  			$res 	= $this->model->add_record($request);
  			if($res['success']){

  			}//end if
  			//end add job post view
    	
  			
			return view('Job_search_vw/index',$param);
  		//}//end if
        
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
    		$per_page 		= 8;
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

	public function load_data($id){
			
    		$param 			= [];

    		
    		//pagination
    		$res 			= $this->model->load_data($id);
    		if($res['num_rows'] > 0){
		    	$param["data"] 			= $res['data'];
		    	$param["num_rows"] 		= $res['num_rows'] ;
    		}else{
    			$param["data"] 			= null;
		    	$param["num_rows"] 		= 0;
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

	public function report_job_post(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();

    	$rules = [
            "header.comment" => [
                "label" => "comment", 
                "rules" => "trim|required|max_length[5000]",
                'errors' => [
	                'required' => 'Please input comment.',
	            ]
            ]
        ];

        if ($this->validate($rules)){
			try{
				$data['response'] 				= array();
				$data['table_name'] 			= 'job_post_report';
				$data['record_header'] 			= $param['header'];

			
				$data['record_header']['user_id'] 	= $this->session->get('userid');
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");
					
				}//end if

				
				
				

				

	
				//add record
				//--------------------------------------------------------------------------------------------------
				//update record
				$res 		= $this->model->add_record($data);		
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end add record

				

				
				$data['response'] = array(
					'id' => $data['record_header']['id']
				);

				//set Audit Trail
				$data['audit'][] = array(
					'record_id' 		=> $res['data']['id'],
					'user_id' 	  		=> $this->session->get('userid'),
					'action' 			=> 'created',
					'record_type' 		=> 'job_post_report'
				);
				//End Audit Trail
				//--------------------------------------------------------------------------------------------------
				//end add record
				
		


				//Insert Audit Trail header
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail header

				//get job post
	  			$request = array();
	  			$request['table_name'] 			= 'ojob_post';
	  			$request['filter_field'] 		= 'id';
	  			$request["filter_value"] 		= $data['record_header']['id'];
	  			$res 	= $this->model->get_job_post($request);
	  			
	  			if($res['num_rows'] > 0){
	  				$body = "Job Post ". $res['data'][0]['job_title'] . " on ". $res['data'][0]['company_name']." ";
	  				$body .= "has been reported by ".$this->session->get('name')." \n\n";
	  				$body .= "Comment\n";
	  				$body .= $data['record_header']['comment'];
	  				
	  				//send email
					$email = \Config\Services::email();
					//$email->setFrom('phoenixlangaman05@gmail.com', 'Phoenix Langaman');
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo('admin@hoteleers.com');
					//$email->setCC('another@another-example.com');
					//$email->setBCC('them@their-example.com');
					$email->setSubject('Hoteleers');
					$email->setMessage($body);
					if(!$email->send()){
						throw new \Exception("Email Failed.");
					}//end if
					//end send email

	  			}//end if
	  			//get job post

				
				
				

				

			

			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}
		

		echo json_encode($validator);
	
    }//end function

	public function add_fav(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{
				$data['response'] 				= array();
				$data['table_name'] 			= 'usr_job_post_fav';
				$data['record_header'] 			= array();
				$data['audit'] 				    = array();

				$data['record_header']['job_post'] 		= $param['header']['id'];
				$data['record_header']['id'] 	= $this->session->get('userid');
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");
					
				}//end if

				
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['job_post'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "job_post";
				$data["dup_table"] 	= "usr_job_post_fav";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					//delete record
					//--------------------------------------------------------------------------------------------------
					$res 		= $this->model->delete_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if

					
					$data['response'] = array(
						'id' => $data['record_header']['job_post']
					);

					//set Audit Trail
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'deleted',
						'record_type' 		=> 'favorites'
					);
					//End Audit Trail
					//--------------------------------------------------------------------------------------------------
					//end delete record
				}else{
					//add record
					//--------------------------------------------------------------------------------------------------
					$res 		= $this->model->add_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if

					
					$data['response'] = array(
						'id' => $data['record_header']['job_post']
					);

					//set Audit Trail
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'favorites'
					);
					//End Audit Trail
					//--------------------------------------------------------------------------------------------------
					//end add record
				}//end if
				//check duplicate
				//end check duplicate

				

	
					
				
		


				//Insert Audit Trail header
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail header

				

			

			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Saved Jobs");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

  

    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
		$redirect_url 		= base_url('applicant_info/edit/'.$this->session->get('userid'));
    	
    	
    	
			try{

				


				define('DS', DIRECTORY_SEPARATOR);
				$data['response'] 				= array();
				$data['table_name'] 			= 'job_post_applicant';
				$data['record_header'] 			= array();

				$data['record_header']['id'] 		= $param['header']['id'];
				$data['record_header']['user_id'] 	= $this->session->get('userid');
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");

				}//end if

				if(isset($param['notification_id'])){
					$data['record_notification'] = array();
					$data['record_notification']["id"] = $param['notification_id'];
					$data['record_notification']["status"] = 'accepted';
				}//end if

				

				$profile 				= array();
				$profile['user_id'] 	= $this->session->get('userid');
				$profile['profile'] 	= $this->home_model->get_profile($profile);

				

				$required_counter = 0;
				if($profile["profile"]['data']->first_name == "" || $profile["profile"]['data']->last_name == ""){
					$required_counter += 1;
					$redirect_url .= '?req_primary=1';
				}//end if

				
				/*if($profile["profile"]['data']->industry_count <= 0 || $profile["profile"]['data']->job_level_count <= 0 || $profile["profile"]['data']->job_type_count <= 0 || $profile["profile"]['data']->department_count <= 0 || $profile["profile"]['data']->education_count <= 0 || $profile["profile"]['data']->language_count <= 0){
					$required_counter += 1;
				}//end if
				*/

				if($profile["profile"]['data']->first_login){
					$required_counter += 1;
				}//end if

				if($profile["profile"]['data']->experience_count <= 0 
				&& $profile["profile"]['data']->education_count <= 0
				&& $profile["profile"]['data']->resume == ''){
					$required_counter += 1;
					$redirect_url .= '?req_job_application=1';
				}//end if

				//end check if already set the profile

				if($required_counter > 0){
					//return redirect()->to(base_url('applicant_info_login/edit/'.$profile['user_id']));
					
					//redirect to profile completion

					$validator['success'] 		= false;
					$validator['redirect'] 		= true;
					$validator['redirect_url'] 	= $redirect_url;
					
					$validator['messages'][] 	= array("success" => "Please complete profile");
				    $validator['data'] 			= $data['response']; 
				}else{
					//check duplicate
					$data["names"] 		= array();
					$data["names"][] 	= $data['record_header']['user_id'];
					$data["dup_id"] 	= $data['record_header']['id'];
					$data["dup_filter"] = "user_id";
					$data["dup_table"] 	= "job_post_applicant";
					$res 				= $this->model->check_duplicate($data);
					if($res['num_rows'] > 0){
						throw new \Exception("You have already submitted your application.");
					}//end if
					//check duplicate
					//end check duplicate

					

		
						//add record
						//--------------------------------------------------------------------------------------------------
						//update record
						$res 		= $this->model->add_record($data);		
						if(!$res['success']){
							throw new \Exception($res['message']);
						}//end if
						//end add record

						

						
						$data['response'] = array(
							'id' => $data['record_header']['id']
						);

						//set Audit Trail
						$data['audit'][] = array(
							'record_id' 		=> $res['data']['id'],
							'user_id' 	  		=> $this->session->get('userid'),
							'action' 			=> 'created',
							'record_type' 		=> 'job_post_applicant'
						);
						//End Audit Trail
						//--------------------------------------------------------------------------------------------------
						//end add record
					
			


					//Insert Audit Trail header
					if(count($data['audit']) > 0){
						$audit_res 			= $this->audit_trail->add($data);
						if(!$audit_res){
							throw new \Exception("Error on creating audit trail.");
						}//End if
					}//End if
					$data['audit']   = array();
					//End Insert Audit Trail header

					

				

				    $validator['success'] 		= true;
					$validator['messages'][] 	= array("success" => "Successfully completed.");
				    $validator['data'] 			= $data['response']; 
				}//end if
				

				
				
				 	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

}//end class
