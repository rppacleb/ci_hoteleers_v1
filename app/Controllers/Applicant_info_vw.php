<?php

namespace App\Controllers;
use App\Models\Applicant_info_vw_model;
use App\Models\Home_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class Applicant_info_vw extends BaseController{
	protected $model;
	protected $home_model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;
	protected $permission;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Applicant_info_vw_model();
		$this->home_model 			= new Home_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'applicant_info';
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
  			$res 	= $this->model->get_master_data('status');
  			
  			if($res['num_rows'] > 0){
  				$param['status'] = $res['data'];
  			}//end if
  			$param['country_dial_code'] = $this->lib->get_country_code();
  			$param['id'] 				= $id;
  			$param['type'] 				= $type;
    	
  			
			return view('Applicant_info_vw/index',$param);
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
			
    		$param 			= [];

    		
    		//pagination
    		$res 			= $this->model->load_data($id);
    		
    		
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
			$allowed_ext 			= array('DOCX','docx','DOC','doc','pdf','PDF');
			
		
			
			
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

	//change email
    public function change_email(){
		$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
    	$header 			= $param['header'];

		try {
			$m_param['user_id'] 	= $header['id'];
			$profile 				= $this->home_model->get_profile($m_param)["data"];

			$verfication_data 		= array();
			$verfication_data["id"] = $header['id'];
			$verfication_data["verification_code"] = $this->lib->email_verification_code();

			$data['table_name'] = 'profile_verification_code';
			$data['record_header'] = $verfication_data;

			//add record
			//--------------------------------------------------------------------------------------------------
			$res 		= $this->model->add_record($data);		
			if(!$res['success']){
				throw new \Exception($res['message']);
			}//end if
			//--------------------------------------------------------------------------------------------------
			//end add record
			//--------------------------------------------------------------------------------------------------
			//end add record


			//send email
			$email_param = array();
			$email_param["name"] = $profile->first_name;
			$email_param["verification_code"] = $verfication_data["verification_code"];

			$email = \Config\Services::email();
			$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
			$email->setTo($header['email_add']);

			$email->setSubject($this->lib->change_email_subject);
			$email->setMessage($this->lib->change_email_template($email_param));
			if(!$email->send()){
				throw new \Exception("Email Failed.");
			}//end if
			//end send email

			$validator['success'] 		= true;
			$validator['messages'][] 	= array("success" => "An email has been sent to ".$header['email_add']." to change your email!");
			

		}catch (\Exception $e) {
			$validator['success'] 		= false;
			$validator['messages'][] 	= array("exception" => $e->getMessage());
		}//End try	

		echo json_encode($validator);
	}//end function
	//end change email

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
                "label" => "email", 
                "rules" => "trim|required|max_length[100]",
                'errors' => [
	                'required' => 'Please input email.',
	            ]
            ],
            "header.dial_code" => [
                "label" => "dial_code", 
                "rules" => "trim|required",
                'errors' => [
                	'required' => 'Please input dial_code.'
	            ]
            ],
            /*"header.contact_number" => [
                "label" => "contact number", 
                //"rules" => "trim|required|min_length[8]|mobileValidation[header.contact_number,header.dial_code]",
                "rules" => "trim|required|min_length[8]",
				'errors' => [
                	'required' => 'Please input contact number',
	                'mobileValidation' => $mobile_message,
	            ]
            ],*/

            "header.highlights" => [
                "label" => "highlights", 
                "rules" => "trim|max_length[2000]"
            ],
            "header.location" => [
                "label" => "location", 
                "rules" => "trim|required|max_length[600]",
                'errors' => [
	                'required' => 'Please input location.',
	            ]
            ]
            /*"row_industry.industry" => [
                "label" => "industry", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input industry.',
	            ]
            ],
            "row_job_level.job_level" => [
                "label" => "job level", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input job level.',
	            ]
            ],
            "row_job_type.job_type" => [
                "label" => "job type", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input job type.',
	            ]
            ],
            "row_department.department" => [
                "label" => "department", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input department.',
	            ]
            ]*/
        ];
        
        if(isset($param['row_experience'])){
        	$rules['row_experience.designation'] = array(
				"label" => "position", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input position.',
	            )
			);
			$rules['row_experience.company_name'] = array(
				"label" => "company name", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input company name.',
	            )
			);
        }//end if


        if(isset($param['row_skills'])){
			$rules['row_skills.skills'] = array(
				"label" => "skills", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input skills.',
	            )
			);
        }//end if

        if(isset($param['row_education'])){
			$rules['row_education.school'] = array(
				"label" => "university/school", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input university/school.',
	            )
			);

			$rules['row_education.degree'] = array(
				"label" => "degree/field of study", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input degree/field of study.',
	            )
			);

			$rules['row_education.education'] = array(
				"label" => "education", 
	        	"rules" => "trim|required",
	        	'errors' => array(
	                'required' => 'Please input education.',
	            )
			);
        }//end if


        if(isset($param['row_language'])){
			$rules['row_language.language'] = array(
				"label" => "language", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input language.',
	            )
			);
        }//end if

        if(isset($param['row_certification'])){
			$rules['row_certification.certification'] = array(
				"label" => "certifications and licenses", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input certifications and licenses.',
	            )
			);

			$rules['row_certification.issued_date'] = array(
				"label" => "certification issued date", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input certification issued date.',
	            )
			);
        }//end if

        if(isset($param['row_projects'])){
			$rules['row_projects.projects'] = array(
				"label" => "projects", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input projects.',
	            )
			);
        }//end if

        if(isset($param['row_seminar_training'])){
			$rules['row_seminar_training.seminar_training'] = array(
				"label" => "seminars & trainings", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input seminars & trainings.',
	            )
			);
        }//end if


        if(isset($param['row_award_achievement'])){
			$rules['row_award_achievement.award_achievement'] = array(
				"label" => "awards & achievements", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input awards & achievements.',
	            )
			);
        }//end if

        if(isset($param['row_affiliation'])){
			$rules['row_affiliation.affiliation'] = array(
				"label" => "affiliations", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input affiliations.',
	            )
			);
        }//end if

        
       

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
				$data['response'] 								= array();
				$data['table_name'] 							= 'oprofile';
				$data['table_name_lines'] 						= 'employer_image';
				$data['record_header'] 							= $param['header'];



				
				$data['record_lines']['row_experience'] 		= array();
				$data['record_lines']['row_skills'] 			= array();
				$data['record_lines']['row_education'] 			= array();
				$data['record_lines']['row_language'] 			= array();
				$data['record_lines']['row_certification'] 		= array();
				$data['record_lines']['row_projects'] 			= array();
				$data['record_lines']['row_seminar_training'] 	= array();
				$data['record_lines']['row_award_achievement'] 	= array();
				$data['record_lines']['row_affiliation'] 		= array();

				$data['record_lines']['row_industry'] 			= array();
				$data['record_lines']['row_job_level'] 			= array();
				$data['record_lines']['row_job_type'] 			= array();
				$data['record_lines']['row_department'] 		= array();

				
				


				

				$data['audit'] 					= array();
				$data['audit_lines'] 			= array();

				//custom
				$data['file_for_upload'] 		= array();
				$data['record_lines_retain'] 	= array();
				$for_removal_res 				= null;

				if(isset($data['record_header']['internship'])){
					$data['record_header']['internship'] 	= $data['record_header']['internship']=='on'? true : false;	
				}else{
					$data['record_header']['internship'] 	= false;
				}//end if

				
				//set user
				$data['record_user']['id'] 			= $this->session->get('userid');
				$data['record_user']['name'] 		= $data['record_header']['first_name'] . ' ' . $data['record_header']['last_name'];
				$data['record_user']['email_add'] 	= $data['record_header']['email_add'];
				$data['record_user']['username'] 	= $data['record_header']['email_add'];
				//end set user
				
				
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['email_add'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "email_add";
				$data["dup_table"] 	= "oprofile";
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['email_add'].".");
				}//end if
				//check duplicate
				//end check duplicate

				

				//create lines


				


				//experience
				if(isset($param['row_experience'])){
					$row 					= $param['row_experience'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['designation']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {

							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for

						

						if($data_row['start_date'] !== ""){
							$date_str =  explode("/", $data_row['start_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$data_row['start_date'] = $date_str;
						}//end date

						if($data_row['end_date'] !== ""){
							$date_str =  explode("/", $data_row['end_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$data_row['end_date'] = $date_str;
						}//end if

						if($data_row['start_date'] !== "" && $data_row['end_date'] !== ""){
							//validate
							$start = date("Y-m",strtotime($data_row['start_date']));
							$end = date("Y-m",strtotime($data_row['end_date']));

							if($end < $start){
								throw new \Exception('Experience end date must be after start date.');
							}//end
						}//end if


						
						

						
						$data['record_lines']['row_experience'][] 		= $data_row;
					}//end for
				}//end if
				//end experience


				


			

				//skills
				if(isset($param['row_skills'])){
					$row 					= $param['row_skills'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['skills']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						

						$data['record_lines']['row_skills'][] 		= $data_row;
					}//end for
				}//end if
				//end skills

				//education
				if(isset($param['row_education'])){
					$row 					= $param['row_education'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['education']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for


						if($data_row['start_date'] !== ""){
							$date_str =  explode("/", $data_row['start_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$data_row['start_date'] = $date_str;
						}//end date

						if($data_row['end_date'] !== ""){
							$date_str =  explode("/", $data_row['end_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$data_row['end_date'] = $date_str;
						}

						if($data_row['start_date'] !== "" && $data_row['end_date'] !== ""){
							//validate
							$start = date("Y-m",strtotime($data_row['start_date']));
							$end = date("Y-m",strtotime($data_row['end_date']));

							if($end < $start){
								throw new \Exception('Education end date must not be past start date.');
							}//end
						}//end if
						

						$data['record_lines']['row_education'][] 		= $data_row;
					}//end for
				}//end if
				//end education

				//throw new \Exception(count($data['record_lines']['row_education']));
				

				
				

				//language
				if(isset($param['row_language'])){
					$row 					= $param['row_language'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['language']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_language'][] 		= $data_row;
					}//end for
				}//end if
				//end language

				//certification
				if(isset($param['row_certification'])){
					$row 					= $param['row_certification'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['certification']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for

						$date_start_str;
						$date_end_str;
						if($data_row['issued_date'] !== ""){
							$date_str =  explode("/", $data_row['issued_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$date_start_str = $date_str;
						}//end date

						if($data_row['expiration_date'] !== ""){
							$date_str =  explode("/", $data_row['expiration_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$date_end_str = $date_str;
						}//ebd if



						if($data_row['issued_date'] !== "" && $data_row['expiration_date'] !== ""){
							//validate
							$start = date("Y-m",strtotime($date_start_str));
							$end = date("Y-m",strtotime($date_end_str));
						
							if($end < $start){
								throw new \Exception('Certification expiration date must not be past issued date.');
							}//end
						}//end if

						$data['record_lines']['row_certification'][] 		= $data_row;
					}//end for
				}//end if
				//end certification

				//projects
				if(isset($param['row_projects'])){
					$row 					= $param['row_projects'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['projects']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_projects'][] 		= $data_row;
					}//end for
				}//end if
				//end projects

				//seminar training
				if(isset($param['row_seminar_training'])){
					$row 					= $param['row_seminar_training'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['seminar_training']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_seminar_training'][] 		= $data_row;
					}//end for
				}//end if
				//end seminar training

				
				


				//award achievement
				if(isset($param['row_award_achievement'])){
					$row 					= $param['row_award_achievement'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['award_achievement']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_award_achievement'][] 		= $data_row;
					}//end for
				}//end if
				//end award achievement
				


				//affiliation
				if(isset($param['row_affiliation'])){
					$row 					= $param['row_affiliation'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['affiliation']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_affiliation'][] 		= $data_row;
					}//end for
				}//end if
				//end affiliation

				//duplicate checking
				if(isset($param['row_industry'])){
					$w_dupe = $this->array_has_dupes($param['row_industry']['industry']);
					if($w_dupe){
						throw new \Exception("Duplicate value for industry.");
					}//end if
				}//end if
				//end duplicate checking
				
				
				//industry
				if(isset($param['row_industry'])){
					$row 					= $param['row_industry'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['industry']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_industry'][] 		= $data_row;
					}//end for
				}//end if
				//end industry


				//duplicate checking
				if(isset($param['row_job_level'])){
					$w_dupe = $this->array_has_dupes($param['row_job_level']['job_level']);
					if($w_dupe){
						throw new \Exception("Duplicate value for job level.");
					}//end if
				}//end if
				//end duplicate checking

				//job level
				if(isset($param['row_job_level'])){
					$row 					= $param['row_job_level'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['job_level']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_job_level'][] 		= $data_row;
					}//end for
				}//end if
				//end job level


				//duplicate checking
				if(isset($param['row_job_type'])){
					$w_dupe = $this->array_has_dupes($param['row_job_type']['job_type']);
					if($w_dupe){
						throw new \Exception("Duplicate value for job type.");
					}//end if
				}//end if
				//end duplicate checking

				//job type
				if(isset($param['row_job_type'])){
					$row 					= $param['row_job_type'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['job_type']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_job_type'][] 		= $data_row;
					}//end for
				}//end if
				//end job type


				//duplicate checking
				if(isset($param['row_department'])){
					$w_dupe = $this->array_has_dupes($param['row_department']['department']);
					if($w_dupe){
						throw new \Exception("Duplicate value for department.");
					}//end if
				}//end if
				//end duplicate checking

				//department
				if(isset($param['row_department'])){
					$row 					= $param['row_department'];
					$row_keys 				= array_keys($row);
					$line_count				= count($row['department']);
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						$data_row['id'] 	= $data['record_header']['id'];

						for ($i=0; $i < count($row_keys); $i++) {	
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
							
						}//end for
						$data['record_lines']['row_department'][] 		= $data_row;
					}//end for
				}//end if
				//end department
				//end create lines

				
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

				if($param['file']['resume_content'] !== ""){
					
					$tmp_path = FCPATH . DS . "files" . DS . "uploads" . DS . $data['record_header']['resume'];
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_resume'];

					if($param['file']['old_resume'] !== ""){
						try{
							unlink($old_path);
						}catch (\Exception $e) {
							
						}
					}//end if

					//$data['file_for_upload'][] = $param['file']['doc_content'];
					
					file_put_contents($tmp_path, base64_decode($param['file']['resume_content']));
					
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

				if($data['record_header']['resume'] == "" && $param['file']['old_resume'] !== ""){
					//throw new \Exception("Error Processing Request", 1);
					//define('DS', DIRECTORY_SEPARATOR);
					$old_path = FCPATH . DS . "files" . DS . "uploads" . DS . $param['file']['old_resume'];
					try{
						unlink($old_path);
					}catch (\Exception $e) {
						
					}
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

				if(isset($_SESSION['doc_image'])){
					$_SESSION['doc_image'] = $data['record_header']['doc_image'];
				}//end if

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


				//set session
				$this->session->set('name', $data['record_user']['name']);
				//end set session

			

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

    function array_has_dupes($array) {
	   // streamline per @Felix
	   return count($array) !== count(array_unique($array));
	}

}//end class
