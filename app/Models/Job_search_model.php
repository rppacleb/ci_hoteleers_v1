<?php
namespace App\Models;

use CodeIgniter\Model;

class Job_search_model extends Model {
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
                                    t0.employer,
                                    t1.company_name,
                                    t1.doc_image,
                                    t0.job_title,
                                    t0.location,
                                    CONCAT(t0.location) AS 'location_placeholder',
                                    DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'), '%b %d, %Y') AS 'job_expiration_date',
                                    (CASE WHEN(TIMESTAMPDIFF(SECOND, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()) <= 60) THEN
                                        CONCAT(TIMESTAMPDIFF(SECOND, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()),' ','second(s) ago')
                                     WHEN(TIMESTAMPDIFF(MINUTE, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()) <= 60) THEN
                                        CONCAT(TIMESTAMPDIFF(MINUTE, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()),' ','minute(s) ago')
                                     WHEN(TIMESTAMPDIFF(HOUR, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()) <= 24) THEN
                                        CONCAT(TIMESTAMPDIFF(HOUR, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()),' ','hour(s) ago')
                                     WHEN(TIMESTAMPDIFF(DAY, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()) <= 3) THEN
                                        CONCAT(TIMESTAMPDIFF(DAY, STR_TO_DATE(t0.date_posted,'%m/%d/%Y %h:%i %p'), NOW()),' ','day(s) ago')
                                     ELSE
                                        DATE_FORMAT(STR_TO_DATE(t0.date_posted,'%m/%d/%Y'), '%b %d, %Y')
                                    END) AS 'date_created',
                                    t2.name AS 'job_type_text',
                                    (CASE WHEN t3.job_post IS NULL THEN 0 ELSE 1 END) AS 'saved',
                                    (SELECT COUNT(DISTINCT user_id) FROM job_post_applicant WHERE id = t0.id
                                    AND user_id = '".$request['user_id']."') AS 'applied',
                                    (SELECT DISTINCT (DATE_FORMAT(date_created, '%b %d, %Y')) user_id FROM job_post_applicant WHERE id = t0.id
                                    AND user_id = '".$request['user_id']."') AS 'date_applied'

                                    
                            FROM ojob_post t0
                            LEFT JOIN oeducation t4
                            ON t0.education = t4.id
                            LEFT JOIN oemployer t1 
                            ON t0.employer = t1.id
                            LEFT JOIN ojob_type t2
                            ON t0.job_type = t2.id
                            LEFT JOIN usr_job_post_fav t3
                            ON t0.id = t3.job_post
                            AND t3.id = ".$request['user_id']."
                            WHERE t0.inactive = false
                            AND STR_TO_DATE(t0.job_start_date,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND (t0.remove_on IS NULL OR t0.remove_on = '')
                            AND t0.vacancies > 0
                            AND t0.status = 'active'";

			/*if(isset($request['status']) && $request['status'] !== ""){
                $qrystr .= " AND (CASE WHEN((DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '".$request['status']."'";
                

                

				
			}//end if*/
            if(isset($request['education'])){
                $operator = "AND";
                $qrystr .= " ".$operator." t4.level >= ".$request['education']."";
            }//end 
            

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t0.job_title LIKE '%".$request['keyword']."%'";
				$qrystr .= " OR t1.company_name LIKE '%".$request['keyword']."%')";
			}//end if

            //education
            
           
            
            $in_cont = array();
            if(isset($request['location'])){
                $qrystr .= " AND t0.location IN ?";
                $in_cont[count($in_cont)] = $request['location'];
            }//end 

