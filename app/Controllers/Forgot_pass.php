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
				$res 		= $this->model->check_existence($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end check user existence

				



				//update password
				$data['record_header'] = array(
					"id" 		=> $res['data']->id,
					"password" 	=> $this->lib->random_password()
				);


				//send email
				$email = \Config\Services::email();
				$email->setFrom($res['data']->username, $res['data']->name);
				$email->setTo($res['data']->username);
				//$email->setCC('another@another-example.com');
				//$email->setBCC('them@their-example.com');
				$email->setSubject('Forgot Password');
				$email->setMessage("New Password : ".$data['record_header']["password"]."");
				if(!$email->send()){
					throw new \Exception("Email Failed!");
				}//end if

				$res_update 		= $this->model->update_record($data);				
				if(!$res_update['success']){
					throw new \Exception($res_update['message']);
				}//end if
				//end update password

				
				//end send email

				
			    $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "New password has been sent to ".$res['data']->username."!");
				
				
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
