<?php

namespace App\Controllers;
use App\Models\Manage_dropdown_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;

class Manage_dropdown extends BaseController{
	protected $lib;
	protected $model;
	protected $audit_trail;
	protected $record_type;
	public function __construct(){
		$this->lib 				= new Pcl_lib();
		$this->model 			= new Manage_dropdown_model();
		$this->audit_trail 		= new Audit_trail_model();
		$this->record_type 		= '';
    }

    public function index(){
    	
    	//$session = \Config\Services::session();
		if(!$this->session->has('username')){
			return redirect()->to(base_url('login/'));
  		}else{
  			
  			if($this->session->get('usertype')!='admin'){
				return redirect()->to(base_url());
			}else{
				
				return view('Manage_dropdown/index');
			}
  		}
    	//echo $this->session->get('username');
    	//echo $session->get('usertype');
        
    }//end function

    public function get_record($type){
    		$data;
    	
    		$param 			= [];
    		//pagination
    		$res 			= $this->model->get_record($type,null,null);
    		if($res['num_rows'] > 0){
    			$data 			= $res['data'];
	    		$total_result 	= $res['num_rows'];
	    		$page 			= (int)(($this->request->getVar('page')!==null && $this->request->getVar('page')!=0)?$this->request->getVar('page'):1)-1;
	    		$per_page 		= 20;
		    	$offset 		= $page * $per_page;
		    	$total_page 	= ceil($total_result/$per_page);


		    	$res 					= $this->model->get_record($type,$per_page,$offset);
		    	$param["data"] 			= $res['data'];
		    	$param["total_page"] 	= $total_page;
    		}else{
    			$param["data"] 			= null;
		    	$param["total_page"] 	= 0;
    		}//end if
    		
	    	echo json_encode($param);
	    	//end pagination
    	
	}//end if

	public function load_data($type,$id){
			
    		$param 			= [];

    		
    		//pagination
    		$res 			= $this->model->load_data($type,$id);
    		if($res['num_rows'] > 0){
		    	$param["data"] 			= $res['data'];
		    	$param["num_rows"] 		= $res['num_rows'] ;
    		}else{
    			$param["data"] 			= null;
		    	$param["num_rows"] 		= 0;
    		}//end if
    		
	    	echo json_encode($param);
	    	//end pagination
    	
	}//end if


