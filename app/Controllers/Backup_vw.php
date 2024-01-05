<?php

namespace App\Controllers;
use App\Models\Backup_vw_model;

class Backup_vw extends BaseController{
	protected $model;

	public function __construct(){
		$this->model = new Backup_vw_model();
		
    }

    public function index(){
    	
    	//$session = \Config\Services::session();
		if($this->session->get('username')==''){
			return redirect()->to(base_url('login/'));
  		}else{
  			
  			$data['data'] 	= $this->get_backup_files();
  			return view('Backup_vw/index',$data);
  		}
    	//echo $this->session->get('username');
    	//echo $session->get('usertype');
        
    }//end function

    public function get_backup_files(){
    	$param 				= [];
    	define('DS', DIRECTORY_SEPARATOR);
    	$path = FCPATH . DS . "backup" . DS;
    	$files = array_diff(scandir($path), array('.', '..'));
		$param = $files;

    	return $param;
    }//end if
    

    public function backup_db(){
    	$validator = [];
    	try{
	    	$param = [];
	    	define('DS', DIRECTORY_SEPARATOR);

			$database = 'pcl_feliza';
			$user = 'root';
			$pass = '';
			$host = 'localhost';
			$dir = FCPATH . DS . "backup" . DS . "backup-" . date("d-m-Y-His") . ".sql";

			$mysqlDir = 'C:'.DS.'xampp'.DS.'mysql'.DS.'bin';    // Paste your mysql directory here and be happy
			$mysqldump = $mysqlDir.DS.'mysqldump';

			//echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
			exec("{$mysqldump} --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
			$validator['success'] 		= true;
			// $validator['messages'][] 	= array("success" => "Successfully completed");
			$validator['messages'][] 	= array("success" => "Successfully completed.");

		}catch (\Exception $e) {
			$validator['success'] 		= false;
			$validator['messages'][] 	= array("exception" => $e->getMessage());
			
		}//End try
		echo json_encode($validator);
    }

    public function restore_db(){
    	$validator = [];
    	try{
    		$name 			= $this->request->getVar('name');
	    	define('DS', DIRECTORY_SEPARATOR);

			$database = 'pcl_feliza';
			$user = 'root';
			$pass = '';
			$host = 'localhost';
			//$dir = FCPATH . DS . "backup" . DS . "backup-" . date("d-m-Y-His") . ".sql";
			$dir = FCPATH . DS . "backup" . DS . $name;

			$mysqlDir = 'C:'.DS.'xampp'.DS.'mysql'.DS.'bin';    // Paste your mysql directory here and be happy
			$mysqldump = $mysqlDir.DS.'mysql';

			//echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
			exec("{$mysqldump} --user={$user} --password={$pass} --host={$host} {$database} < {$dir}", $output);
			$validator['success'] 		= true;
			// $validator['messages'][] 	= array("success" => "Successfully completed");
			$validator['messages'][] 	= array("success" => "Successfully completed.");
		}catch (\Exception $e) {
			$validator['success'] 		= false;
			$validator['messages'][] 	= array("exception" => $e->getMessage());
			
		}//End try
		echo json_encode($validator);
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

}//end class
