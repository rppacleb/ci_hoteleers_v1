<?php

namespace App\Controllers;
use App\Models\New_pass_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
class New_pass extends BaseController{
	protected $model;

	public function __construct(){
		$this->model = new New_pass_model();
		
    }

    public function index(){
    	$request = $this->request->getVar();
    	$param 	 = array();
    	if(!isset($request['id'])){
    		return redirect()->to(base_url('login/'));
    	}//end if

    	$res = $this->model->get_user($request);
    	if($res['num_rows'] <= 0){
    		return redirect()->to(base_url('login/'));
    	}else{
    		$param["email"] = $res['data']->username;
    		//echo json_encode($param);
    		
    	}//end if

		return view('New_pass/index',$param);
    }//end function

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function submit(){
    	$validator = [];
		
        $rules = [
            "header.username" => [
                "label" => "username", 
                "rules" => "trim|required|max_length[50]"
            ],
           
            "header.new_password" => [
                "label" => "new password", 
                "rules" => "trim|required|max_length[50]"
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

				//check user password
				/*
				$res 		= $this->model->auth_user($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				*/
				//end check user password

				//update password

				$data['record_header'] = array(
					"id" 		=> $res['data']->id,
					"password" 	=> $data['header']['new_password']
				);
				
				
				$res 		= $this->model->update_record($data);				
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end update password

				
			    $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Operation successfuly completed!");
				
				
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