    public function delete_data(){
    	$validator 	= [];
    	$param 		= $this->request->getVar();
    	
			try{

				$data 				= array();
				$header 			= $this->request->getVar();
				


				$this->record_type  	= $header['type'];
				$data['table_name'] 	= 'o'.$this->record_type;
				$data['user_id'] 		= $this->session->get('userid');
				$data['record_header'] 	= $header;
				
				//check related records
				//signup
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "industry";
				$data["rr_table"] 				= "osignup";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end if

				//employer
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "industry";
				$data["rr_table"] 				= "oemployer";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end employer

				//job post
				$data["rr_filter_name"] 		= array();
				$data["rr_filter_name"][] 		= $data['record_header']['id'];
				$data["rr_filter"] 				= "industry";
				$data["rr_table"] 				= "ojob_post";
				$res 		= $this->model->check_related_records($data);
				if($res['num_rows'] > 0){
					throw new \Exception("Unable to delete record. Related item found in ".$res['data'][0]['type']." module.");
				}//end job post
				//end check related records

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
					'record_type' 		=> $this->record_type
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
    

    public function save_data($type){
    	$validator 				= [];
    	$rules 					= [];
    	$data 					= array();
    	$this->record_type  	= $type;
    	$data['table_name'] 	= 'o'.$this->record_type;


    	$rules = [
            "row.name" => [
                "label" => str_replace('_', ' ',$this->record_type)." name", 
                "rules" => "trim|required|max_length[200]"
            ]
        ];
        //$data['table_name'] 	= 'oeduc';
        $data['type'] 			= $this->record_type;

        /*
		if($type == 'education'){
			
		}else if($type == 'job_type'){
			$rules = [
	            "row.name" => [
	                "label" => "job type name", 
	                "rules" => "trim|required|max_length[200]"
	            ]
	        ];
	        //$data['table_name'] 	= 'ojob';
	        $data['type'] 			= $this->record_type;
		}else if($type == 'industry'){
			$rules = [
	            "row.name" => [
	                "label" => "industry name", 
	                "rules" => "trim|required|max_length[200]"
	            ]
	        ];
	        //$data['table_name'] 	= 'ojob';
	        $data['type'] 			= $this->record_type;
		}else if($type == 'department'){
			$rules = [
	            "row.name" => [
	                "label" => "industry name", 
	                "rules" => "trim|required|max_length[200]"
	            ]
	        ];
	        //$data['table_name'] 	= 'ojob';
	        $data['type'] 			= $this->record_type;
		}//end if//end if
		*/
        

        

		if ($this->validate($rules)){
			
			try{

				
				$header 					= $this->request->getVar('header');
				$row 						= $this->request->getVar('row');
				$row_keys 					= array_keys($row);
				$line_count					= count($row['name']);

				$data['record_header'] 		= $header;
				$data['record_lines'] 		= array();
				
				
				
				

				if(isset($data['record_header']['inactive'])){
					$data['record_header']['inactive'] 	= $data['record_header']['inactive']=='on'? true : false;	
				}else{
					$data['record_header']['inactive'] 	= false;
				}//end if

				
				
			
				if(isset($data['record_header']["id"])){
					//throw new \Exception(json_encode($header));
					
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
					

					//update record
					$res 		= $this->model->update_record($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end update record

					//Insert Audit Trail
					if(count($data['audit']) > 0){
						$res 			= $this->audit_trail->add($data);
						if(!$res){
							throw new \Exception("Error on creating audit trail.");
						}//End if
					}//End if
					//End Insert Audit Trail

				
				}else{
					//Insert Lines
					
					$data["names"] = array();
					for ($x=0; $x <= $line_count - 1; $x++) { 
						$data_row 			= array();
						//$data_row['id'] 	= $res;
						for ($i=0; $i < count($row_keys); $i++) { 
							$data_row[$row_keys[$i]] = $row[$row_keys[$i]][$x];
						}//end for
						if($data['table_name'] == 'operks_and_benefits'){
							$data_row['created_by'] 	= $this->session->get('userid');
						}//end if
						
						$data['record_lines'][] 	= $data_row;

						$data["names"][] 			= $data_row["name"];
					}//end for
					//end insert lines
					//$data["names"] = substr($data["names"], 0, strlen($data["names"]) - 1);



					$data['user_id']	 = $this->session->get('userid');

					
					

					//check removed
					//============================================================
					if($data['type'] == 'perks_and_benefits'){
						$data['record_lines_delete'] = array();
						$res 				= $this->model->check_removed($data);
						

						//throw new \Exception(json_encode($res['data']));
						if($res['num_rows'] > 0){

							//throw new \Exception("Duplicate entry ".$res['data'][0]['name']."");
							for ($x=0; $x <= count($res['data']) - 1; $x++) {
								$index_to_remove = array_search(strtolower($res['data'][$x]['name']),array_map('strtolower', $data['names']));
								//$index_to_remove_2 = array_search(strtolower($res['data'][$x]['name']),array_map('strtolower', $data['record_lines']));
								//throw new \Exception($index_to_remove);

								if($index_to_remove >= 0){
									$data['record_lines_delete'][] = $res['data'][$x]['id'];
									unset($data['names'][$index_to_remove]);
									$data['names'] = array_values($data['names']);

									//unset($data['record_lines'][$index_to_remove_2]);
									//
								}//end if
								
								//
							}//end for

							for ($x=0; $x <= count($data['record_lines']) - 1; $x++) {
								$index_to_remove = array_search(strtolower($data['record_lines'][$x]['name']),array_map('strtolower', $data['record_lines_delete']));
								if($index_to_remove >= 0){
									unset($data['record_lines'][$index_to_remove]);
									$data['record_lines'] = array_values($data['record_lines']);
								}//end if
							}//end for

						}//end if

					}//end if
					//============================================================
					//end check removed

					//throw new \Exception($str);

					//throw new \Exception(json_encode($data['record_lines_delete']));

					//throw new \Exception(json_encode($data['record_lines']));
			
					//check duplicate
					if(count($data['names']) > 0){
						$res 				= $this->model->check_duplicate($data);
						//for ($x=0; $x <= count($res['data']) - 1; $x++) {
							//throw new \Exception(array_search(strtolower($res['data'][$x]['name']),array_map('strtolower', $data['names'])));
						//}//end for
						if($res['num_rows'] > 0){
							throw new \Exception("Duplicate entry ".$res['data'][0]['name'].".");
						}//end if
					}//end if
					//check duplicate

					
					
					

					
					//add record
					$res 		= $this->model->add_record_batch($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

			       	//audit trail
			       	$data['audit']   = array();

			       	$ids = $res['data']['id'];
			       	for ($x=0; $x <= count($ids) - 1; $x++) { 
			       			$data['audit'][] = array(
								'record_id' 		=> $ids[$x],
								'user_id' 	  		=> $this->session->get('userid'),
								'action' 			=> 'created',
								'record_type' 		=> $this->record_type
							);
			       	}//end for
					$aud 	= $this->audit_trail->add($data);
					if(!$aud){
						throw new \Exception('Error on creation of audit trail.');
					}//end if
					
			       	//end audit trail

				}//end if

				$validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}//end if
		

		echo json_encode($validator);
    }//end function


    public function update_data($type){
    	$validator 				= [];
    	$rules 					= [];
    	$data 					= array();
    	$this->record_type  	= $type;
    	$data['table_name'] 	= 'o'.$this->record_type;

    	$rules = [
            "header.name" => [
                "label" => str_replace('_', ' ',$this->record_type)." name", 
                "rules" => "trim|required|max_length[200]"
            ]
        ];
        //$data['table_name'] 	= 'oeduc';
        $data['type'] 			= $this->record_type;

		
        

        

		if ($this->validate($rules)){
			
			try{

				
				$header 					= $this->request->getVar('header');
				

				$data['record_header'] 		= $header;
				
				
				

				if(isset($data['record_header']['inactive'])){
					$data['record_header']['inactive'] 	= $data['record_header']['inactive']=='on'? true : false;	
				}else{
					$data['record_header']['inactive'] 	= false;
				}//end if
				
			
				if(isset($data['record_header']["id"])){
					//throw new \Exception(json_encode($header));
					
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
					

					//update record
					$res 		= $this->model->update_record($data);
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end update record

					//Insert Audit Trail
					if(count($data['audit']) > 0){
						$res 			= $this->audit_trail->add($data);
						if(!$res){
							throw new \Exception("Error on creating audit trail.");
						}//End if
					}//End if
					//End Insert Audit Trail

				
				}//end if

				$validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		}else{
			$validator['success'] 		= false;
			$validator['messages'][] 	= $this->validation->getErrors();
		}//end if
		

		echo json_encode($validator);
    }//end function


    public function remove_data(){
    	$validator 			= [];
    	$data 				= array();
    	$param 				= $this->request->getVar();
			try{

				

				$data['response'] 				= array();
				$data['table_name'] 			= 'operks_and_benefits_removed';
				$data['type'] 					= 'perks_and_benefits_removed';
				$data['record_header'] 			= array();
				$data['audit'] 					= array();

				$data['record_header'] 					= $param['header'];
				$data['record_header']['user_id'] 		= $this->session->get('userid');
				if($this->session->get('userid') === null){
					throw new \Exception("Please login to proceed.");
					
				}//end if

				
				
				
				
				
				
				//check duplicate
				$data["names"] 		= array();
				$data["names"][] 	= $data['record_header']['id'];
				$data["dup_id"] 	= $data['record_header']['id'];
				$data["dup_filter"] = "id";
				$data["dup_table"] 	= "operks_and_benefits_removed";

				$res 				= $this->model->check_duplicate_removed($data);
				
				if($res['num_rows'] > 0){
					throw new \Exception('This item has already been deleted.');
					
				}else{

					//add record
					//--------------------------------------------------------------------------------------------------

					
					$res 		= $this->model->add_record($data);		
					if(!$res['success']){
						throw new \Exception($res['message']);
					}//end if
					//end add record

					

					
					$data['response'] = array(
						'id' => $data['record_header']['id']
					);

					//set Audit Trail
					$data['audit'][] = array(
						'record_id' 		=> $res['data']['id'],
						'user_id' 	  		=> $this->session->get('userid'),
						'action' 			=> 'created',
						'record_type' 		=> 'employer_saved_applicant'
					);
					//End Audit Trail
					//--------------------------------------------------------------------------------------------------
					//end add record
				}//end if
				//check duplicate
				//end check duplicate

				

	
					
				
		


				//Insert Audit Trail header
				if(count($data['audit']) > 0){
					$audit_res 			= $this->audit_trail->add($data);
					if(!$audit_res){
						throw new \Exception("Error on creating audit trail.");
					}//End if
				}//End if
				$data['audit']   = array();
				//End Insert Audit Trail header

				

			

			    $validator['success'] 		= true;
				// $validator['messages'][] 	= array("success" => "Successfully completed");
				$validator['messages'][] 	= array("success" => "Successfully completed.");
			    $validator['data'] 			= $data['response'];  	
			
				
			}catch (\Exception $e) {
				$validator['success'] 		= false;
				$validator['messages'][] 	= array("exception" => $e->getMessage());
				
			}//End try	
			
		
		

		echo json_encode($validator);
	
    }//end function

}//end class
