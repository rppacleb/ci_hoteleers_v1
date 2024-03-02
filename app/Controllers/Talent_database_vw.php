<?php

namespace App\Controllers;
use App\Models\Talent_database_vw_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Talent_database_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Talent_database_vw_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'applicant_search';
		$this->session 			= session();
		$this->permission 		= array();
    }

    public function index($type,$id){

    	
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			$param 	= array();
  			
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
  			
  			$param['country_dial_code'] = $this->lib->get_country_code();
  			$param['id'] 				= $id;
  			
  			$param['type'] 				= $type;
    	
  			
			return view('Talent_database_vw/index',$param);
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

	public function get_job_post($type){
		$data;
		$request 				= $this->request->getVar();
		$param 					= [];


		$param["request"] 		= json_encode($request);

		//pagination
		$res 			= $this->model->get_job_post($type,$request,null,null);
		if($res['num_rows'] > 0){
			$data 			= $res['data'];
    		$total_result 	= $res['num_rows'];
    		$page 			= (int)(($this->request->getVar('page')!==null && $this->request->getVar('page')!=0)?$this->request->getVar('page'):1)-1;
    		$per_page 		= 15;
	    	$offset 		= $page * $per_page;
	    	$total_page 	= ceil($total_result/$per_page);


	    	$res 					= $this->model->get_job_post($type,$request,$per_page,$offset);
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
    		
    		
	    	echo json_encode($res);
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
			$allowed_ext 			= array('docx','doc');
			
		
			
			
			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();
			
			
			
			if($this->request->getFileMultiple('header.company_file')) {
				$max_size 		= 5; //5MB
				$total_size 	= 0;

				
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
					

					$file_content 	= file_get_contents($file);

					$data['file'][] = array(
						'file' 	  				=> base64_encode($file_content),
						'file_attr' 			=> $file_attr
					);
					$line += 1;
				}//end foreach

			

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



    public function invite_to_job(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{

				
				$data['response'] 				= array();
				$data['table_name'] 			= 'usr_job_invite';
				$data['record_header'] 			= array();

				$data['record_header']			= $param['header'];
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");
					
				}//end if

				

				//check if already on the job post
				$data["dup_table"] 	= "job_post_applicant";
				$data["dup_filter"] = "WHERE t0.id = '".$data['record_header']['job_post']."'
										AND t0.user_id = '".$data['record_header']['id']."'";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("This applicant already have an application on this job.");
				}//end if
				//end if already on the job post


				
				
				
				
				
				//check duplicate
				$data["dup_table"] 	= "usr_job_invite";
				$data["dup_filter"] = "WHERE t0.id = '".$data['record_header']['id']."'
										AND t0.job_post = '".$data['record_header']['job_post']."'";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("You have already invited this applicant.");
				}//end if
				//check duplicate
				//end check duplicate

				

				//get email data
				$data["dup_table"] 		= "ojob_post";
				$data["dup_filter"] 	= "INNER JOIN oemployer t1 
											ON t0.employer = t1.id
										   WHERE t0.id = '".$data['record_header']['job_post']."'";
				$email_data 				= $this->model->get_email_data($data);
				//end get email data

				//get user data
				$data["dup_table"] 		= "ousr";
				$data["dup_filter"] 	= " WHERE t0.id = '".$data['record_header']['id']."'";
				$user_data 				= $this->model->check_duplicate($data);
				//end get user data


				//insert notification
				//for update
				//--------------------------------------------------------------------------------------------------
				$data['for_update'] = array();
				$data['for_update'][] = "INSERT INTO onotification(
												record_type,
												record_id,
												message,
												short_message,
												user_id,
												created_by)
										 VALUES('job_post',
										 		'".$data['record_header']['job_post']."',
										 		'You have have been invited for the ".$email_data["data"][0]['job_title']." 
										 		 role by ".$email_data["data"][0]['company_name']."',
										 		'Job invite for ".$email_data["data"][0]['job_title']."',
										 		'".$data['record_header']['id']."',
										 		'".$this->session->get('userid')."'
														)";
				//--------------------------------------------------------------------------------------------------
				//end for update
				//end insert notification
				
				
				

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
					'record_type' 		=> 'usr_job_invite'
				);
				//End Audit Trail
				//--------------------------------------------------------------------------------------------------
				//end add record
			

				//send email
				if(isset($email_data["data"])){
				
					$email = \Config\Services::email();
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo($user_data['data'][0]['email_add']);
					
					$email->setSubject($this->lib->invitation_apply_subject);
					$email_param = array();
					$email_param["name"] = $user_data['data'][0]['name'];
					$email_param["job_title"] = $email_data["data"][0]['job_title'];
					$email_param["company_name"] = $email_data["data"][0]['company_name'];
					$email_param["url"] = base_url('/login');
					$email->setMessage($this->lib->invitation_apply($email_param));
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
			
		
		

		echo json_encode($validator);
	
    }//end function

    
    //TODO
    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();

    	
    	
    	$rules = [
            "header.status" => [
                "label" => "move to", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please select move to.',
	            ]
            ]
        ];
        
       

        
       

        if ($this->validate($rules)){
			try{
				//check access
				$permission_param 	= array(
		    		"permission_user_type" 		=> $this->session->get('usertype'),
					"permission_record_type" 	=> $this->record_type
		    	);
				$this->permission 		= $this->model->get_permission($permission_param);
				$access = json_decode($this->permission["data"][0]["permission"]);
				if(!in_array( "edit" ,$access )){
				    throw new \Exception("You do not have permission to perform this action.");
				}//end if
				//end check access


				

				$data['response'] 				= array();
				$data['table_name'] 			= 'job_post_move_to';
				$data['record_header'] 			= $param['header'];

				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();

				
				//end check status
				$data["dup_table"] 	= "job_post_move_to";
				$data["dup_filter"] = "t0.id='".$data['record_header']['id']."' 
										AND t0.user_id = '".$data['record_header']['user_id']."' 
										AND t0.if_current = true";
				$res 				= $this->model->check_status($data);
				if($res['num_rows'] > 0){
					if($res['data'][0]['status'] == 'short listed'){
						if($data['record_header']['status'] == 'offered' || $data['record_header']['status'] == 'hired'){
							throw new \Exception("You must set for interiew first.");
						}//end if
					}//end if

					if($res['data'][0]['status'] == 'for interview'){
						if($data['record_header']['status'] == 'hired'){
							throw new \Exception("You must set offered first.");
						}//end if
					}//end if

					if($res['data'][0]['status'] == 'for interview'){
						if($data['record_header']['status'] == 'short listed'){
							throw new \Exception("You have finished the ".$data['record_header']['status']." application.");
						}//end if
					}//end if

					if($res['data'][0]['status'] == 'offered'){
						if($data['record_header']['status'] == 'short listed' || $data['record_header']['status'] == 'for interview'){
							throw new \Exception("You have finished the ".$data['record_header']['status']." application.");
						}//end if
					}//end if




					if($res['data'][0]['status'] == 'hired'){
						throw new \Exception("You have finished the ".$data['record_header']['status']." application.");
					}//end

					if($res['data'][0]['status'] == 'hired'){
						if($data['record_header']['status'] == 'for interview' || $data['record_header']['status'] == 'offered' || $data['record_header']['status'] == 'short listed'){
							throw new \Exception("You have finished the ".$data['record_header']['status']." application.");
						}//end if
					}//end if
					
				}else{
					if($data['record_header']['status'] == 'for interview' || $data['record_header']['status'] == 'offered' || $data['record_header']['status'] == 'hired'){
						throw new \Exception("You must set applicant on short listed first.");
					}//end if
				}//end if
				//end check status
				//throw new \Exception(json_encode($data['record_header']));


				if($data['record_header']['status'] == 'for interview'){
					throw new \Exception($data['record_header']['status']." status will automatically populated once you set a schedule for interview.");
				}//end if

				//check duplicate
				/*
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['email_add'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "email_add";
				$data["dup_table"] 	= "oprofile";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['email_add']."");
				}//end if
				//check duplicate
				*/
				//end check duplicate

				

			
				/*
				//fetch old line value
				$audit_res 		= $this->audit_trail->get_current_line_record($data['record_header']['id'],$data['table_name_lines']);
				//End fetch line value

				//create lines
				if(isset($param['row'])){
					$row 					= isset($param['row'])? $param['row'] : array();
					$row_keys 				= array_keys($row);
					$line_count				= count($row['doc_image']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['file_for_upload'][] 		= $data_row;
						unset($data_row['doc_content']);
						$data['record_lines'][] 		= $data_row;

						$data['record_lines_retain'][] = $data_row['line'];
					}//end for
				}//end if
				//end create lines


				//Set Audit Trail Lines
				
				foreach ($data['record_lines'] as $line) {
					$line_keys 	= array_keys($line);
					$is_new 	= true;
					foreach ($audit_res as $r) {
						if($r['line'] == $line['line']){
							$is_new = false;
							for ($i = 0; $i <= count($line_keys) - 1; $i++) {
								if($r[$line_keys[$i]] != $line[$line_keys[$i]]){
									$data['audit_lines'][] = array(
										'user_id' 	  				=> $this->session->get('userid'),
										'action' 					=> 'updated',
										'record_id' 				=> $data['record_header']['id'],
										'line' 						=> $line['line'],
										'record_type' 				=> $this->record_type,
										'record_field' 				=> $line_keys[$i],
										'record_field_old_value' 	=> $r[$line_keys[$i]],
										'record_field_new_value' 	=> $line[$line_keys[$i]]
									);
								}//End if
							}//End for
							break;
						}
					}//End foreach
					
					
					if($is_new){
						//throw new \Exception("Error Processing Request2", 1);
						$data['audit_lines'][] = array(
							'user_id' 	  				=> $this->session->get('userid'),
							'action' 					=> 'created',
							'record_id' 				=> $data['record_header']['id'],
							'line' 						=> $line['line'],
							'record_type' 				=> $this->record_type,
							'record_field' 				=> "",
							'record_field_old_value' 	=> "",
							'record_field_new_value' 	=> $line['doc_image']
						);
					}//end if
					//throw new \Exception(json_encode($data['audit_lines']));
				}//End foreach
				//End Set Audit Trail Lines
				//End Insert Lines
				*/
				//for update
				//--------------------------------------------------------------------------------------------------
				$data['for_update'] = array();
				$data['for_update'][] = "UPDATE ".$data['table_name']." 
										 SET if_current = false 
										 WHERE id = '".$data['record_header']['id']."' 
										 AND user_id = '".$data['record_header']['user_id']."'";
				
				if($data['record_header']['status'] == 'hired'){
					$data['for_update'][] = "UPDATE ojob_post a
										 SET a.vacancies = (a.vacancies - 1)
										 WHERE a.id = '".$data['record_header']['id']."'
										 AND a.vacancies > 0";
					$data['for_update'][] = "UPDATE ojob_post a
										 SET a.status = 'closed',
										     a.date_closed = NOW()
										 WHERE a.vacancies = 0";
				}//end if
				
				//--------------------------------------------------------------------------------------------------
				//end for update
				
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
					'record_type' 		=> 'job_post_move_to'
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
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}
		

		echo json_encode($validator);
	
    }//end function

}//end class
