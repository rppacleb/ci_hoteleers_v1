<?php

namespace App\Controllers;
use App\Models\Change_pass_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
use App\Libraries\Pcl_lib;
class Change_pass extends BaseController{
	protected $model;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Change_pass_model();
		
    }

    public function index(){
    	

		return view('Change_pass/index');
    }//end function

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function submit(){
    	$validator = [];
		
        $rules = [
            "header.username" => [
                "label" => "email", 
                "rules" => "trim|required|max_length[100]"
            ]
        ];

        

		if ($this->validate($rules)){
			
			try{

				
				
				$header 			= $this->request->getVar('header');

				
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

				//check user existence

				
				$email_name = "";
				$res 		= $this->model->check_existence($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}else{
					$email_name = $res["data"]->name;
				}//end if

				
				//end check user existence


				//check user password
				$res 		= $this->model->auth_user($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end check user password

				
				
				//send email
				$subject = "Change Password";
				$message = 'Click <a href="'.base_url('new_pass?id='.$res['data']->id.'').'">here</a> to change your password';
				
				
				$email = \Config\Services::email();
				$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
				$email->setTo($res['data']->username);
				$email->setSubject($this->lib->change_password_subject);


				$email_param 							= array();
				$email_param['name'] 					= $email_name;
				$email_param['url_change_password'] 	= base_url('new_pass?id='.$res['data']->id.'');
				$email_param['url_report'] 				= base_url('login');

				$email->setMessage($this->lib->change_password_applicant_template($email_param));

				//$email->setMessage($message);
				if(!$email->send()){
					$validator['messages'][] = "Email Failed!";
				}//end if
				//end send email
				

				
			    $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "An email has been sent to ".$res['data']->username."");
				
				
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
