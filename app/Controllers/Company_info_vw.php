<?php

namespace App\Controllers;
use App\Models\Company_info_vw_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Company_info_vw extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Company_info_vw_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'employer';
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
	    	$access = json_decode($this->permission["data"][0]["permission"]);
			if(!in_array($type ,$access )){
				return redirect()->to(base_url('home/'));
			    //throw new \Exception("You do not have permission to perform this action!");
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
    	
  			
			return view('Company_info_vw/index',$param);
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

    	$header 			= $param['header'];

    	
    	
    	$mobile_message 	= "";
		if(isset($header["dial_code"])){
			if($header["dial_code"] == "+63"){
				//Philippines
				$mobile_message = "Contact Number must be 10 digit(s) and starts within the range of 1-9 excluding space";
			}else if($header["dial_code"] == "+62"){
				//Indonesia
				$mobile_message = "Contact Number must be 8-10 digits and starts with the area code excluding space";
			}else if($header["dial_code"] == "+66"){
				//Thailand
				$mobile_message = "Contact Number must be 9 digits and starts with the (6,8 or 9) excluding space";
			}else if($header["dial_code"] == "+61"){
				//Australia
				$mobile_message = "Contact Number must be 9 digits and starts with 4 excluding space";
			}else{
				//other countries
				$mobile_message = "Contact Number must be atleast 8 digits excluding space";
			}//end if
		}//end if
    	
    	$rules = [
            "header.company_name" => [
                "label" => "company name", 
                "rules" => "trim|required|max_length[100]",
                'errors' => [
	                'required' => 'Please input company name.',
	            ]
            ],
            "header.about" => [
                "label" => "about", 
                "rules" => "trim|required|max_length[5000]",
                'errors' => [
	                'required' => 'Please input about.',
	            ]
            ],
            "header.website" => [
                "label" => "website", 
                "rules" => "trim|required|max_length[500]",
                'errors' => [
	                'required' => 'Please input website.',
	            ]
            ],
            
            "header.contact_number" => [
                "label" => "tel #", 
                //"rules" => "trim|required|min_length[8]|mobileValidation[header.contact_number,header.dial_code]", //requested to be remove by sir red
				"rules" => "trim|required|min_length[8]",
                'errors' => [
                	'required' => 'Please input tel #.',
	                'mobileValidation' => $mobile_message,
	            ]
            ],

            "header.location" => [
                "label" => "location", 
                "rules" => "trim|required|max_length[600]",
                'errors' => [
	                'required' => 'Please input location.',
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


				define('DS', DIRECTORY_SEPARATOR);
				$data['response'] 				= array();
				$data['table_name'] 			= 'oemployer';
				$data['table_name_lines'] 		= 'employer_image';
				$data['record_header'] 			= $param['header'];
				$data['record_lines'] 			= array();
				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();

				//custom
				$data['file_for_upload'] 		= array();
				$data['record_lines_retain'] 	= array();
				$for_removal_res 				= null;

				

				
				
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['company_name'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "company_name";
				$data["dup_table"] 	= "oemployer";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['company_name'].".");
				}//end if
				//check duplicate
				//end check duplicate

				

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

					//get for removal of file
					$data["names"] 		= array();
					$data["names"] 		= $data['record_lines_retain'];
					$data["dup_id"] 	= $data['record_header']['id'];
					$data["dup_filter"] = "line";
					$data["dup_table"] 	= "employer_image";
					$for_removal_res 	= $this->model->get_file_for_deletion($data);
					//end get  for removal of file

					//create user
					/*
					$data['user'] 	= array();
					$data['user'][] = "insert into ousr(name,username,password,email_add,designation,contact_number,user_type,employer)
									   		SELECT CONCAT(t1.first_name, ' ',t1.last_name),
													t1.username,
													t1.password,
											        t1.work_email,
											        t1.designation,
											        t1.contact_number,
											        'employer',
											        t0.id
											        FROM oemployer t0
											INNER JOIN osignup t1
											ON t0.signup = t1.id
											WHERE STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p') > CURRENT_TIMESTAMP
											AND t0.id = '".$data['record_header']['id']."'
											AND t1.username NOT IN(SELECT a.username FROM ousr a)";
					*/
					//end create user


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
		
				
				

				//upload file
				if($param['file']['doc_content'] !== ""){
					
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['doc_image'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image'];

					if($param['file']['old_doc_image'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {

						}
						
					}//end if

					//$data['file_for_upload'][] = $param['file']['doc_content'];
					
					file_put_contents($tmp_path, base64_decode($param['file']['doc_content']));
					
				}//end if
				

				if($data['record_header']['doc_image'] == "" && $param['file']['old_doc_image'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image'];
					try{
						unlink($old_path);
					}catch (\Exception $e) {

					}
				}//end if
				//end upload file

				//process uploading
				foreach ($data['file_for_upload'] as $line) {
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $line['doc_image'];
					
					if($line['doc_content'] == "" || $line['doc_content'] == null){

					}else{
						file_put_contents($tmp_path, base64_decode($line['doc_content']));
					}//end if
					
				}//end for
				//end process uploading

				//remove file
				if($for_removal_res !== null){

					
					if($for_removal_res['num_rows'] > 0){
						foreach ($for_removal_res['data'] as $line) {
							$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $line['doc_image'];
							try{
								unlink($old_path);
							}catch (\Exception $e) {

							}
							
						}//end foreach
						//throw new \Exception("Duplicate entry ".$res['data'][0]['company_name']."");
					}//end if
				}//end if
				//end remove file


				//Insert Audit Trail header
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail header

				//Insert Audit Trail Lines
				if(count($data['audit_lines']) > 0){
					//throw new \Exception(json_encode(($data['audit_lines'])));
					$audit_res 			= $this->audit_trail->add_lines($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail lines.");
					}//End if
				}//End if
				$data['audit_lines'] = array();
				//End Insert Audit Trail Linesv


				//audit trail
				/*
				if($res['data']['user_id'] > 0){
					$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['user_id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'user'
					);
				}//end if
		       	//end audit trail

				//Insert Audit Trail
				if(count($data['audit']) > 0){
					$res 			= $this->audit_trail->add($data);
					if(!$res){
						throw new \Exception("Error on creating audit trail!");
					}//End if
				}//End if
				*/
				//End Insert Audit Trail

				//throw new \Exception($_SESSION['doc_image']);
				
				
				if($data['record_header']['doc_image'] !== ""){
					$_SESSION['employer_doc_image'] = $data['record_header']['doc_image'];
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