            //job_level
            if(isset($request['job_level'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t0.job_level IN ?";
                $in_cont[count($in_cont)] = $request['job_level'];
            }//end 

            //job_type
            if(isset($request['job_type'])){
                $operator = "AND";
                

                $qrystr .= " ".$operator." t0.job_type IN ?";
                $in_cont[count($in_cont)] = $request['job_type'];
            }//end 

            //education
            /*
            if(isset($request['education'])){
                $operator = "AND";
                

                $qrystr .= " ".$operator." t0.education IN ?";
                $in_cont[count($in_cont)] = $request['education'];
            }//end 
            */

            //industry
            if(isset($request['industry'])){
                $operator = "AND";
                

                $qrystr .= " ".$operator." t0.industry IN ?";
                $in_cont[count($in_cont)] = $request['industry'];
            }//end 

            //department
            if(isset($request['department'])){
                $operator = "AND";
                

                $qrystr .= " ".$operator." t0.department IN ?";
                $in_cont[count($in_cont)] = $request['department'];
            }//end

            if($request['sort'] == 'ending_soonest'){
                $qrystr .= " ORDER BY STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y') ASC";
            }else if($request['sort'] == 'newly_listed'){
                $qrystr .= " ORDER BY t0.date_created DESC";
            }else if($request['sort'] == 'best_match'){
                if(isset($request['user_id']) && $request['user_id'] > 0){
                    $qrystr .= " AND (t0.job_level IN(SELECT job_level FROM profile_job_level WHERE id = '".$request['user_id']."')
                                OR t0.industry IN(SELECT industry FROM profile_industry WHERE id = '".$request['user_id']."')
                                OR t0.job_type IN(SELECT job_type FROM profile_job_type WHERE id = '".$request['user_id']."')
                                OR t0.department IN(SELECT department FROM profile_department WHERE id = '".$request['user_id']."')
                                )";
                }
                $qrystr .= " ORDER BY t0.date_posted DESC,(SELECT COUNT(DISTINCT user_id) FROM job_post_applicant WHERE id = t0.id) DESC";
                //$qrystr .= " ORDER BY (SELECT CONCAT(location) FROM oprofile WHERE id='".$request['user_id']."') ASC,t0.date_created DESC";
            }else{
                //$qrystr .= " ORDER BY t0.date_created DESC";
                $qrystr .= " ORDER BY t0.date_posted DESC,(SELECT COUNT(DISTINCT user_id) FROM job_post_applicant WHERE id = t0.id) DESC";
            }//end if

            
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if

            $query      				= $this->db->query($qrystr,$in_cont);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();   
	        }//end if

            return $response;
    }//end function

    


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


    function get_profile($param){
		$response 	= [];
		
		$qrystr = "SELECT t0.*,
							t1.*,
							(CASE WHEN(t0.user_type = 'applicant') THEN t1.first_login ELSE 0 END) AS 'first_login',
                            (CASE WHEN(t0.user_type = 'applicant' OR t0.user_type = 'employer') THEN t0.password_changed ELSE 0 END) AS 'password_changed',

                            (SELECT COUNT(id) FROM profile_education WHERE id = t0.id) AS 'education_count',
                            (SELECT COUNT(id) FROM profile_language WHERE id = t0.id) AS 'language_count',
                            (SELECT COUNT(id) FROM profile_industry WHERE id = t0.id) AS 'industry_count',
                            (SELECT COUNT(id) FROM profile_job_level WHERE id = t0.id) AS 'job_level_count',
                            (SELECT COUNT(id) FROM profile_job_type WHERE id = t0.id) AS 'job_type_count',
                            (SELECT COUNT(id) FROM profile_department WHERE id = t0.id) AS 'department_count',
                            (SELECT COUNT(id) FROM profile_experience WHERE id = t0.id) AS 'experience_count'
                            
					FROM ousr t0
					LEFT JOIN oprofile t1 
					ON t0.id = t1.id
					WHERE t0.inactive = false
					AND t0.id = '".$param['user_id']."'";
		$query = $this->db->query($qrystr);
		$response['num_rows']   	= $query->getNumRows();
		if($query->getNumRows() > 0){
            $response['data']       = $query->getRow();
        }else{
        	$response['data']       = null;
        }//end if

		return $response;
		//return $query->getRow();

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
                                WHERE ".$param["dup_filter"]." IN ?";

            

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
	//end check duplicate


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
        $employer_id = 0;
        if(isset($data['employer'])){
        	for ($i=0; $i < count($data['employer']); $i++) { 
	        	//$this->db->query(implode(";",$data['user']));
	        	$this->db->query($data['employer'][$i]);
	        	$employer_id = $this->db->insertID();
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
            	"id" => $data['record_header']['id'],
            	"employer_id" => $employer_id
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
        $builder->where('job_post', $data['record_header']['job_post']);
        $builder->delete();

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