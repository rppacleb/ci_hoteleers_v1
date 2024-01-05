<?php

namespace App\Controllers;
use App\Models\User_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;
class User extends BaseController{
	protected $model;
	protected $session;
	protected $audit_trail;
	protected $record_type;
	protected $lib;

	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new User_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= 'employer';
		$this->session 			= session();
    }

    public function index(){
    
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			
  			$request 				= $this->request->getVar() === null? "" : $this->request->getVar();
  			if(!isset($request["employer"])){
  				return redirect()->to(base_url('employer/'));
  			}//end if

  			//get status
  			$param = array();
  			$param['table_name'] 	= "ostatus";
  			//$param['filter_field'] 	= "id";
  			//$param['filter_value'] 	= $request["employer"];
  			$res 	= $this->model->get_master_data($param);
  			$response 	= array();
  			if($res['num_rows'] > 0){
  				$response['status'] = $res['data'];
  			}//end if

  			//get employer name
  			if(isset($request["employer"])){
  				$param = array();
	  			$param['table_name'] 	= "oemployer";
	  			$param['filter_field'] 	= "id";
	  			$param['filter_value'] 	= $request["employer"];
	  			$res 	= $this->model->get_master_data($param);
	  			
	  			if($res['num_rows'] > 0){
	  				$response['employer'] = $res['data'];
	  			}//end if
  			}//end if
  			

  			$response['country_dial_code'] = $this->lib->get_country_code();
  	
    	
  			
			return view('User/index',$response);
  		}//end if
        
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

	

	public function get_master_data($type){
		$data;
		$param 			= [];
		//pagination
		$res 			= $this->model->get_master_data($type);
		if($res['num_rows'] > 0){
	    	$param["data"] 			= $res['data'];
	    	$param["num_rows"] 		= $res['num_rows'];
		}else{
			$param["data"] 			= null;
	    	$param["num_rows"] 		= 0;
		}//end if
		
    	echo json_encode($param);
    	//end pagination
	}//end function

    public function logout(){

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

		unset($_SESSION['userid']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['usertype']);
		unset($_SESSION['name']);
    	//session_destroy();
    	return redirect()->to(base_url('Login/'));
    }

    public function delete_data(){
    	$validator 	= [];
    	$param 		= $this->request->getVar();
    	
			try{


				$data 					= array();
				$data['table_name'] 	= 'ousr';
				$data['record_header'] 	= $param['header'];
				
				//check related records
				
				//job post
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "created_by";
				$data["rr_table"] 				= "ojob_post";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end if
				//end job post

				//job post applicant
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "user_id";
				$data["rr_table"] 				= "job_post_applicant";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end if
				//end job post applicant

				//job_post_report
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "user_id";
				$data["rr_table"] 				= "job_post_report";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end job_post_report


				//job_post_trending
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "user_id";
				$data["rr_table"] 				= "job_post_trending";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end job post
				//end job_post_trending


				/*
				//profile
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "oprofile";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile

				//profile_affiliations
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_affiliations";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_affiliations

				//profile_awards_achievements
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_awards_achievements";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_awards_achievements

				//profile_certifications_licenses
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_certifications_licenses";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_certifications_licenses

				//profile_department
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_department";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_department

				//profile_education
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_education";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_education

				//profile_experience
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_experience";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_experience

				//profile_industry
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_industry";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_industry

				//profile_job_level
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_job_level";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_job_level

				//profile_job_type
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_job_type";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_job_type

				//profile_language
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_language";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_language


				//profile_projects
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_projects";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_projects

				//profile_seminars_trainings
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_seminars_trainings";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_seminars_trainings

				//profile_skills
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "profile_skills";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end profile_skills

				//usr_job_post_fav
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "id";
				$data["rr_table"] 				= "usr_job_post_fav";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module");
				}//end job post
				//end usr_job_post_fav
				*/

				//delete record
				$res 		= $this->model->delete_record($data);
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end delete record
				


		       	//audit trail
		       	$data['audit']   = array();
				$data['audit'][] = array(
					'record_id' 		=> $data['record_header']['id'],
					'user_id' 	  		=> $this->session->get('userid'),
					'action' 			=> 'deleted',
					'record_type' 		=> 'user'
				);
				$aud 	= $this->audit_trail->add($data);
				if(!$aud){
					throw new \Exception('Error on creation of audit trail.');
				}//end if
		       	//end audit trail

		       	$validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			       	
			       	
				
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function


    public function submit_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
    	
			try{
				
				//$row 					= $this->request->getVar('row');
				//$row_keys 			= array_keys($row);
				//$line_count			= count($row['line']);

				$data['table_name'] 	= 'osignup';
				$data['record_header'] 	= $param['header'];
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['username'];
				$data["dup_filter"] = "username";
				$data["dup_table"] 	= "ousr";
				$res 		= $this->model->check_duplicate($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Duplicate entry ".$res['data'][0]['name'].".");
				}//end if
				//check duplicate
				//end check duplicate

				
				//Set Audit Trail
				$data['audit'] 	= array();
				$header_keys 	= array_keys($data['record_header']);
				$res 			= $this->audit_trail->get_current_header_record($data['record_header']['id'],$data['table_name']);
				for ($i = 0; $i <= count($header_keys) - 1; $i++) {
					if($data['record_header'][$header_keys[$i]] != $res[0][$header_keys[$i]]){
						$data['audit'][] = array(
							'user_id' 	  				=> $this->session->get('userid'),
							'action' 					=> 'updated',
							'record_id' 				=> $data['record_header']['id'],
							'record_type' 				=> $this->record_type,
							'record_field' 				=> $header_keys[$i],
							'record_field_old_value' 	=> $res[0][$header_keys[$i]],
							'record_field_new_value' 	=> $data['record_header'][$header_keys[$i]]
						);
					}//End if
				}//End for
				//End Set Audit Trail

				//Insert Audit Trail
				if(count($data['audit']) > 0){
					$res 			= $this->audit_trail->add($data);
					if(!$res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail


				


				//create employer
				if($data['record_header']['status'] == 2){ //approved
					$data['employer'] 	= array();
					$data['employer'][] = "insert into oemployer(company_name,location,lat,lng,locality,administrative_area_level_1,country,industry,signup)
									   		select company_name,location,lat,lng,locality,administrative_area_level_1,country,industry,id
									   		from osignup where id = '".$data['record_header']['id']."'";
				

					

				}//end if
				//end create employer

				//update record
				$res 		= $this->model->update_record($data);		
				if(!$res['success']){
					throw new \Exception($res['message']);
				}//end if
				//end add record

				//audit trail
				if($res['data']['employer_id'] > 0){
					$data['audit']   = array();
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['employer_id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'employer'
					);
				}//end if
		       	
		       	//end audit trail

				//Insert Audit Trail
				if(count($data['audit']) > 0){
					$res 			= $this->audit_trail->add($data);
					if(!$res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				//End Insert Audit Trail



				
					


			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			       	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

}//end class
