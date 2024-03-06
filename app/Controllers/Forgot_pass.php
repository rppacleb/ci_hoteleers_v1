<?php

namespace App\Controllers;
use App\Models\Forgot_pass_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
use App\Libraries\Pcl_lib;
class Forgot_pass extends BaseController{
	protected $model;
	protected $lib;
	public function __construct(){
		$this->model = new Forgot_pass_model();
		$this->lib 	= new Pcl_lib();
    }



    public function index(){
    	//init cookies
    	//helper("cookie");
				//throw new \Exception(get_cookie('remember_token',false));
    	$param = array(
    		"cookies_remember_token" => $this->session->get('hoteleers_remember_token'),
    		"cookies_username" => $this->session->get('hoteleers_username_token'),
    		"cookies_password" => $this->session->get('hoteleers_password_token'),
    	);
    	

				//throw new \Exception(get_cookie('remember_token',false));

		return view('Forgot_pass/index',$param);
    }//end function

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function submit(){
    	$validator = [];
		
        $rules = [
            "header.username" => [
                "label" => "email", 
                "rules" => "trim|required|valid_email|max_length[50]"
            ]
        ];

        

		if ($this->validate($rules)){
			
			try{

				helper("cookie");
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
				}

				$email_param = array();
				$email_param['name'] = $email_name;
				$email_param['url_reset'] = base_url('new_pass?id='.$res['data']->id.'');

				//send email
				$email = \Config\Services::email();
				$email->setFrom($this->lib->system_email, $this->lib->system_email_name);
				$email->setTo($res['data']->username);
				$email->setSubject('Forgot Password');
				$email->setMessage($this->lib->forgot_password_template($email_param));
				$email->setMailType('html');

				if(!$email->send()){
					throw new \Exception("Email Failed!");
				}

				
			  $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Reset password instruction has been sent to ".$res['data']->username."!");
				
				
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
