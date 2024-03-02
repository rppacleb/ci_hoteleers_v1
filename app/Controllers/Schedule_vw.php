<?php

namespace App\Controllers;
use App\Models\Schedule_vw_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Schedule_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Schedule_vw_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'schedule';
		$this->session 			= session();
		$this->permission 		= array();
    }

    public function index($type,$id){

    	
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{

  			//check access
	    	$permission_param 	= array(
	    		"permission_user_type" 		=> $this->session->get('usertype'),
				"permission_record_type" 	=> $this->record_type
	    	);
	    	$this->permission 				= $this->model->get_permission($permission_param);
	    	if($this->permission['num_rows'] > 0){
	    		$access = json_decode($this->permission["data"][0]["permission"]);
	    		$param['access'] = $access;
				if(!in_array($type ,$access)){
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
  			$param['id'] 				= $id;
  			$param['type'] 				= $type;
    	
  			
			return view('Schedule_vw/index',$param);
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
			$request 				= $this->request->getVar();
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

    		if($res['num_rows2'] > 0){
		    	$param["placeholder"] 	= $res['placeholder'];
		    	$param["num_rows2"] 	= $res['num_rows'] ;
    		}else{
    			$param["placeholder"] 	= null;
		    	$param["num_rows2"] 	= 0;
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


	//process invitation
	public function process_invitation(){
		$request = $this->request->getVar();
		$response = array(
			"success" 	=> false,
			"message" => ""
		);

		//$request["userid"] = $this->session->get('userid');
		try{

			$data['record_header'] = $request['header'];
			
			if($request['header']["status"] == 'accept'){
				$data['record_header']["status"] = 'accepted';
			}else{
				$data['record_header']["status"] = 'declined';
				
			}//end if

			

			//check if already processed
			$res = $this->model->get_invitation($data);

			if(!isset($res['data'])){
				throw new \Exception('No invitation to process.');
			}//end if

			
			
			if($res["data"][0]["status"] !== 'pending'){
				throw new \Exception("This invitation has already been ".$res["data"][0]["status"].".");
			}//end if
			//end
			

			//check if expired
			if($res["data"][0]["is_expired"] > 0){
				throw new \Exception("This invitation has already been expired.");
			}//end if
			
			$res = $this->model->process_invitation($data);		
			if(!$res['success']){
				throw new \Exception($res['message']);
			}//end if
			

			$response["success"] 	= true;
			$response["message"] 	= $res["message"];
		}catch (\Exception $e) {
			$response["success"] = false;
			$response["message"] = $e->getMessage();
			
		}//End try

		echo json_encode($response);
	}//end function
	//end process invitation

    public function do_upload(){
    	$retval 		= [];
		$response 		= [];
		try{	
			$allowed_ext 	= array('gif','GIF','png','PNG','jpg','JPG','jpeg','JPEG');


			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();

			if($this->request->getFileMultiple('header.userfile')) {
				foreach ($this->request->getFileMultiple('header.userfile') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					if($file_attr['file_size'] > 5){
						throw new \Exception('Max file size exceeded.');
					}//end if


					$file_content 	= file_get_contents($file);

					$data['file'][] = array(
						'file' 	  				=> base64_encode($file_content),
						'file_attr' 			=> $file_attr
					);

					//code for converting into actual file
					//define('DS', DIRECTORY_SEPARATOR);
					//$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $file->getName();
					//file_put_contents($tmp_path, $file_content);

				
				}//end foreach
			}else{
				throw new \Exception('No file to upload.');
			}//end if
			

			$response['success']  	= true;
			$response['data']  	= $data;

		}catch (\Exception $e) {
			$response['success'] 		= false;
			$response['messages'][] 	= array("exception" => $e->getMessage());
			
		}//End try
        echo json_encode($response);
    }//end do upload

    public function do_upload_multiple(){
    	$retval 					= [];
		$response 					= [];
		
		$param 						= $this->request->getVar();
		try{	
			$allowed_ext 			= array('gif','GIF','png','PNG','jpg','JPG','jpeg','JPEG');
			$total_uploaded_file 	= $param['file']['total_uploaded_file'] == ""? 0 : $param['file']['total_uploaded_file'];
			$total_files 			= $param['file']['total_files'] == ""? 0 : $param['file']['total_files'];
			
			
			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();
			
			
			
			if($this->request->getFileMultiple('header.company_file')) {
				$max_size 		= 40; //40MB
				$total_size 	= $total_uploaded_file;

				
				$line = 1;
				foreach ($this->request->getFileMultiple('header.company_file') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					

					$total_size += $file_attr['file_size'];
					$total_files += 1;

					$file_content 	= file_get_contents($file);

					$data['file'][] = array(
						'file' 	  				=> base64_encode($file_content),
						'file_attr' 			=> $file_attr
					);
					$line += 1;
				}//end foreach

				if($total_files > 8){
					throw new \Exception('Max of 8 files are allowed.');
				}//end if

				if($total_size > $max_size){
					throw new \Exception("Max file size of ".$max_size."MB exceeded.");
				}//end if
			}else{
				throw new \Exception('No file to upload.');
			}//end if
			

			$response['success']  	= true;
			$response['data']  	= $data;

		}catch (\Exception $e) {
			$response['success'] 		= false;
			$response['messages'][] 	= array("exception" => $e->getMessage());
			
		}//End try
        echo json_encode($response);
    }//end do upload

    
    //TODO
    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();

    	
    	
    	$rules = [
            "header.interview_date" => [
                "label" => "interview date", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input interview date.',
	            ]
            ],
            "header.interview_start_time" => [
                "label" => "start time", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input start time.',
	            ]
            ],
            "header.interview_end_time" => [
                "label" => "end time", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input end time.',
	            ]
            ],
            "placeholder.applicant_name" => [
                "label" => "applicant", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input applicant.',
	            ]
            ]
        ];

        if($param['header']['interview_type'] == 'face_to_face'){
			$rules['header.location'] = array(
				"label" => "location", 
	        	"rules" => "trim|required",
	        	'errors' => array(
	                'required' => 'Please input location.',
	            )
			);
        }else if($param['header']['interview_type'] == 'virtual'){
        	$rules['header.virtual_interview_link'] = array(
				"label" => "virtual interviewer link", 
	        	"rules" => "trim|required",
	        	'errors' => array(
	                'required' => 'Please input virtual interviewer link.',
	            )
			);
        }//end if

        if ($this->validate($rules)){
			try{

				


				
				
				$data['response'] 				= array();
				$data['table_name'] 			= 'job_post_for_interview';
				$data['record_header'] 			= $param['header'];
				$data['record_lines'] 			= array();
				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();
				$data['for_update'] 			= array();


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

		    	

				if($data['record_header']['interview_start_time'] !== "" && $data['record_header']['interview_start_time'] !== ""){
					if(strtotime($data['record_header']['interview_start_time']) >= strtotime($data['record_header']['interview_end_time'])){
						throw new \Exception("Start time must not beyond end or equal to end time.");
					}//end if
				}//end if


				$data["dup_table"] 	= "job_post_move_to";
				$data["dup_filter"] = "t0.id='".$data['record_header']['job_post_id']."' 
										AND t0.user_id = '".$data['record_header']['user_id']."' 
										AND t0.if_current = true";
				$res 				= $this->model->check_status($data);
				if($res['num_rows'] > 0){
					if($res['data'][0]['status'] == 'offered'){
						

						//if($data['record_header']['status'] == 'for interview'){
							$data['for_update'][] = "DELETE FROM job_post_move_to WHERE id = '".$data['record_header']['job_post_id']."'
										  AND user_id = '".$data['record_header']['user_id']."'
										  AND status IN('hired','offered')";
						//}//end if
					}//end if
				}else{

				}//end if
				
				
				
				$data['record_header']['created_by'] = $this->session->get('userid');

				$data['dup_table'] 		= 'job_post_for_interview';
				$data['dup_filter'] 	= "t0.id = ".$data['record_header']['id']." AND t0.status = 'pending'";
				$status 				= $this->model->check_status($data);
				
				
				
				if($param['placeholder']["type"] == 'edit'){
					//update record
					//--------------------------------------------------------------------------------------------------

					//Set Audit Trail
					$header_keys 	= array_keys($data['record_header']);
					$audit_res 		= $this->audit_trail->get_current_header_record($data['record_header']['id'],$data['table_name']);
					for ($i = 0; $i <= count($header_keys) - 1; $i++) {
						if($data['record_header'][$header_keys[$i]] != $audit_res[0][$header_keys[$i]]){
							$data['audit'][] = array(
								'user_id' 	  				=> $this->session->get('userid'),
								'action' 					=> 'updated',
								'record_id' 				=> $data['record_header']['id'],
								'record_type' 				=> 'job_post_for_interview',
								'record_field' 				=> $header_keys[$i],
								'record_field_old_value' 	=> $audit_res[0][$header_keys[$i]],
								'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
							);
						}//End if
					}//End for
					//End Set Audit Trail


					
					$data['for_update'][] = "UPDATE ".$data['table_name']." 
											 SET if_current = false 
											 WHERE id = '".$data['record_header']['id']."' 
											 AND user_id = '".$data['record_header']['user_id']."'";

					
					//update record
					$res 		= $this->model->update_record($data);		

					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					$data['response'] = array(
						'id' => $res['data']['id']
					);

					if($status['num_rows'] > 0){
						
					

						//send email
						$message 					= "";
						$notes_to_interviewee 		= "";

						if($data['record_header']['notes_to_interviewee'] !== ""){
							$notes_to_interviewee = "Remarks : ".$data['record_header']['notes_to_interviewee'];
						}//end if
						if($data['record_header']['interview_type'] == 'face_to_face'){
							$message = "Updated interview invitation for the ".$param['placeholder']['job_title']." role\n
												Date : ".$data['record_header']['interview_date']."\n
												Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
												Location : ".$data['record_header']['location']."\n";
						}else{
							$message = "Updated interview invitation for the ".$param['placeholder']['job_title']." role\n
												Date : ".$data['record_header']['interview_date']."\n
												Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
												Link : ".$data['record_header']['virtual_interview_link']."\n";
						}//end if

						$message .= $notes_to_interviewee;
						
						$email = \Config\Services::email();
						$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
						$email->setTo($param['placeholder']['applicant_email']);
						//$email->setSubject($param['placeholder']['company_name']);
						$email->setSubject($this->lib->job_interview_subject .' - CHANGES');

						$email_param = array();
						$email_param['url'] 					= base_url('login/');
						$email_param['interview_date'] 			= $data['record_header']['interview_date'];
						$email_param['start_time'] 				= $data['record_header']['interview_start_time'];
						$email_param['end_time'] 				= $data['record_header']['interview_end_time'];
						$email_param['name'] 					= $param['placeholder']['applicant_name'];
						$email_param['company_name'] 			= $param['placeholder']['company_name'];
						$email_param['applicant_name'] 			= $param['placeholder']['applicant_name'];
						$email_param['rec_email_address'] 		= $param['placeholder']['rec_email_add'];
						$email_param['applying_for'] 			= $param['placeholder']['job_title'];
						$email_param['interviewer_name'] 		= $data['record_header']['interviewer_name_position'];
						$email_param['interview_address'] 		= $data['record_header']['interview_type'];
						$email_param['interview_location'] 		= $data['record_header']['location'];
						$email_param['virtual_link'] 			= $data['record_header']['virtual_interview_link'];
						$email_param['notes_to_interviewee'] 	= $data['record_header']['notes_to_interviewee'];

						$email->setMessage($this->lib->edited_job_interview_template($email_param));
						$email->setMailType('html');
						//$email->setMessage($message);
						if(!$email->send()){
							$validator['messages'][] = "Email Failed!";
						}//end if
						//end send email
					}//end if

					//--------------------------------------------------------------------------------------------------
					//end update record
				}else{

					//check duplicate
					/*
					$data["dup_table"] 	= "job_post_for_interview";
					$data["dup_filter"] = "t0.id = '".$data['record_header']['id']."' AND t0.user_id = '".$data['record_header']['user_id']."'";
					$res 				= $this->model->check_duplicate($data);
					if($res['num_rows'] > 0){
						throw new \Exception("Duplicate schedule detected!");
					}//end if
					//check duplicate
					*/
					//end check duplicate

					$data['move_to'] = array(
						"id" 			=> $data['record_header']['job_post_id'],
						"user_id" 		=> $data['record_header']['user_id'],
						"status" 		=> "for interview",
						"if_current" 	=> true
					);
					//$data['for_update'] 	= array();
					$data['for_update'][] 	= "UPDATE job_post_move_to 
												SET if_current = false 
												WHERE id = '".$data['record_header']['job_post_id']."' 
												AND user_id = '".$data['record_header']['user_id']."'";


					//insert notification
					//for update
					//--------------------------------------------------------------------------------------------------
					$message 					= "";
					$notes_to_interviewee 		= "";
					if($data['record_header']['notes_to_interviewee'] !== ""){
						$notes_to_interviewee = "Remarks : ".$data['record_header']['notes_to_interviewee'];
					}//end if

					

					$date_str = date("F d, Y", strtotime($data['record_header']['interview_date']));
					
					

					if($data['record_header']['interview_type'] == 'face_to_face'){
						$message = "You have been invited for an interview for ".$param['placeholder']['job_title']."\n
											Date : ".$date_str."\n
											Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
											Location : ".$data['record_header']['location']."\n
											Please check your email for more details\n";
					}else{
						$message = "You have been invited for an interview for ".$param['placeholder']['job_title']."\n
											Date : ".$date_str."\n
											Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
											Link : ".$data['record_header']['virtual_interview_link']."\n
											Please check your email for more details\n";
					}//end if

					//--------------------------------get data for email--------------------------------
					$email_param = array();
					$email_param['url'] 					= base_url('login/');
					$email_param['interview_date'] 			= $data['record_header']['interview_date'];
					$email_param['start_time'] 				= $data['record_header']['interview_start_time'];
					$email_param['end_time'] 				= $data['record_header']['interview_end_time'];
					$email_param['name'] 					= $param['placeholder']['applicant_name'];
					$email_param['company_name'] 			= $param['placeholder']['company_name'];
					$email_param['applicant_name'] 			= $param['placeholder']['applicant_name'];
					$email_param['rec_email_address'] 		= $param['placeholder']['rec_email_add'];
					$email_param['applying_for'] 			= $param['placeholder']['job_title'];
					$email_param['interviewer_name'] 		= $data['record_header']['interviewer_name_position'];
					$email_param['interview_type'] 			= $data['record_header']['interview_type'];
					$email_param['interview_address'] 		= $data['record_header']['interview_type'];
					$email_param['interview_location'] 		= $data['record_header']['location'];
					$email_param['virtual_link'] 			= $data['record_header']['virtual_interview_link'];
					$email_param['notes_to_interviewee'] 	= $data['record_header']['notes_to_interviewee'];
					//--------------------------------get data for email--------------------------------
					
					$int_type = array(
						'face_to_face' => 'In Person',
						'virtual' => 'Virtual',
						'phone' => 'Phone'
					);
					$html = '';
					$html 	.= '<table class="table table-borderless">';
						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Interview Date</td>';
							$html 	.= '<td>'.$email_param['interview_date'].'</td>';
						$html 	.= '</tr>';
						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Start Time</td>';
							$html 	.= '<td>'.$email_param['start_time'].'</td>';
						$html 	.= '</tr>';

						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">End Time</td>';
							$html 	.= '<td>'.$email_param['end_time'].'</td>';
						$html 	.= '</tr>';

						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Applicant Name</td>';
							$html 	.= '<td>'.$email_param['applicant_name'].'</td>';
						$html 	.= '</tr>';
						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Recruiter Email Address</td>';
							$html 	.= '<td>'.$email_param['rec_email_address'].'</td>';
						$html 	.= '</tr>';
						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Applying for</td>';
							$html 	.= '<td>'.$email_param['applying_for'].'</td>';
						$html 	.= '</tr>';
						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Interviewer Name / Position</td>';
							$html 	.= '<td>'.$email_param['interviewer_name'].'</td>';
						$html 	.= '</tr>';

						$html 	.= '<tr>';
							$html 	.= '<td class="text-right">Interview Type</td>';
							$html 	.= '<td>'.$int_type[$email_param['interview_type']].'</td>';
						$html 	.= '</tr>';

						
						if($email_param['interview_type'] == "virtual"){
							$html 	.= '<tr>';
								$html 	.= '<td class="text-right">Virtual Interview Link</td>';
								$html 	.= '<td>'.$email_param['virtual_link'].'</td>';
							$html 	.= '</tr>';
						}else{
							if($email_param['interview_type'] == "face_to_face"){
								$html 	.= '<tr>';
									$html 	.= '<td class="text-right">Interview Address</td>';
									$html 	.= '<td>'.$email_param['interview_location'].'</td>';
								$html 	.= '</tr>';
							}//end if
						}//end if
						
						if($email_param['notes_to_interviewee'] !== ""){
							$html 	.= '<tr>';
								$html 	.= '<td class="text-right">Notes to Interviewee</td>';
								$html 	.= '<td>'.$email_param['notes_to_interviewee'].'</td>';
							$html 	.= '</tr>';
						}//end if
					$html 	.= '</table>';

					$data["notification"] = array(
						"record_type" => 'job_post_for_interview',
						"record_id" => $data['record_header']['job_post_id'],
						"message" => $html,
						"short_message" => 'Interview for the '.$param['placeholder']['job_title'].' role',
						"user_id" => $data['record_header']['user_id'],
						"employer" => $email_param['company_name'],
						"created_by" => $this->session->get('userid')
					);

					/*$data['for_update'][] = "INSERT INTO onotification(
													record_type,
													record_id,
													message,
													short_message,
													user_id,
													created_by)
											 VALUES('job_post_for_interview',
											 		'".$data['record_header']['job_post_id']."',
											 		'".$message."',
											 		'You have an interview for the ".$param['placeholder']['job_title']." role',
											 		'".$data['record_header']['user_id']."',
											 		'".$this->session->get('userid')."'
															)";
					*/
					//--------------------------------------------------------------------------------------------------
					//end for update
					//end insert notification


					//add record
					//--------------------------------------------------------------------------------------------------
					$res 		= $this->model->add_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					

					$data['response'] = array(
						'id' => $res['data']['id']
					);

					//set Audit Trail
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'job_post_for_interview'
					);
					//End Audit Trail
					//--------------------------------------------------------------------------------------------------
					//end add record

					//send email
					$message 					= "";
					$notes_to_interviewee 		= "";

					if($data['record_header']['notes_to_interviewee'] !== ""){
						$notes_to_interviewee = "Remarks : ".$data['record_header']['notes_to_interviewee'];
					}//end if
					if($data['record_header']['interview_type'] == 'face_to_face'){
						$message = "You have have been invited for an interview for the ".$param['placeholder']['job_title']." role\n
											Date : ".$data['record_header']['interview_date']."\n
											Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
											Location : ".$data['record_header']['location']."\n";
					}else{
						$message = "You have have been invited for an interview for the ".$param['placeholder']['job_title']." role\n
											Date : ".$data['record_header']['interview_date']."\n
											Time : ".$data['record_header']['interview_start_time'].' - '.$data['record_header']['interview_end_time']."\n
											Link : ".$data['record_header']['virtual_interview_link']."\n";
					}//end if

					$message .= $notes_to_interviewee;
					
					$email = \Config\Services::email();
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo($param['placeholder']['applicant_email']);
					//$email->setSubject($param['placeholder']['company_name']);
					$email->setSubject($this->lib->job_interview_subject);

					



					$email->setMessage($this->lib->job_interview_template($email_param));
					$email->setMailType('html');
					if(!$email->send()){
						$validator['messages'][] = "Email Failed!";
					}//end if
					//end send email
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
