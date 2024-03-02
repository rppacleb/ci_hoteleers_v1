<?php

namespace App\Controllers;
use App\Models\User_vw_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class User_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new User_vw_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'user';
		$this->session 			= session();
		$this->permission 		= array();
    }

    public function index($type,$id){

    	$request 	= $this->request->getVar();
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			if(!isset($request['employer'])){
  				return redirect()->to(base_url('home/'));
  			}//end if

  			//check access
	    	$permission_param 	= array(
	    		"permission_user_type" 		=> $this->session->get('usertype'),
				"permission_record_type" 	=> $this->record_type
	    	);
	    	$this->permission 				= $this->model->get_permission($permission_param);

	    	if($this->permission['num_rows'] > 0){
	    		$access = json_decode($this->permission["data"][0]["permission"]);
				if(!in_array($type ,$access )){
					return redirect()->to(base_url('home/'));
				    //throw new \Exception("You do not have permission to perform this action!");
				}//end if
	    	}//end if
	    	
			//check access


  			//get status
  			$res 	= $this->model->get_master_data('status');
  			$param 	= array();
  			if($res['num_rows'] > 0){
  				$param['status'] = $res['data'];
  			}//end if

  			//get employer
  			$res 	= $this->model->get_employer($request);
  			$param 	= array();
  			if($res['num_rows'] > 0){
  				$param['employer'] = $res['data'];
  			}//end if


  			$param['country_dial_code'] = $this->lib->get_country_code();
  			$param['id'] 				= $id;
  			$param['type'] 				= $type;
    	
  			
			return view('User_vw/index',$param);
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
			$request 		= $this->request->getVar();
    		$param 			= [];

    		
    		//pagination
    		$res 			= $this->model->load_data($id,$request);
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

    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();

    	
    	
    	$rules = [
            "header.honorifics" => [
                "label" => "honorifics", 
                "rules" => "trim|required|max_length[5]",
                'errors' => [
	                'required' => 'Please input honorifics.',
	            ]
            ],
            "header.first_name" => [
                "label" => "first name", 
                "rules" => "trim|required|max_length[100]",
                'errors' => [
	                'required' => 'Please input first name.',
	            ]
            ],
            "header.last_name" => [
                "label" => "last name", 
                "rules" => "trim|required|max_length[100]",
                'errors' => [
	                'required' => 'Please input last name.',
	            ]
            ],
            "header.email_add" => [
                "label" => "email address", 
                "rules" => "trim|required|valid_email|max_length[100]",
                'errors' => [
	                'required' => 'Please input email address.',
	            ]
            ],
            "header.designation" => [
                "label" => "designation", 
                "rules" => "trim|required|max_length[100]",
                'errors' => [
	                'required' => 'Please input designation.',
	            ]
            ],
            "header.contact_number" => [
                "label" => "contact number", 
                //"rules" => "trim|required|mobileValidation[header.contact_number]",
				"rules" => "trim|required|min_length[8]",
                'errors' => [
                	'required' => 'Please input contact number.',
	                'mobileValidation' => 'Incorrect contact number.',
	            ]
            ]
        ];

        if ($this->validate($rules)){
			try{
				


				define('DS', DIRECTORY_SEPARATOR);
				$send_email 					= false;
				$data['response'] 				= array();
				$data['table_name'] 			= 'ousr';
				$data['table_name_lines'] 		= '';
				$data['record_header'] 			= $param['header'];
				$data['record_profile'] 		= $param['header'];
				$data['record_lines'] 			= array();
				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();


				//check access
				$type = "";
				if($data['record_header']["id"] > 0){
					$type = "edit";
				}else{
					$type = "add";
				}//end if
				$permission_param 	= array(
		    		"permission_user_type" 		=> $this->session->get('usertype'),
					"permission_record_type" 	=> $this->record_type
		    	);

				$this->permission 		= $this->model->get_permission($permission_param);
				if($this->permission['num_rows'] > 0){
		    		$access = json_decode($this->permission["data"][0]["permission"]);
					if(!in_array($type ,$access )){
						throw new \Exception("You do not have permission to perform this action.");
					}//end if
		    	}else{
		    		throw new \Exception("You do not have permission to perform this action.");
		    	}//end if
				//end check access

				

				
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['email_add'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "username";
				$data["dup_table"] 	= "ousr";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['username'].".");
				}//end if
				//check duplicate
				//end check duplicate

				//set full name and username
					$data['record_header']['name'] 		= $data['record_header']['first_name'] . " " . $data['record_header']['last_name'];
					$data['record_header']['username'] 	= $data['record_header']['email_add'];
					$data['record_header']['user_type'] = 'employer';
					//throw new \Exception($data['record_header']['password']);
				//end set


				
				//unset not needed
				unset($data['record_profile']['employer']);
				unset($data['record_profile']['password']);
				//end unset not needed

				//unset not needed
				unset($data['record_header']['honorifics']);
				//unset($data['record_header']['email_add']);
				unset($data['record_header']['first_name']);
				unset($data['record_header']['last_name']);
				unset($data['record_header']['designation']);
				unset($data['record_header']['dial_code']);
				unset($data['record_header']['contact_number']);
				//end unset not needed
			
				
				if($data['record_header']["id"] > 0){
					//update record
					//--------------------------------------------------------------------------------------------------
					

					//Set Audit Trail
					$header_keys 	= array_keys($data['record_header']);
					$audit_res 			= $this->audit_trail->get_current_header_record($data['record_header']['id'],$data['table_name']);
					for ($i = 0; $i <= count($header_keys) - 1; $i++) {
						if($data['record_header'][$header_keys[$i]] != $audit_res[0][$header_keys[$i]]){
							$data['audit'][] = array(
								'user_id' 	  				=> $this->session->get('userid'),
								'action' 					=> 'updated',
								'record_id' 				=> $data['record_header']['id'],
								'record_type' 				=> $this->record_type,
								'record_field' 				=> $header_keys[$i],
								'record_field_old_value' 	=> $audit_res[0][$header_keys[$i]],
								'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
							);
						}//End if
					}//End for
					//End Set Audit Trail

					//Set Audit Trail
					$header_keys 	= array_keys($data['record_profile']);
					$audit_res 			= $this->audit_trail->get_current_header_record($data['record_profile']['id'],'oprofile');
					for ($i = 0; $i <= count($header_keys) - 1; $i++) {
						if($data['record_profile'][$header_keys[$i]] != $audit_res[0][$header_keys[$i]]){
							$data['audit'][] = array(
								'user_id' 	  				=> $this->session->get('userid'),
								'action' 					=> 'updated',
								'record_id' 				=> $data['record_profile']['id'],
								'record_type' 				=> 'profile',
								'record_field' 				=> $header_keys[$i],
								'record_field_old_value' 	=> $audit_res[0][$header_keys[$i]],
								'record_field_new_value' 	=> $data['record_profile'][$header_keys[$i]]
							);
						}//End if
					}//End for
					//End Set Audit Trail

					

					

					//update record
					$res 		= $this->model->update_record($data);		

					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					$data['response'] = array(
						'id' => $res['data']['id'],
						'employer' => $data['record_header']['employer']
					);

					//--------------------------------------------------------------------------------------------------
					//end update record
				}else{

					$data['record_header']['password'] = $this->lib->random_password2();
					$send_email = true;
					//add record
					//--------------------------------------------------------------------------------------------------

					//throw new \Exception(json_encode($data['record_profile']));
					

					//update record
					$res 		= $this->model->add_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					
					$data['response'] = array(
						'id' => $res['data']['id'],
						'employer' => $data['record_header']['employer']
					);

					//set Audit Trail
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> $this->record_type
					);
					//End Audit Trail

					if($res['data']['profile_id'] > 0){
						$data['audit'][] = array(
							'record_id' 		=> $res['data']['profile_id'],
							'user_id' 	  		=> $this->session->get('userid'),
							'action' 			=> 'created',
							'record_type' 		=> 'profile'
						);
					}//end if
					//--------------------------------------------------------------------------------------------------
					//end add record
				}//end if


				//Insert Audit Trail header
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail header

				if($send_email){
					//send email
					$email = \Config\Services::email();
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo($data['record_profile']['email_add']);
					//$email->setCC('another@another-example.com');
					//$email->setBCC('them@their-example.com');
					$email->setSubject($this->lib->notification_employer_subject);

					$email_param 							= array();
					$email_param['name'] 					= $data['record_profile']['first_name'].' '.$data['record_profile']['last_name'];
					$email_param['new_password'] 			= $data['record_header']['password'];
					$email_param['url'] 					= base_url('login');

					$email->setMessage($this->lib->change_password_template($email_param));
					$email->setMailType('html');


					if(!$email->send()){
						throw new \Exception("Email Failed.");
					}//end if
					//end send email
				}//end if
				


			

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

}//end class
