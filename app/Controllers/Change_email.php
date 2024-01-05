<?php

namespace App\Controllers;
use App\Models\Change_email_model;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;
use App\Libraries\Pcl_lib;
class Change_email extends BaseController{
	protected $model;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Change_email_model();
		
    }

    public function index(){
    	

		return view('Change_email/index');
    }//end function

    public function test(){
		echo $this->session->get('usertype');
    }

    

    public function submit(){
    	$validator = [];
		
        $rules = [
            "header.email_add" => [
                "label" => "email", 
                "rules" => "trim|required|valid_email|max_length[100]"
			],
			"placeholder.verification_code" => [
                "label" => "verification code", 
                "rules" => "trim|required|max_length[5]"
            ]
        ];

        

		if ($this->validate($rules)){
			
			try{
				
				
				$data = $this->request->getVar();
				$res = $this->model->check_code($data);
				$req_data = array();

				if(!$res["success"]){
					throw new \Exception($res["message"]);
				}//end if

				if($res["data"]->validity_hours > 2){
					throw new \Exception("Verification code is expired.");
				}//end if

			
				$req_data["record_header"] = array();
				
				$req_data["record_header"]["id"] = $data["header"]["id"];
				$req_data["record_header"]["verification_code"] = $data["placeholder"]["verification_code"];
				$req_data["record_header"]["inactive"] = 1;

				$req_data["record_ousr"] = array();
				$req_data["record_ousr"]["id"] = $data["header"]["id"];
				$req_data["record_ousr"]["username"] = $data["header"]["email_add"];
				$req_data["record_ousr"]["email_add"] = $data["header"]["email_add"];

				$req_data["record_profile"] = array();
				$req_data["record_profile"]["id"] = $data["header"]["id"];
				$req_data["record_profile"]["email_add"] = $data["header"]["email_add"];



				//update record
				//--------------------------------------------------------------------------------------------------
				$res 		= $this->model->update_record($req_data);		
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//--------------------------------------------------------------------------------------------------
				//end update record

			    $validator['success'] 		= true;
				$validator['messages'][] 	= array("success" => "Successfully completed.");
				
				
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
