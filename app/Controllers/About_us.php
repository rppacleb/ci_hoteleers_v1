<?php

namespace App\Controllers;
use App\Models\About_us_model;
use App\Models\Audit_trail_model;
class About_us extends BaseController{
	protected $model;
	protected $record_type;
	public function __construct(){
		$this->model 		= new About_us_model();
		$this->audit_trail 	= new Audit_trail_model();
		$this->record_type 	= 'user';
		
    }

    public function index(){

    	$param 							= [];
    	
    	//variable
    	$response['home_page_banner'] 	= array();
    	//end variable

		$param['table_name'] 	= 'ohomepage_banner';
		$param['filter'] 		= '1';
		$res = $this->model->get_banner($param);



		if($res['num_rows'] > 0){
			$response['home_page_banner'] = $res['data'];
		}//end if

		return view('About_us/index',$response);
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
    		$per_page 		= 15;
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

    public function logout(){
    	
    	session_destroy();
    	return redirect()->to(base_url('/'));
    }

}//end class
