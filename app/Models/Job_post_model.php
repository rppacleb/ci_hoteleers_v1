<?php
namespace App\Models;

use CodeIgniter\Model;

class Job_post_model extends Model {
	protected $table      = 'ousr';
    protected $primaryKey = 'id';

    //protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password'];

    //protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;

		

	function get_record($type,$request,$perPage,$offset){
    		$response 	= [];
    		$qrystr 	= "";

            $qrystr     = "SELECT   t0.id,
                                    t0.job_title,
                                    t0.location AS 'location',
                                    t1.name AS 'industry_text',
                                    t2.company_name,
                                    t0.vacancies,
                                    t0.inactive,
                                    (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'date_created',
                                    t0.date_posted,
                                    t0.pinned,
                                    DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'), STR_TO_DATE(DATE_FORMAT(t0.date_created,'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p')) AS 'days_past',
                                    DATEDIFF(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'), STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Yp')) AS 'remaining_days',
                                    (CASE WHEN (t0.remove_on IS NOT NULL AND t0.remove_on <> '') THEN 1 ELSE 0 END) AS 'remove_on',
                                    (DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'),STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'))) AS 'date_posted_diff'
                            FROM ojob_post_template t0
                            INNER JOIN oemployer t2
                            ON t0.employer = t2.id
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            WHERE 
                            t0.employer = '{$request['employer']}' 
                            AND
                            (CASE WHEN(t0.pinned)
                                THEN 
                                    1
                                ELSE 
                                    
                                    (CASE WHEN((DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'), STR_TO_DATE(DATE_FORMAT(t0.date_created,'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))) <= 7)
                                    THEN 
                                        1
                                    ELSE
                                        0
                                    END)
                                    
                            END) > 0
                            
                            ";

            if(isset($request['filter_field']) && $request['filter_field'] !== ""){
                $qrystr .= " AND ".$request['filter_field']." = ".$request['filter_value']."";
            }//end if

			if(isset($request['status']) && $request['status'] !== ""){
				$qrystr .= " AND t0.inactive = ".$request['status']."";
			}//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				// $qrystr .= " AND (t0.job_title LIKE '".$request['keyword']."' OR t1.name LIKE '".$request['keyword']."' OR t0.locality LIKE '".$request['keyword']."')";

                // Changed t0.locality to t0.location
                // Reason: Based on the tables presented in the front-end, this should be location instead of locality.
                // Additional Bug Fix: added '%' in the query to match other search bar functionality.
				$qrystr .= " AND (t0.job_title LIKE '%".$request['keyword']."%' OR t1.name LIKE '%".$request['keyword']."%' OR t0.location LIKE '%".$request['keyword']."%')";
			}//end if

            $qrystr .= " ORDER BY t0.date_created DESC";
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if

            $query      				= $this->db->query($qrystr);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();   
	        }//end if

            return $response;
    }//end function


    function get_current_job_post($param){
        $response 	= [];
        $response["success"] = false;

        $qrystr     = "SELECT t0.*,
                            DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'),STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p')) AS 'date_posted_diff'
                        FROM ojob_post_template t0
                        WHERE t0.id = '".$param['record_header']['id']."'";
        $query      				= $this->db->query($qrystr);
        $response['num_rows']   	= $query->getNumRows();
        if($query->getNumRows() > 0){
            $response["success"] = true;
            $response['data']  = $query->getResultArray();
        }else{
            $response["success"] = false;
            $response["message"] = "No record found!";
            $response['data'] = null;
        }//end if

        return $response;
    }//end if
    


    function get_master_data($type){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT t0.*
							FROM o".$type." t0
                            WHERE t0.name NOT IN('activated','deactivated','inactive')";
            $qrystr .= " ORDER BY t0.id ASC";

            $query      				= $this->db->query($qrystr);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();
	        }else{
	        	$response['data']       = null;
	        }//end if

            return $response;
    }//end function

	function auth_user($user,$pass){
		//$query = $this->db->get_where('ousr', array('username' => $user, 'password' => $pass));
		//return $query->row();
		
		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE t0.inactive = false
					AND t0.user_name = BINARY('$user')
					AND t0.password = BINARY('$pass')";
		//$query = $this->db->query($qrystr);
		//return $query->row();

		$query = $this->db->query($qrystr);
		
		//return 'dsfa';
		return $query->getRow();

	}


	//check duplicate
	function check_duplicate($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["dup_table"]." t0
                                WHERE t0.".$param["dup_filter"]." IN ?";

            

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
	//end check duplicate


    //check_pinned
    function check_pinned($param){
        $response   = [];
        $qrystr     = "";

        $qrystr     = "SELECT t0.* 
                            FROM ".$param["dup_table"]." t0
                            WHERE t0.pinned = 1
                            AND t0.".$param["dup_filter"]." IN ?";
        $query                      = $this->db->query($qrystr,[$param["names"]]);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();   
        }//end if

        return $response;


    //return $query->getResult();
    }//end function
    //end check_pinned


	//update record
    public function update_record($data){
    	$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($data['table_name']);
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();

        //--------------------------------------------create employer--------------------------------------------
        $employer_id = 0;
        if(isset($data['employer'])){
        	for ($i=0; $i < count($data['employer']); $i++) { 
	        	//$this->db->query(implode(";",$data['user']));
	        	$this->db->query($data['employer'][$i]);
	        	$employer_id = $this->db->insertID();
	        }//end for
        }//end if
        
        //--------------------------------------------create employer--------------------------------------------


        //--------------------------------------------update--------------------------------------------
        $id = 0;
        if(isset($data['for_update'])){
        	for ($i=0; $i < count($data['for_update']); $i++) { 
	        	$this->db->query($data['for_update'][$i]);
	        	$id = $this->db->insertID();
	        }//end for
        }//end if
        //--------------------------------------------update--------------------------------------------

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data'] 	  = array(
            	"id" => $data['record_header']['id'],
            	"employer_id" => $employer_id
            );
        }//End if

        return $param;
    }//End update header
	//end update record

    

    //delete record
    public function delete_record($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($data['table_name']);
        //$builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();

        /*
        //delete applicant
        $builder = $this->db->table('job_post_applicant');  
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();
        //end delete applicant

        //delete job interview
        $builder = $this->db->table('job_post_for_interview');  
        $builder->where('job_post_id', $data['record_header']['id']);
        $builder->delete();
        //end delete job interview

        //delete job post move to
        $builder = $this->db->table('job_post_move_to');  
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();
        //end delete job post move to

        //delete job post move to
        $builder = $this->db->table('job_post_views');  
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();
        //end delete job post move to
        */

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error deleting record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $data['record_header']['id']
            );
        }//End if

        return $param;
    }//End delete header
    //end delete record
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */