<?php

namespace App\Controllers;
use App\Models\Login_model;
use App\Models\Audit_trail_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
class Login extends BaseController{
	protected $model;

	protected $validation;
	protected $session;

	protected $audit_trail;
	protected $record_type;

	public function __construct(){
		$this->model 			= new Login_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'login';

		$this->session 			= Services::session();
		$this->validation 		= Services::validation();
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

    	$param = array(
    		"cookies_remember_token" => $this->session->get('hoteleers_remember_token'),
    		"cookies_username" => $this->session->get('hoteleers_username_token'),
    		"cookies_password" => $this->session->get('hoteleers_password_token'),
    	);

    	$this->model->update_not_logged_out();
    	$this->model->archive_job_post();

    	
    	
    	if($this->session->get('userid') !== null){
    		return redirect()->to(base_url('Home/'));
    	}//end if

		return view('Login/index',$param);
    }//end function

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function login(){
    	$validator = [];
		
        $rules = [
            "header.username" => [
                "label" => "email", 
                "rules" => "trim|required|valid_email|max_length[50]",
                'errors' => [
	                'required' => 'Please input an email address.',
	            ]
            ],
            "header.password" => [
                "label" => "password", 
                "rules" => "trim|required|max_length[50]",
                'errors' => [
	                'required' => 'Please input your password.',
	            ]
            ]
        ];



        

		if ($this->validate($rules)){
			
			try{

				helper("cookie");
				$header 				= $this->request->getVar('header');
				//$row 				= $this->request->getVar('row');
				//$row_keys 			= array_keys($row);
				//$line_count			= count($row['line']);
				$data['header'] 		= $header;
				$data['record_header'] 	= array();
				
				
				//helper("cookie");
				//throw new \Exception(get_cookie('remember_token',false));

				
				//$username 	= $this->request->getPost('username');
				//$password 	= $this->request->getPost('password');
				//throw new \Exception($request->getPost('username'));
				//$validator['success'] = $this->validate($rules);
				//$validator['messages'] = "Success!";

				$res 		= $this->model->auth_email($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if

				
				
				$res 		= $this->model->auth_user($data);
				if($res['success']){
					if($res['data']->user_type !== "admin"){

						if($res['data']->user_type == "employer"){

							if($res['data']->activated <> "Activated"){
								
								
								throw new \Exception("Employer is ".$res['data']->activated);
							}else{
								if($res['data']->deactivated){
									throw new \Exception("Employer is deactivated.");
								}//end if
							}//end if
							
						}else{
							if($res['data']->activated <> "Activated"){
								throw new \Exception("User is ".$res['data']->activated);	
							}//end if
						}

					

						if($res['data']->logged_in){
							throw new \Exception("User is already logged in.");
						}//end if
						
					}//end if

					
					//throw new \Exception("User is ".$res['data']->activated);
					
					/*$_SESSION['userid']   				= $res['data']->id;
					$_SESSION['doc_image']   			= $res['data']->doc_image;
					$_SESSION['employer_doc_image']   	= $res['data']->employer_doc_image;
					$_SESSION['username'] 				= $res['data']->username;
			       	$_SESSION['password'] 				= $res['data']->password;
			       	$_SESSION['usertype'] 				= $res['data']->user_type;
			       	$_SESSION['name'] 					= $res['data']->name;
			       	$_SESSION['employer'] 				= $res['data']->employer;*/

			       	/*$this->session->set('userid', $res['data']->id, 100000);
			       	$this->session->set('doc_image', $res['data']->doc_image, 100000);
			       	$this->session->set('employer_doc_image', $res['data']->employer_doc_image, 100000);
			       	$this->session->set('username', $res['data']->username, 100000);
			       	$this->session->set('password', $res['data']->password, 100000);
			       	$this->session->set('usertype', $res['data']->user_type, 100000);
			       	$this->session->set('name', $res['data']->name, 100000);
			       	$this->session->set('employer', $res['data']->employer, 100000);*/

			       	//$this->session->sess_expiration = '30';

			       	$this->session->set('userid', $res['data']->id);
			       	$this->session->set('doc_image', $res['data']->doc_image);
			       	$this->session->set('employer_doc_image', $res['data']->employer_doc_image);
			       	$this->session->set('username', $res['data']->username);
			       	$this->session->set('password', $res['data']->password);
			       	$this->session->set('usertype', $res['data']->user_type);
			       	$this->session->set('name', $res['data']->name);
			       	$this->session->set('employer', $res['data']->employer);
			       	//$this->session->sess_expiration = '14400'

			       	$data['record_header']['id'] = $res['data']->id;

			       	//set expiration to 1 hour
			       	if($res['data']->user_type == "employer"){
			       		/*$this->session->markAsTempdata([
							'userid' => 600,
							'doc_image' => 600,
							'employer_doc_image' => 600,
							'username' => 600,
							'password' => 600,
							'usertype' => 600,
							'name' => 600,
							'employer' => 600
						]);*/
						

						
			       	}//end if
					
					
		       		//end set expiration to 1 hours

			       	//create cookies
			       	if(isset($data['header']['remember'])){
			       		
			       		//$_SESSION['hoteleers_remember_token'] = 'checked';
			       		//$_SESSION['hoteleers_username_token'] = $res->username;
			       		//$_SESSION['hoteleers_password_token'] = $res->password;

			       		$this->session->set('hoteleers_remember_token', 'checked', 604800);
			       		$this->session->set('hoteleers_username_token', $res['data']->username, 604800);
			       		$this->session->set('hoteleers_password_token', $res['data']->password, 604800);

						//$store = new CookieStore([$cookie]);
			       	}else{
			       		unset($_SESSION['hoteleers_remember_token']);
						unset($_SESSION['hoteleers_username_token']);
						unset($_SESSION['hoteleers_password_token']);
			       		//delete_cookie('hoteleers_remember_token');
			       		//delete_cookie('hoteleers_username');
			       		//delete_cookie('hoteleers_password');
			       	}//end if
			       	//end create cookies

			       	$res = $this->model->update_last_logged_in($data);
			       	if(!$res['success']){
			       		throw new \Exception($res['message']);
			       		
			       	}//end if


			       	//audit trail
			       	$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> 0,
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'logged in',
						'record_type' 		=> $this->record_type
					);
					$aud 	= $this->audit_trail->add($data);
					if(!$aud){
						throw new \Exception('Error on creation of audit trail.');
					}//end if
			       	//end audit trail

			       	$validator['success'] 		= true;
					$validator['messages'][] 	= array("success" => "Logged in successfully!");
					$validator['user_type'] 	= $_SESSION['usertype'];
			       	
			       	
				}else{
					throw new \Exception($res['message']);
					$validator['success'] 		= false;
					$validator['messages'][] 	= array("exception" => "Invalid Username/Password!");
				}
				
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

}//end class
