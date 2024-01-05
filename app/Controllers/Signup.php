<?php

namespace App\Controllers;
use App\Models\Signup_model;
use App\Models\Audit_trail_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
use App\Libraries\Pcl_lib;
class Signup extends BaseController{
	protected $model;

	protected $validation;
	protected $session;
	protected $lib;

	protected $audit_trail;
	protected $record_type;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Signup_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'signup';

		$this->session 			= Services::session();
		$this->validation 		= Services::validation();
    }


	public function sampleLang() {
		echo json_encode('hatdog');
		
	}

    public function index(){
    	//init cookies
    	//helper("cookie"); getTempdata
				//throw new \Exception(get_cookie('remember_token',false));
    	/*$param = array(
    		"cookies_remember_token" => $this->session->get('hoteleers_remember_token'),
    		"cookies_username" => $this->session->get('hoteleers_username_token'),
    		"cookies_password" => $this->session->get('hoteleers_password_token'),
    	);*/

    	$param 						= array();
    	$param['country_dial_code'] = $this->lib->get_country_code();


		return view('Signup/index',$param);
    }//end function


    public function get_record($type){
    	$param 			= array();
    	$param['type'] 	= $type;
    	$response 		= null;

    	$res 			= $this->model->get_record($param);
    	if($res['success']){
    		$response['data'] = $res['data'];
    	}//end if
    	//$response['data'] = $this->model->get_record($param);

    	echo json_encode($response);

    }//end if

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function validate_init(){
    	$validator = [];
    	$data 					= array();
		$data['table_name'] 	= 'o'.$this->record_type;
		$header 			= $this->request->getVar('header');

		

        $rules = [
            "header.username" => [
                "label" => "email", 
                "rules" => "trim|required|valid_email|max_length[100]",
                'errors' => [
	                'required' => 'Please input an email address.',
	            ]
            ],
            "header.password" => [
                "label" => "password", 
                "rules" => "trim|required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]|max_length[50]",
                'errors' => [
	                'required' => 'Please input your password.',
	            ]
            ],
            "header.confirm_password" => [
                "label" => "confirm password", 
                "rules" => "trim|required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]|matches[header.password]|max_length[50]",
                'errors' => [
	                'required' => 'Please input your confirm password.',
	                'matches' => 'Password doesn\'t match.'
	            ]
            ]
        ];



        

		if ($this->validate($rules)){
			
			try{

			    
			    
				
				//$row 				= $this->request->getVar('row');
				//$row_keys 			= array_keys($row);
				//$line_count			= count($row['line']);
				$data['header'] 	= $header;
				//$data['lines'] 	= array();
				
				//helper("cookie");
				//throw new \Exception(get_cookie('remember_token',false));

				
				//$username 	= $this->request->getPost('username');
				//$password 	= $this->request->getPost('password');
				//throw new \Exception($request->getPost('username'));
				//$validator['success'] = $this->validate($rules);
				//$validator['messages'] = "Success!";

				//check duplicate for osignup
				$data["names"] 		= array();
				$data["names"][] 	= $header['username'];
				$res 				= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate registration for ".$res['data'][0]['username'].".");
				}//end if


				$data['table_name'] = 'ousr';
				$res 				= $this->model->check_duplicate2($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate registration for ".$res['data'][0]['username'].".");
				}//end if
				//check duplicate for osignup



				$validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Logged in successfully!");

				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}
		

		echo json_encode($validator);

    }


    public function signup($type){
    	$validator = [];
    	$data 					= array();
    	$data['table_name'] 	= 'o'.$this->record_type;
		$rules 					= array();

		$header 			= $this->request->getVar('header');

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
		


		

		if($type == 'company'){
			$rules = [
				"header.honorifics" => [
	                "label" => "prefix", 
	                "rules" => "trim|required",
	                'errors' => [
		                'required' => 'Please input prefix.',
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
	            "header.work_email" => [
	                "label" => "work email", 
	                "rules" => "trim|required|valid_email|max_length[100]",
	                'errors' => [
		                'required' => 'Please input work email.',
		            ]
	            ],
	            "header.contact_number" => [
	                "label" => "contact number", 
	                //"rules" => "trim|required|min_length[8]|mobileValidation[header.contact_number,header.dial_code]",
	                "rules" => "trim|required|min_length[8]",
					'errors' => [
	                	'required' => 'Please input contact number.',
		                'mobileValidation' => $mobile_message,
		            ]
	            ],
	            "header.company_name" => [
	                "label" => "company name", 
	                "rules" => "trim|required|max_length[100]",
	                'errors' => [
		                'required' => 'Please input company name.',
		            ]
	            ],
	            "header.location" => [
	                "label" => "location", 
	                "rules" => "trim|required|max_length[600]",
	                'errors' => [
		                'required' => 'Please input location.',
		            ]
	            ],
	            "header.designation" => [
	                "label" => "designation", 
	                "rules" => "trim|required|max_length[100]",
	                'errors' => [
		                'required' => 'Please input designation.',
		            ]
	            ],
	            "header.industry" => [
	                "label" => "industry", 
	                "rules" => "trim|required",
	                'errors' => [
		                'required' => 'Please input industry.',
		            ]
	            ]
	        ];
		}else{
			$rules = [
	            "header.username" => [
	                "label" => "email", 
	                "rules" => "trim|required|valid_email|max_length[100]",
	                'errors' => [
		                'required' => 'Please input an email address.',
		            ]
	            ]
	        ];
		}//end if
        



        

		if ($this->validate($rules)){
			
			try{
				
				
				
			
				$header 			= $this->request->getVar('header');
				unset($header['confirm_password']);
				$header['user_type'] = $type;


				
				//$row 				= $this->request->getVar('row');
				//$row_keys 			= array_keys($row);
				//$line_count			= count($row['line']);
				$data['record_header'][] 	= $header;

				if($type == 'company'){
					$data['record_header'][0]['username'] = $header['work_email'];
					$header['username'] = $header['work_email'];
				}
				//$data['lines'] 	= array();

				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $header['username'];
				$res 		= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate registration for ".$res['data'][0]['username'].".");
				}//end if
				//check duplicate

				

				
				//throw new \Exception($data['record_header'][0]['dial_code']);
				
				
				
				if($type == 'company'){
					//add record
					$res 		= $this->model->add_record($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					//audit trail
			       	$data['audit']   = array();
			       	$ids 			= $res['data']['id'];
			       	for ($x=0; $x <= count($ids) - 1; $x++) { 
			       			$data['audit'][] = array(
								'record_id' 		=> $ids[$x],
								'username' 	  		=> $data['record_header'][0]['username'],
								'action' 			=> 'created',
								'record_type' 		=> $this->record_type
							);
			       	}//end for
			       	//end audit trail
					
				}else{

					

					$data['table_name'] 					= "ousr";
					$data['record_header'] 					= $header;
					$data['record_profile'] 				= $header;
					$data['record_profile']['email_add'] 	= $data['record_profile']['username'];
					$data['record_header']['inactive'] 		= 1;
					unset($data['record_profile']['password']);
					unset($data['record_profile']['username']);
					unset($data['record_profile']['user_type']);

					
					

					//add record
					$res 		= $this->model->add_user($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					//audit trail
			       	$data['audit']   = array();
	       			$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'username' 	  		=> $data['record_header']['username'],
						'action' 			=> 'created',
						'record_type' 		=> 'user'
					);

	       			if($res['data']['profile_id'] > 0){
	       				$data['audit'][] = array(
							'record_id' 		=> $res['data']['id'],
							'username' 	  		=> $data['record_header']['username'],
							'action' 			=> 'created',
							'record_type' 		=> 'profile'
						);
	       			}//end if
			       	//end audit trail

			       	//send email
					$email = \Config\Services::email();
					//$email->setFrom('phoenixlangaman05@gmail.com', 'Phoenix Langaman');
					$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
					$email->setTo($data['record_header']['username']);
					$email->setSubject($this->lib->signup_subject);


					$email_param 		= array();
					$email_param["url"] = base_url().'/signup/activate_account?id='.$res['data']['id'];
					$email->setMessage($this->lib->signup_email_template($email_param));


					if(!$email->send()){
						throw new \Exception("Email Failed.");
					}//end if
					//end send email

				}//end if

				//insert audit trail
				if(count($data['audit']) > 0){
					$aud 	= $this->audit_trail->add($data);
					if(!$aud){
						throw new \Exception('Error on creation of audit trail.');
					}//end if
				}//end if
		       	//end insert audit trail

				$validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Great! We'll be in touch soon!");
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}
		

		echo json_encode($validator);

    }

    public function activate_account(){
    	$validator = [];
		try{

			$header 	= $this->request->getVar(null);

			
		
			$header['inactive'] 	= 0;
			$data['header'] 		= $header;

			$res = $this->model->update_rec('ousr',$data);
			if($res){
				$retval = array(
					'id' => $res
				);
			}else{
				throw new \Exception('Error on update of record.');
			}//end if
			
			
		
			$validator['success'] 		= true;
			//$validator['messages'][] 	= array("success" => "Activation link has been sent to your email!");
			$validator['messages'] 		= "Account has been successfully activated!";
			//$validator['data'] 			= $retval;
			
		}catch (\Exception $e) {
			$validator['success'] 		= false;
			$validator['messages'] 		= $e->getMessage();
			
		}//End try	
		
	
	
	if($validator['success']){
		require_once('app/Views/libraries/header.php');
		echo '	<script src="' . base_url('assets/bootstrap-4.0.0/dist/js/jquery-3.2.1.slim.min.js') . '"></script>';
		echo '<script src="' . base_url('assets/admin_dashboard/vendor/jquery/jquery.min.js') . '"></script>';
		echo '<script src="' . base_url('assets/bootstrap-4.0.0/dist/js/popper.min.js') . '"></script>';
		echo '<script src="' . base_url('assets/bootstrap-4.0.0/dist/js/bootstrap.min.js') . '"></script>';
		echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">';
		echo '<link rel="stylesheet" href="' . base_url('../../assets/bootstrap-4.0.0/dist/css/bootstrap.min.css') . '">';
		echo '<link rel="stylesheet" href="' . base_url('../../assets/main/css/styles.css') . '">';
		echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
        	  <div class="container px-4 px-lg-5 navbarcontainer">

              <a class="navbar-brand fw-bolder text-link" href="' . base_url() . '"><h2>Hoteleers</h2></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    
                </div>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted active header-navbtn" aria-current="page" href="' . base_url('job_search/private/') . '">Find Jobs</a></li>
					
					<li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="' . base_url('login/') . '">Login</a></li>

					<li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="' . base_url('signup') . '">Sign up</a></li>
                </ul>
                
              </div>
              </div>
    </nav>';
		echo '<h2 align="center" class="text-break activated-message">'.$validator['messages'].'</h2>';
		echo '<script>
				$(document).ready(function(){
					$("#loading").addClass("d-none");
				});
			  </script>';
		require_once('app/Views/libraries/copyright.php');
		require_once('app/Views/libraries/footer-menu.php');
		require_once('app/Views/libraries/footer.php');
	}else{
		echo $validator['messages'];
	}//end if

		//echo json_encode($validator);

    }

}//end class
