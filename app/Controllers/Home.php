<?php

namespace App\Controllers;
use App\Models\Home_model;
use App\Models\Audit_trail_model;
use App\Models\Login_model;
use App\Libraries\Pcl_lib;
class Home extends BaseController{
	protected $model;
	protected $login_model;
	protected $session;
	protected $audit_trail;
	protected $record_type;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Home_model();
		$this->login_model 		= new Login_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'logout';
		$this->session 			= session();
    }

    public function index(){
    	
    	//$session = \Config\Services::session();
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			
  			if($this->session->get('usertype')=='USER'){
				return redirect()->to(base_url());
			}else{
				//return redirect()->to(base_url('active_jobs'));
				$param 				= array();
				$param['user_id'] 	= $this->session->get('userid');
				$param['profile'] 	= $this->model->get_profile($param);
				if($param["profile"]['data']->user_type == 'applicant'){
					if(!$param["profile"]['data']->first_login){
						//check if already set the profile
						$required_counter = 0;

						/*
						if($param["profile"]['data']->first_name == "" || $param["profile"]['data']->last_name == "" || $param["profile"]['data']->contact_number == ""){
							$required_counter += 1;
						}//end if

						if($param["profile"]['data']->industry_count <= 0 || $param["profile"]['data']->job_level_count <= 0 || $param["profile"]['data']->job_type_count <= 0 || $param["profile"]['data']->department_count <= 0 || $param["profile"]['data']->education_count <= 0 || $param["profile"]['data']->language_count <= 0){
							$required_counter += 1;
						}//end if
						*/

						//end check if already set the profile

						if($required_counter == 0){
							return redirect()->to(base_url('job_search/private'));	
						}else{
							return redirect()->to(base_url('applicant_info/edit/'.$param['user_id'].'?info=1'));
						}
						
					}//end if
				}else if($param["profile"]['data']->user_type == 'employer'){
					if($param["profile"]['data']->password_changed){
						return redirect()->to(base_url('active_jobs'));
					}//end if
				}else{
					return redirect()->to(base_url('account_management'));
				}//end if//end if

				$param['country_dial_code'] = $this->lib->get_country_code();
				
				//homeurl = baseurl + '/job_search/private';
				return view('Home/index',$param);
			}
  		}
    	//echo $this->session->get('username');
    	//echo $session->get('usertype');
        
    }//end function

    public function logout(){
    	if(isset($_SESSION['userid'])){
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

			if(isset($_SESSION['userid'])){
				$data['record_header'] 			= array();
				$data['record_header']['id'] 	= $_SESSION['userid'];
				$res 							= $this->login_model->update_logged_in($data);
		       	
			}//end if

			unset($_SESSION['userid']);
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			unset($_SESSION['usertype']);
			unset($_SESSION['name']);
		}//end if
		
    	//session_destroy();
    	return redirect()->to(base_url('Login/'));
    }

    

    public function login(){
    	$validator = [];

    	$request 		= \Config\Services::request();
    	$validation 	=  \Config\Services::validation();

		

		$rules = [
            "username" => [
                "label" => "username", 
                "rules" => "trim|required|max_length[50]"
            ],
            "password" => [
                "label" => "password", 
                "rules" => "trim|required|max_length[20]"
            ]
        ];

        

		if ($this->validate($rules)){
			
			try{
				
				$username 	= $request->getPost('username');
				$password 	= $request->getPost('password');
				//throw new \Exception($request->getPost('username'));
				//$validator['success'] = $this->validate($rules);
				//$validator['messages'] = "Success!";
				
				$res 		= $this->model->auth_user($username,$password);

				if(!is_null($res)){
					

					
					$_SESSION['userid']   		= $res->id;
					$_SESSION['username'] 		= $res->user_name;
			       	$_SESSION['password'] 		= $res->password;
			       	$_SESSION['usertype'] 		= $res->user_type;
			       	$_SESSION['name'] 			= $res->name;

			       	$validator['success'] 		= true;
					$validator['messages'][] 	= array("success" => "Logged in successfully!");
			       	
			       	
				}else{
					$validator['success'] 		= false;
					$validator['messages'][] 	= array("exception" => "Invalid Username/Password!");
				}
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $validation->getErrors();
		}
		

		echo json_encode($validator);

    }


    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
    	$rec_type 			= "profile";
    	
    	$header 			= $param['header'];
    	/*$rules = [
            "row.industry" => [
                "label" => "industry", 
                "rules" => "trim|required"
            ],
            "row.job_level" => [
                "label" => "job level", 
                "rules" => "trim|required"
            ],
            "row.job_type" => [
                "label" => "job type", 
                "rules" => "trim|required"
            ],
            "row.department" => [
                "label" => "department", 
                "rules" => "trim|required"
            ]
        ];*/

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
            /*"header.dial_code" => [
                "label" => "dial_code", 
                "rules" => "trim|required",
                'errors' => [
                	'required' => 'Please input dial_code.'
	            ]
            ],
            "header.contact_number" => [
                "label" => "contact number", 
                "rules" => "trim|required|min_length[8]|mobileValidation[header.contact_number,header.dial_code]",
                'errors' => [
                	'required' => 'Please input contact number',
	                'mobileValidation' => $mobile_message,
	            ]
            ],
			*/

            
            "header.location" => [
                "label" => "location", 
                "rules" => "trim|required|max_length[600]",
                'errors' => [
	                'required' => 'Please input location.',
	            ]
            ]

            /*"row_education.school" => [
                "label" => "school", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input school education.',
	            ]
            ],

            "row_education.degree" => [
                "label" => "degree", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input degree education.',
	            ]
            ],

            "row_language.language" => [
                "label" => "language", 
                "rules" => "trim|required",
                'errors' => [
	                'required' => 'Please input language.',
	            ]
			],


            "row_industry.industry" => [
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

        /*if(isset($param['row_education'])){
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
        }//end if
		*/


        /*if(isset($param['row_language'])){
			$rules['row_language.language'] = array(
				"label" => "language", 
	        	"rules" => "trim|required|max_length[200]",
	        	'errors' => array(
	                'required' => 'Please input language.',
	            )
			);
        }//end if
		*/

        if ($this->validate($rules)){
			try{

				define('DS', DIRECTORY_SEPARATOR);
				$data['response'] 								= array();
				$data['table_name'] 							= 'oprofile';
				$data['table_name_lines'] 						= 'employer_image';
				$data['record_header'] 							= $param['header'];


				$data['record_lines']['row_education'] 			= array();
				$data['record_lines']['row_language'] 			= array();

				$data['record_lines']['row_industry'] 			= array();
				$data['record_lines']['row_job_level'] 			= array();
				$data['record_lines']['row_job_type'] 			= array();
				$data['record_lines']['row_department'] 		= array();

				$data['audit'] 									= array();
				$data['audit_lines'] 							= array();


				//set user
				$data['record_user']['id'] 			= $this->session->get('userid');
				$data['record_user']['name'] 		= $data['record_header']['first_name'] . ' ' . $data['record_header']['last_name'];
				$data['record_user']['email_add'] 	= $data['record_header']['email_add'];
				$data['record_user']['username'] 	= $data['record_header']['email_add'];
				//end set user

				//check duplicate
				$data["names"] 									= array();
				$data["names"][] 								= $data['record_header']['email_add'];
				$data["dup_id"] 								= $data['record_header']['id'];
				$data["dup_filter"] 							= "email_add";
				$data["dup_table"] 								= "oprofile";
				$res 											= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['email_add'].".");
				}//end if
				//check duplicate
				//end check duplicate

				$data["record_header"]["first_login"] = 0;


				//create lines
				//===============================================================================================================================
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
						}//end if

						

						if($data_row['end_date'] !== ""){
							$date_str =  explode("/", $data_row['end_date']);
							$date_str = $date_str[0] . '/1/' . $date_str[1];
							$data_row['end_date'] = $date_str;
						}//end if
						

						$data['record_lines']['row_education'][] 		= $data_row;
					}//end for
				}//end if
				//end education

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

				/*
				//duplicate checking
				$w_dupe = $this->array_has_dupes($param['row_industry']['industry']);
				if($w_dupe){
					throw new \Exception("Duplicate value for industry!");
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
				$w_dupe = $this->array_has_dupes($param['row_job_level']['job_level']);
				if($w_dupe){
					throw new \Exception("Duplicate value for job level!");
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
				$w_dupe = $this->array_has_dupes($param['row_job_type']['job_type']);
				if($w_dupe){
					throw new \Exception("Duplicate value for job type!");
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
				$w_dupe = $this->array_has_dupes($param['row_department']['department']);
				if($w_dupe){
					throw new \Exception("Duplicate value for department!");
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
				*/
				//===============================================================================================================================
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


				//Insert Audit Trail header
				//--------------------------------------------------------------------------------------------------
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

				
				//--------------------------------------------------------------------------------------------------
				//End Insert Audit Trail
				
				
				


				$this->session->set('name', $data['record_user']['name']);
				$this->session->set('first_name', $data['record_header']['first_name']);

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


    public function change_password(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
    	$rec_type 			= "profile";
    	
    	
    	$rules = [
            "header.new_password" => [
                "label" => "new password", 
                "rules" => "trim|required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]|max_length[50]",
                'errors' => [
	                'required' => 'Please input your new password.'
	            ]
            ],
            "header.confirm_password" => [
                "label" => "confirm password", 
                "rules" => "trim|required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]|matches[header.new_password]|max_length[50]",
                'errors' => [
	                'required' => 'Please input your confirm password.',
	                'matches' => 'Password doesn\'t match.'
	            ]
            ]
        ];

        
        if ($this->validate($rules)){
			try{
				
				
				$data['response'] 							= array();
				$data['table_name'] 						= 'ousr';
				
				$header 									= $param['header'];
				//$row 										= $param['row'];

				
				
				

				$data['audit']   							= array();
				$data['record_header'] 						= $header;
				$data['record_header']['password_changed'] 	= 1;
				$data['record_header']['password'] 			= $header['new_password'];

				unset($data['record_header']['new_password']);
				unset($data['record_header']['confirm_password']);
 				
				

				
 				
				
				
				
				
				
				if($data['record_header']["id"] > 0){
					//update record
					//--------------------------------------------------------------------------------------------------


					

					//update record
					$res 		= $this->model->update_record($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end update record

					//set audit trail
					$data['audit'][] = array(
						'record_id' 		=> $data['record_header']["id"],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'updated',
						'record_type' 		=> 'user'
					);
					//end set audit trail
					
					
					
			       	

					//--------------------------------------------------------------------------------------------------
					//end update record
				}else{
					

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


    function array_has_dupes($array) {
	   // streamline per @Felix
	   return count($array) !== count(array_unique($array));
	}

}//end class
