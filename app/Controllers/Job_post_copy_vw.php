<?php

namespace App\Controllers;
use App\Models\Job_post_copy_vw_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Job_post_copy_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Job_post_copy_vw_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'job_post';
		$this->session 			= session();
		$this->permission 		= array();
    }

    public function index($type,$id){

    	
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{

  			$response 	= array();

  			//check access
  			
  				$permission_param 	= array(
		    		"permission_user_type" 		=> $this->session->get('usertype'),
					"permission_record_type" 	=> $this->record_type
		    	);
		    	$this->permission 				= $this->model->get_permission($permission_param);
		    	if($this->permission["data"] !== null){
		    		$access = json_decode($this->permission["data"][0]["permission"]);
					if(!in_array($type ,$access)){
						return redirect()->to(base_url('home/'));
					    //throw new \Exception("You do not have permission to perform this action!");
					}//end if
		    	}else{
		    		return redirect()->to(base_url('home/'));
		    	}//end if
		    	
  			
	    	
			//check access


  			//get employer
  			$param = array();
  			$param['table_name'] 		= 'oemployer';
  			$param['filter_field'] 		= 'id';
  			$param['filter_operator'] 	= '=';
  			$param['filter_value'] 		= $this->session->get('employer');
  			$res 	= $this->model->get_master_data($param);
  			if($res['num_rows'] > 0){
  				$response['employer'] = $res['data'];
  			}//end if
  			//end get employer

  			//get perks and benefits
  			$param = array();
  			$param['table_name'] 		= 'operks_and_benefits';
  			$param['filter_field'] 		= 'inactive';
  			$param['filter_operator'] 	= '=';
  			$param['filter_value'] 		= 0;
  			$param['user_id'] 		= $this->session->get('userid');
  			$res 	= $this->model->get_perks_benefits($param);
  			if($res['num_rows'] > 0){
  				$response['perks_and_benefits'] = $res['data'];
  			}//end if
  			//end get perks and benefits


  			//get employer default
  			$param['employer']  		= $this->session->get('employer');
  			$res 	= $this->model->get_employer_defaults($param);
  			if($res['num_rows'] > 0){
  				$response['employer_default'] = $res['data'];
  			}//end if
  			//end get employer default	

  			$response['country_dial_code'] = $this->lib->get_country_code();
  			$response['id'] 				= $id;
  			$response['type'] 				= $type;
    	
  			
			return view('Job_post_copy_vw/index',$response);
  		}//end if
        
    }//end function


    public function get_record($table_name){
    	$param 			= array();
    	$param['table_name'] 	= $table_name;
    	$response 		= null;

    	$res 			= $this->model->get_record($param);
    	if($res['success']){
    		$response['data'] = $res['data'];
    	}//end if
    	//$response['data'] = $this->model->get_record($param);

    	echo json_encode($response);

    }//end if

    public function get_record_no_inactive($table_name){
    	$param 			= array();
    	$param['table_name'] 	= $table_name;
    	$response 		= null;

    	$res 			= $this->model->get_record_no_inactive($param);
    	if($res['success']){
    		$response['data'] = $res['data'];
    	}//end if
    	//$response['data'] = $this->model->get_record($param);

    	echo json_encode($response);

    }//end if

	public function load_data($id){
			$request 						= $this->request->getVar();
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
            "header.job_title" => [
                "label" => "job title", 
                "rules" => "trim|required|max_length[200]",
                'errors' => [
	                'required' => 'Please input job title.',
	            ]
            ],
            "header.department" => [
                "label" => "department", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input department.',
	            ]
            ],
            "header.industry" => [
                "label" => "industry", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input industry.',
	            ]
            ],
            "header.job_level" => [
                "label" => "job level", 
                "rules" => "trim|required",
                'errors' => [
                	'required' => 'Please input job level.'
	            ]
            ],
            "header.job_type" => [
                "label" => "job type", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input job type.',
	            ]
            ],
            "header.education" => [
                "label" => "education", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input education.',
	            ]
            ],
            "header.location" => [
                "label" => "location", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input location.',
	            ]
            ],
            "header.job_description" => [
                "label" => "job description", 
                "rules" => "trim|required|max_length[100000]",
                'errors' => [
	                'required' => 'Please input job description.',
	            ]
            ],
            "header.qualification" => [
                "label" => "qualification", 
                "rules" => "trim|required|max_length[100000]",
                'errors' => [
	                'required' => 'Please input qualification.',
	            ]
            ],
            "header.vacancies" => [
                "label" => "vacancies", 
                "rules" => "trim|required|max_length[3]|integer|greater_than[0]",
                'errors' => [
	                'required' => 'Please input vacancies.',
	            ]
            ],
            "header.job_expiration_date" => [
                "label" => "job expiration date", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input job expiration date.',
	            ]
            ]
        ];


        if(trim($param['header']['salary_to']) !== "" || trim($param['header']['salary_from']) !== ""){
        	$rules['header.salary_from'] = array(
				"label" => "salary from", 
                "rules" => "numeric"
			);

			$rules['header.salary_to'] = array(
				"label" => "salary to", 
                "rules" => "numeric|greater_than_equal_to[".$param['header']['salary_from']."]",
                "errors" => [
                	'greater_than_equal_to' => 'Invalid salary range!'
                ]
			);
        }//end if

        if ($this->validate($rules)){
			try{
				

				

				define('DS', DIRECTORY_SEPARATOR);
				$data['response'] 				= array();

				$data['table_name'] = "";
				if($param['placeholder']['isActive']){
					$data['table_name'] 			= 'ojob_post';
				}else{
					$data['table_name'] 			= 'ojob_post_template';
				}

				
				$data['record_header'] 			= $param['header'];
				$data['record_lines'] 			= array();
				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();
				$data['isActive'] 				= $param['placeholder']['isActive'];

				if(isset($param['placeholder']['customRadio'])){
					$data['record_header']['job_expiration_days'] = $param['placeholder']['customRadio'];
				}//end if

				//throw new \Exception($data['record_header']['inactive']);
				

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
				if($this->permission["data"] !== null){
		    		$access = json_decode($this->permission["data"][0]["permission"]);
					if(!in_array($type ,$access )){
						throw new \Exception("You do not have permission to perform this action.");
					}//end if
		    	}else{
		    		throw new \Exception("You do not have permission to perform this action.");
		    	}//end if
				//end check access


				//check if job expiration date exceeded contract date
				//get employer default
	  			$data_filter['employer']  		= $this->session->get('employer');
	  			$res 	= $this->model->get_employer_defaults($data_filter);
	  			if($res['num_rows'] > 0){
	  				if(strtotime($data['record_header']['job_expiration_date']) > strtotime($res['data'][0]["end_date"])){
						throw new \Exception("Job expiration date(".$data['record_header']['job_expiration_date'].") cannot exceed the contract date(".$res['data'][0]["end_date"].")!");
					}//end if
	  			}//end if
	  			//end get employer default	
	  			//throw new \Exception("Error Processing Request2", 1);
				//end check if job expiration date exceeded contract date

				//check job expiration date if greater than 4
				$difference 	= 0;
				$today 			= date('n/j/Y');
				if(strtotime($data['record_header']['job_expiration_date']) < strtotime($today)){
					throw new \Exception("Back date is not allowed!");
				}//end if
				$difference     = $this->lib->date_diff($today,$data['record_header']['job_expiration_date']);
				if($difference["month"] >= 4){
					if($difference["day"] > 0){
						throw new \Exception("Max validty for job expiration is 4 months.");
					}//end if
					
				}//end if
				//end check job expiration date if greater than 4

				

				
				//check if with applicant
				if($param['placeholder']['type'] == 'edit'){

					$data["dup_table"] 		= "job_post_applicant";
					$data["dup_filter"] 	= "id = '".$data['record_header']['id']."'";
					$res 				= $this->model->check_applicant($data);
					if($res['data'][0]['result'] > 0){
						throw new \Exception("This job post has ".$res['data'][0]['result']." applicant(s), editing is not allowed.");
					}//end if
				}//end if
				//end check if with applicant

				//check if paused
				$data["user_id"] 		= $this->session->get('userid');
				$res 				= $this->model->check_employer_status($data);
				if((int)$res['data'][0]['paused']){
					throw new \Exception("This employer contract has been paused.");
				}//end if
				//end check if paused
				
				

				if(isset($data['record_header']['perks_and_benefits'])){
					$perks_and_benefits = json_encode($data['record_header']['perks_and_benefits']);
					unset($data['record_header']['perks_and_benefits']);
					$data['record_header']['perks_and_benefits'] = $perks_and_benefits;
				}//end if
				$data['record_header']['employer'] 					= $this->session->get('employer');
				$data['record_header']['vacancies_placeholder'] 	= $data['record_header']['vacancies'];
				
				
				
				
				

				
				if($param['placeholder']['type'] == 'edit'){


					//check if already 48 hours posted to disable editing and deleting
					$res = $this->model->get_current_job_post($data);
					if(!$res["success"]){
						throw new \Exception($res["message"]);
					}//end if
					
					if($res["data"][0]['date_posted_diff'] > 2){
						throw new \Exception('This job post has been published for more than 48 hours! Deleting/editing is not allowed.');
					}//end if
					//end check if already 48 hours posted to disable editing and deleting


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


					//update record
					$res 		= $this->model->update_record($data);		

					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					$data['response'] = array(
						'id' => $res['data']['id']
					);

					//--------------------------------------------------------------------------------------------------
					//end update record
				}else{

					$data['record_header']['created_by'] 				= $this->session->get('userid');
					

					unset($data['record_header']['id']);

					//add record
					//--------------------------------------------------------------------------------------------------
					//update record
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
						'record_type' 		=> $this->record_type
					);
					//End Audit Trail
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

			


				



			

			    $validator['success'] 		= true;
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
