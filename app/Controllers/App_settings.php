<?php

namespace App\Controllers;
use App\Models\Homepage_banner_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class App_settings extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Homepage_banner_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'homepage_banner';
		$this->session 			= session();
    }

    public function index(){
    	
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			$request = $this->request->getVar();
  			$response 	= array();
  			$type 		= "edit";

  			//get status
  			$param = array();
  			$param['table_name'] 	= "ohomepage_banner";
  			$res 	= $this->model->get_master_data($param);
  			if($res['num_rows'] > 0){
  				$response['banner_id'] = $res['data'][0]['id'];
  				$type 				   = "view";
  			}//end if

  			if(isset($request["edit"])){
  				if($request["edit"] == "T"){
  					$type 		= "edit";
  				}//end if
  			}//end if
  	
    		$response['type'] = $type;
    		$response['page'] = 'settings';
  			
			return view('App_settings/index',$response);
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


    public function do_upload_a(){
    	$retval 		= [];
		$response 		= [];
		try{	
			$allowed_ext 	= array('png','PNG','jpg','JPG','jpeg','JPEG');


			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();

			if($this->request->getFileMultiple('header.userfile_a')) {
				foreach ($this->request->getFileMultiple('header.userfile_a') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					if($file_attr['file_size'] > 10){
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

    public function do_upload_b(){
    	$retval 		= [];
		$response 		= [];
		try{	
			$allowed_ext 	= array('png','PNG','jpg','JPG','jpeg','JPEG');


			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();

			if($this->request->getFileMultiple('header.userfile_b')) {
				foreach ($this->request->getFileMultiple('header.userfile_b') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					if($file_attr['file_size'] > 10){
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


    public function do_upload_c(){
    	$retval 		= [];
		$response 		= [];
		try{	
			$allowed_ext 	= array('png','PNG','jpg','JPG','jpeg','JPEG');


			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();

			if($this->request->getFileMultiple('header.userfile_c')) {
				foreach ($this->request->getFileMultiple('header.userfile_c') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					if($file_attr['file_size'] > 10){
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

    public function do_upload_d(){
    	$retval 		= [];
		$response 		= [];
		try{	
			$allowed_ext 	= array('png','PNG','jpg','JPG','jpeg','JPEG');


			//$file 			= $this->request->getFile('userfile');

			$data['file'] = array();

			if($this->request->getFileMultiple('header.userfile_d')) {
				foreach ($this->request->getFileMultiple('header.userfile_d') as $file) {
					//throw new \Exception($file->getName());

					$file_attr 		= array(
						'name' 			=> time().'_'.$file->getName(),
						'ext' 			=> $file->getClientExtension(),
						'file_size' 	=> $file->getSizeByUnit('mb')
					);
					if(!in_array($file_attr['ext'], $allowed_ext)){
						throw new \Exception('File type '.$file_attr['ext'].' is not allowed.');
					}//end if
					if($file_attr['file_size'] > 10){
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
    
    //TODO
    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();

    	
    	$rules = [
            
            "header.description_a" => [
                "label" => "description a", 
                "rules" => "trim|required|max_length[5000]",
                'errors' => [
	                'required' => 'Please input description a.',
	            ]
            ],
            "header.description_b" => [
                "label" => "description b", 
                "rules" => "trim|required|max_length[5000]",
                'errors' => [
	                'required' => 'Please input description b.',
	            ]
			],
			"header.about_us_desc" => [
                "label" => "about us description", 
                "rules" => "trim|required|max_length[15000]",
                'errors' => [
	                'required' => 'Please input about us description.',
	            ]
            ]
        ];

        if ($this->validate($rules)){
			try{
				


				define('DS', DIRECTORY_SEPARATOR);
				$data['response'] 				= array();
				$data['table_name'] 			= 'ohomepage_banner';
				$data['table_name_lines'] 		= '';
				$data['record_header'] 			= $param['header'];
				$data['record_lines'] 			= array();
				$data['file'] 					= $param['file'];
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
				if($param['file']['doc_content_a'] !== ""){
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['doc_image_a'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_a'];
					if($param['file']['old_doc_image_a'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {

						}//end catch
						
					}//end if
					file_put_contents($tmp_path, base64_decode($param['file']['doc_content_a']));
				}//end if
				

				if($data['record_header']['doc_image_a'] == "" && $param['file']['old_doc_image_a'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_a'];
					//unlink($old_path);
					try{
						unlink($old_path);
					}catch (\Exception $e) {

					}//end try
				}//end if

				if($param['file']['doc_content_b'] !== ""){
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['doc_image_b'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_b'];
					if($param['file']['old_doc_image_b'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {

						}//end catch	
					}//end if
					file_put_contents($tmp_path, base64_decode($param['file']['doc_content_b']));
				}//end if

				if($data['record_header']['doc_image_b'] == "" && $param['file']['old_doc_image_b'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_b'];

					try{
						unlink($old_path);
					}catch (\Exception $e) {

					}//end try
					
				}//end if


				if($param['file']['doc_content_c'] !== ""){
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['doc_image_c'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_c'];
					if($param['file']['old_doc_image_c'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {

						}//end catch	
					}//end if
					file_put_contents($tmp_path, base64_decode($param['file']['doc_content_c']));
				}//end if

				if($data['record_header']['doc_image_c'] == "" && $param['file']['old_doc_image_c'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_c'];

					try{
						unlink($old_path);
					}catch (\Exception $e) {

					}//end try
					
				}//end if


				if($param['file']['doc_content_d'] !== ""){
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['doc_image_d'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_d'];
					if($param['file']['old_doc_image_d'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {

						}//end catch	
					}//end if
					file_put_contents($tmp_path, base64_decode($param['file']['doc_content_d']));
				}//end if

				if($data['record_header']['doc_image_d'] == "" && $param['file']['old_doc_image_d'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_doc_image_d'];

					try{
						unlink($old_path);
					}catch (\Exception $e) {

					}//end try
					
				}//end if
				//end upload file


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
