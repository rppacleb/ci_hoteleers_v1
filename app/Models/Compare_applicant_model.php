<?php
namespace App\Models;

use CodeIgniter\Model;

class Compare_applicant_model extends Model {
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

            

            $qrystr     = "SELECT STR_TO_DATE(t0.interview_date,'%m/%d/%Y') AS 'interview_date',
                                   DATE_FORMAT(STR_TO_DATE(t0.interview_date,'%m/%d/%Y'),'%b %d, %Y') AS 'interview_date_txt',
                                   t0.interview_start_time,
                                   t2.name,
                                   t3.job_title,
                                   t0.id,
                                   t0.job_post_id,
                                   t0.user_id,
                                   t0.status
                            FROM job_post_for_interview t0
                            INNER JOIN ojob_post t3
                            ON t0.job_post_id = t3.id
                            AND t3.created_by = ".$request['user_id']."
                            INNER JOIN oprofile t1
                            ON t0.user_id = t1.id
                            INNER JOIN ousr t2
                            ON t0.user_id = t2.id
                            WHERE 1
                            ";

			/*if(isset($request['status']) && $request['status'] !== ""){
                $qrystr .= " AND (CASE WHEN((DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '".$request['status']."'";
                

                

				
			}//end if*/

            if(isset($request['user_id']) && $request['user_id'] !== ""){
                //$qrystr .= " AND t3.created_by = ".$request['user_id']."";
            }//end if

            if(isset($request['date_filter']) && $request['date_filter'] !== ""){
                $qrystr .= " AND STR_TO_DATE(t0.interview_date,'%m/%d/%Y') = STR_TO_DATE('".$request['date_filter']."','%m/%d/%Y')";
            }//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t2.name LIKE '%".$request['keyword']."%')";
			}//end if

         


           
            $qrystr .= " ORDER BY STR_TO_DATE(CONCAT(t0.interview_date,' ',t0.interview_start_time),'%m/%d/%Y %h:%i %p') DESC";
            
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


    function get_job_post_list($request){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        $qrystr     = "SELECT t1.doc_image,
                                t0.id,
                                t0.job_title,
                                DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'),'%b %d, %Y') AS 'job_expiration_date',
                                t0.vacancies,
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = t0.id) AS 'job_post_views',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_move_to WHERE id = t0.id AND status = 'interview') AS 'job_post_interviews',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count'
                            FROM ojob_post t0
                            INNER JOIN oemployer t1
                            ON t0.employer = t1.id
                            WHERE t0.inactive = false
                            AND t0.status = 'active'
                            AND t0.vacancies > 0
                            AND STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                            ";
        if(isset($request['created_by']) && $request['created_by'] !== ""){
            $qrystr .= " AND t0.created_by = ".$request['created_by']."";
        }//end if

        $query = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['success']    = true;   
            $response['data']       = $query->getResultArray(); 
        }else{
            $response['success']    = false; 
            $response['message']    = "No Result!";  
        }//end if
        
        return $response;
    }//end function


    function get_applicant_list($request){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        $qrystr     = "SELECT t1.name,t1.id,t0.id AS 'job_post_id'
                        FROM `job_post_applicant` t0
                        INNER JOIN ousr t1
                        ON t0.user_id = t1.id
                        INNER JOIN job_post_move_to t2
                        ON t0.id = t2.id
                        AND t0.user_id = t2.user_id
                        AND (t2.status = '".$request['status']."')
                        AND t2.if_current = true
                        WHERE 1
                            ";
        if(isset($request['job_post_id']) && $request['job_post_id'] !== ""){
            $qrystr .= " AND t0.id = ".$request['job_post_id']."";
        }else{
            $qrystr .= " AND t0.id = 0";
        }//end if

        $query = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['success']    = true;   
            $response['data']       = $query->getResultArray(); 
        }else{
            $response['success']    = false; 
            $response['message']    = "No Result!";  
        }//end if
        
        return $response;
    }//end function

    

    


    function get_master_data($request){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT t0.*
							FROM ojob_post t0
                            WHERE 1";

            if(isset($request['id']) && $request['id'] !== ""){
                $qrystr .= " AND t0.id = ".$request['id']."";
            }//end if

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

            $qrystr     = "SELECT t0.*,t1.job_title,t2.email_add,t3.company_name
                            FROM ".$param["dup_table"]." t0
                            INNER JOIN ojob_post t1
                            ON t0.job_post_id = t1.id
                            INNER JOIN oemployer t3
                            ON t1.employer = t3.id
                            INNER JOIN ousr t2 
                            ON t0.user_id = t2.id
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


    //get permission
    function get_permission($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM opermission t0
                                WHERE t0.user_type = '".$param["permission_user_type"]."' AND
                                t0.record_type = '".$param['permission_record_type']."' ";

            

            
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
    //end get permission


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

        //create employer
        $id = 0;
        if(isset($data['for_update'])){
        	for ($i=0; $i < count($data['for_update']); $i++) { 
	        	//$this->db->query(implode(";",$data['user']));
	        	$this->db->query($data['for_update'][$i]);
	        	$id = $this->db->insertID();
	        }//end for
        }//end if
        
        //end create employer

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data'] 	  = array(
            	"id" => $data['record_header']['id']
            );
        }//End if

        return $param;
    }//End update header
	//end update record
	
    //add record
    public function add_record($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();

       
        //add header
        $builder = $this->db->table($data['table_name']);
        $builder->insert($data['record_header']);
        $id = $this->db->insertID();
        //end add header


        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $id
            );
        }//End if

        return $param;
    }//end function
    //end add record

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */