<?php

namespace App\Controllers;
use App\Models\Schedule_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Schedule extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Schedule_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'schedule';
		$this->session 			= session();
    }

    public function index(){
    		if(!$this->session->has('username')){
				return redirect()->to(base_url('login/'));
  			}//end if


  			//check access
	    	$permission_param 	= array(
	    		"permission_user_type" 		=> $this->session->get('usertype'),
				"permission_record_type" 	=> $this->record_type
	    	);
	    	$this->permission 				= $this->model->get_permission($permission_param);

	    	if($this->permission['num_rows'] > 0){
	    		$access = json_decode($this->permission["data"][0]["permission"]);
				if(!in_array('view' ,$access)){
					return redirect()->to(base_url('home/'));
				    //throw new \Exception("You do not have permission to perform this action!");
				}//end if
	    	}else{
	    		return redirect()->to(base_url('home/'));
	    	}//end if
	    	
			//check access

			
		
  			//get status
  			$res 	= $this->model->get_master_data('status');
  			$param 	= array();
  			if($res['num_rows'] > 0){
  				$param['status'] = $res['data'];
  			}//end if
  			$param['country_dial_code'] = $this->lib->get_country_code();
  			//$param['type'] 				= $type;
    	
  			
			return view('Schedule/index',$param);
  		
        
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


    public function add_fav(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{

				

				$data['response'] 				= array();
				$data['table_name'] 			= 'usr_job_post_fav';
				$data['record_header'] 			= array();

				$data['record_header']['job_post'] 		= $param['header']['id'];
				$data['record_header']['id'] 			= $this->session->get('userid');
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
					throw new \Exception("You have already added save this job!");
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
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function


    public function cancel_schedule(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{

				

				$data['response'] 				= array();
				$data['table_name'] 			= 'job_post_for_interview';
				$data['record_header'] 			= array();
				$data['audit'] 					= array();
				$data['record_header']['id'] 		= $param['header']['id'];	
				
				$data['record_header']['status'] = 'cancelled';


				//check status
				$data['names'][] 		=  $data['record_header']['id'];
				$data['dup_table'] 		= 'job_post_for_interview';
				$data['dup_filter'] 	= 'id';
				$status = $this->model->check_duplicate($data);
				
				if($status['num_rows'] > 0){
					

					if($status['data'][0]['status'] === 'cancelled' || $status['data'][0]['status'] === 'completed'){
						throw new \Exception("This schedule is already been ".$status['data'][0]['status'].".");
					}//end if
					
				}//end if
				//end check status


				

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
							'record_type' 				=> 'job_post',
							'record_field' 				=> $header_keys[$i],
							'record_field_old_value' 	=> $audit_res[0][$header_keys[$i]],
							'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
						);
					}//End if
				}//End for
				//End Set Audit Trail
				
				//update query

				
				$test = array();
				$test["job_post_id"] = $status['data'][0]['job_post_id'];
				$test["user_id"] = $status['data'][0]['user_id'];
				

				$offered_data = $this->model->check_hired_offered($test);

				
				

				$data['for_update'] 		= array();
				$data['for_update'][] 		= "DELETE FROM job_post_move_to 
												WHERE id = '".$status['data'][0]['job_post_id']."'
												AND user_id = '".$status['data'][0]['user_id']."'
												AND if_current = true
												AND status = 'for interview'";
				if($offered_data["data"][0]["id"] <= 0){
					$data['for_update'][] 		= "UPDATE job_post_move_to 
												SET if_current = true 
												WHERE id = '".$status['data'][0]['job_post_id']."' 
												AND user_id = '".$status['data'][0]['user_id']."'
												AND status = 'short listed'";
				}//end if
				

				//end update query
				
				$res 		= $this->model->update_record($data);		
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end add record

			
				
				$data['response'] = array(
					'id' => $data['record_header']['id']
				);

				
				//--------------------------------------------------------------------------------------------------
				//end update record


				//send email
				$message 					= "";
				$notes_to_interviewee 		= "";

				if($status['data'][0]['notes_to_interviewee'] !== ""){
					$notes_to_interviewee = "Remarks : ".$status['data'][0]['notes_to_interviewee'];
				}//end if
				if($status['data'][0]['interview_type'] == 'face_to_face'){
					$message = "Your interview for the ".$status['data'][0]['job_title']." role has been cancelled by the employer!";
				}else{
					$message = "Your interview for the ".$status['data'][0]['job_title']." role has been cancelled by the employer!";
					/*$message = "You have have been invited for an interview for the ".$param['placeholder']['job_title']." role\n
										Date : ".$data['record_header']['interview_date']."\n
										Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
										Link : ".$data['record_header']['virtual_interview_link']."\n";
					*/
				}//end if

				//$message .= $notes_to_interviewee;
				
				$email = \Config\Services::email();
				$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
				$email->setTo($status['data'][0]['email_add']);
				//$email->setSubject($status['data'][0]['company_name']);


				$email->setSubject($this->lib->job_interview_subject .' - CANCELLATION');
				$email_param = array();
				$email_param['url'] 					= base_url('login/');
				$email_param['job_board_url'] 			= base_url('job_search/private');
				$email_param['name'] 					= $status['data'][0]['name'];
				$email_param['company_name'] 			= $status['data'][0]['company_name'];

				$email->setMessage($this->lib->cancelled_job_interview_template($email_param));
				if(!$email->send()){
					$validator['messages'][] = "Email Failed.";
				}//end if
				//end send email
				
		


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
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

    
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
					$data['employer'][] = "insert into oemployer(company_name,location,lat,lng,locality,administrative_area_level_1,country,industry,signup)
									   		select company_name,location,lat,lng,locality,administrative_area_level_1,country,industry,id
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



				
					


			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			       	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

}//end class
