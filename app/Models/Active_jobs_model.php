<?php
namespace App\Models;

use CodeIgniter\Model;

class Active_jobs_model extends Model {
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

            
            //if($request['view_type'] == "" || $request['view_type'] == "job_post"){
                $qrystr     = "SELECT t1.doc_image,
                                    t0.id,
                                    t0.job_title,
                                    (SELECT COUNT(DISTINCT user_id) 
                                    FROM job_post_move_to 
                                    WHERE id = t0.id
                                    AND status = 'hired'
                                    AND if_current = true) AS 'hired_applicant',
                                    DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'),'%b %d, %Y') AS 'job_expiration_date',
                                    DATEDIFF(STR_TO_DATE(t0.remove_on,'%m/%d/%Y %h:%i %p'), STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p')) AS 'remaining_days_remove',
                                    
                                    (CASE WHEN (t0.remove_on IS NOT NULL AND t0.remove_on <> '') 
                                    THEN 
                                        
                                        (DATEDIFF(STR_TO_DATE(t0.remove_on,'%m/%d/%Y %h:%i %p'), STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p')))
                                        
                                    ELSE 
                                        DATEDIFF(DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY), STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y'))
                                    END) AS 'archive_days',

                                    (DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'),STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'))) AS 'date_posted_diff',
                                    
                                    t0.vacancies,
                                    t0.vacancies_placeholder,
                                    (CASE WHEN (t0.remove_on IS NOT NULL AND t0.remove_on <> '') THEN 1 ELSE 0 END) AS 'remove_on',
                                    (SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = t0.id) AS 'job_post_views',
                                    (SELECT COUNT(DISTINCT(user_id)) FROM job_post_move_to WHERE id = t0.id AND (status = 'for interview')) AS 'job_post_interviews',
                                    (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count'
                                FROM ojob_post t0
                                INNER JOIN oemployer t1
                                ON t0.employer = t1.id
                                WHERE t0.inactive = false
                                AND t0.status = 'active'
                                AND t0.vacancies > 0
                                AND DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                                ";
            //}//end if

            if(isset($request['employer_id']) && $request['employer_id'] !== ""){
                $qrystr .= " AND t0.employer = ".$request['employer_id']."";
            }//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t0.job_title LIKE '%".$request['keyword']."%')";
			}//end if

         


           
            $qrystr .= " ORDER BY t0.date_created ASC";
            
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
                        FROM ojob_post t0
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
                            WHERE t0.name NOT IN('declined')";
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


   

    function get_counter($request){
        $response   = [];
        $qrystr     = "";



        $qrystr     = "SELECT 'applicant' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_applicant t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id 
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'
                       AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        AND t0.user_id NOT IN(SELECT DISTINCT user_id FROM job_post_move_to WHERE id= t2.id)
                        
                        GROUP BY 'applicant'
                       UNION ALL
                       SELECT 'job_post' AS 'counter_type',
                                COUNT(t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."'
                       AND t0.inactive = false
                        AND t0.status = 'active'
                        AND t0.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'job_post'
                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                       AND t0.if_current = true
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'                         
                       AND t0.status = 'short listed'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'short_listed'
                       UNION ALL
                       SELECT 'for_interview' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                       AND t0.if_current = true
                        
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'
                       AND t0.status = 'for interview'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'for_interview'
                       UNION ALL
                       SELECT 'offered' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                       AND t0.if_current = true
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'offered'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'offered'


                       ";
        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();   
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
        //$builder = $this->db->table($data['table_name']);
        //$builder->set($data['record_header']);
        //$builder->where('id', $data['record_header']['id']);
        //$builder->update();

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