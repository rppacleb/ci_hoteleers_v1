<?php
namespace App\Models;

use CodeIgniter\Model;

class Job_post_vw_model extends Model {
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

		

	function get_record($param,$request){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        

        if($param['table_name'] == 'ojob_post'){
            $qrystr = "SELECT DISTINCT t0.job_title
                    FROM ".$param['table_name']." t0
                    ORDER BY t0.job_title ASC";
        }else if($param['table_name'] == 'profile_language'){
            $qrystr = "SELECT DISTINCT t0.language
                    FROM ".$param['table_name']." t0
                    ORDER BY t0.language ASC";
        }else if($param['table_name'] == 'profile_skills'){
            $qrystr = "SELECT DISTINCT t0.skills
                    FROM ".$param['table_name']." t0
                    ORDER BY t0.skills ASC";
        }else if($param['table_name'] == 'ocurrency'){
            $qrystr = "SELECT t0.*
                    FROM ".$param['table_name']." t0
                    ORDER BY t0.code ASC";
        }else if($param['table_name'] == 'oyear'){
            $qrystr = "SELECT t0.*
                    FROM ".$param['table_name']." t0
                    WHERE t0.inactive = false
                    ORDER BY t0.from_range ASC";
        }else if($param['table_name'] == 'oeducation'){
            $qrystr = "SELECT t0.*
                    FROM ".$param['table_name']." t0
                    WHERE t0.inactive = false
                    ORDER BY t0.name,t0.sequence ASC";
        }else{
            $qrystr = "SELECT t0.*
                    FROM ".$param['table_name']." t0
                    WHERE t0.inactive = false
                    ORDER BY t0.name ASC";
        }//end if
        //$query = $this->db->query($qrystr);
        //return $query->row();

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
    }


    function get_record2($param){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        $qrystr = "SELECT t0.*
                    FROM ".$param['table_name']." t0
                    WHERE t0.inactive = false";
        //$query = $this->db->query($qrystr);
        //return $query->row();

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
    }

    function get_employer_defaults($param){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        $qrystr = "SELECT t0.*
                    FROM oemployer t0
                    WHERE t0.id = '".$param['employer']."'";
        //$query = $this->db->query($qrystr);
        //return $query->row();

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

    function get_record_no_inactive($param){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];

        $fields = "t0.*";
        if($param['table_name'] == 'profile_skills'){
            $fields = "t0.skills";
        }
        if($param['table_name'] == 'profile_language'){
            $fields = "t0.language";
        }

        $qrystr = "SELECT DISTINCT ".$fields."
                    FROM ".$param['table_name']." t0";
        //$query = $this->db->query($qrystr);
        //return $query->row();

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
    }

    function load_data($id,$request){
            $response   = [];
            $qrystr     = "";
            $table      = "";

            if(isset($request['isActive']) && $request['isActive']){
                $table = "ojob_post";
            }else{
                $table = "ojob_post_template";
            }
            

            $qrystr     = "SELECT t0.*,
                            t1.name AS 'department_text',
                            t2.name AS 'industry_text',
                            t3.name AS 'job_level_text',
                            t4.name AS 'job_type_text',
                            t5.name AS 'education_text',
                            (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'date_created',
                            (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count'
                            
                            FROM ".$table." t0
                            LEFT JOIN odepartment t1
                            ON t0.department = t1.id
                            LEFT JOIN oindustry t2
                            ON t0.industry = t2.id
                            LEFT JOIN ojob_level t3
                            ON t0.job_level = t3.id
                            LEFT JOIN ojob_type t4
                            ON t0.job_type = t4.id
                            LEFT JOIN oeducation t5 
                            ON t0.education = t5.id
                            WHERE t0.id = '".$id."'
                            AND t0.employer = '".$request['employer_id']."'";


            $qrystr .= " ORDER BY t0.date_created DESC";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }//end if
            return $response;
        //return $query->getResult();
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


    function get_master_data($param){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT *,(DATE_FORMAT(date_created, '%b %Y')) AS 'joined_date'
							FROM ".$param["table_name"]."
                            WHERE 1";
            

            if(isset($param["filter_field"])){
                $qrystr .= " AND ".$param["filter_field"]." = ".$param["filter_value"]."";
            }//end if
            $qrystr .= " ORDER BY id ASC";



            $query      				= $this->db->query($qrystr);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();
	        }else{
	        	$response['data']       = null;
	        }//end if

            return $response;
    }//end function

    function get_perks_benefits($param){
            $response   = [];
            $qrystr     = "";
            $qrystr     = "SELECT t0.*,(DATE_FORMAT(t0.date_created, '%b %Y')) AS 'joined_date',t1.user_type
                            FROM ".$param["table_name"]." t0
                            LEFT JOIN ousr t1
                            ON t0.created_by = t1.id
                            WHERE 1
                            AND t0.id NOT IN(SELECT id FROM operks_and_benefits_removed WHERE user_id = '".$param["user_id"]."')
                            AND (t1.user_type = 'admin' OR t1.id = '".$param["user_id"]."')";
                

            if(isset($param["filter_field"])){
                $qrystr .= " AND t0.".$param["filter_field"]." = ".$param["filter_value"]."";
            }//end if
            $qrystr .= " ORDER BY t0.id ASC";



            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }else{
                $response['data']       = null;
            }//end if

            return $response;
    }//end function

	


	//check duplicate
	function check_duplicate($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["dup_table"]." t0
                                WHERE t0.id <> '".$param["dup_id"]."' 
                                AND t0.employer = '".$param["dup_employer"]."' AND
                                t0.".$param["dup_filter"]." IN ?";

            

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
	//end check duplicate


    function check_applicant($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT COUNT(DISTINCT user_id) AS 'result'
                                FROM ".$param["dup_table"]."
                                WHERE ".$param["dup_filter"]."";

        
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
    //end check duplicate

    //check employer status
    function check_employer_status($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.*,
                            t2.doc_image,
                            t0.employer,
                            t1.company_name,
                            t1.doc_image AS 'employer_doc_image',
                            (CASE WHEN(t0.user_type = 'admin' OR t0.user_type = 'applicant') THEN 'Activated' 
                            ELSE  
                                (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t1.start_date, ' ',t1.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t1.end_date, ' ',t1.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 'Pending' WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t1.start_date, ' ',t1.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t1.end_date, ' ',t1.end_time), '%m/%d/%Y %h:%i %p'))) THEN 'Activated' ELSE 'Inactive' END)
                            END) AS 'activated',
                            t1.deactivated,
                            t1.paused,
                            t0.logged_in
                            

                            FROM ousr t0
                            LEFT JOIN oemployer t1
                            ON t0.employer = t1.id
                            LEFT JOIN oprofile t2 
                            ON t0.id = t2.id
                            WHERE t0.inactive = false
                            AND
                            t0.id = '".$param['user_id']."'
                            ";
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
    //end check employer status

    //get files for deletion
    function get_file_for_deletion($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["dup_table"]." t0
                                WHERE t0.id = '".$param["dup_id"]."' AND
                                t0.".$param["dup_filter"]." NOT IN ?";

            
            if(count($param["names"]) <= 0){
                $param["names"][] = 0;
            }
            
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
    //end get files for deletion

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
            }else{
                $response['data']       = null;
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
        /*$builder = $this->db->table($data['table_name']);
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();
        */

        //------------------------------------update template------------------------------------
        $builder = $this->db->table("ojob_post_template");
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();
        //------------------------------------update template------------------------------------

        if(!$data['record_header']['inactive']){

            
            /*$this->db->query("UPDATE ".$data['table_name']." SET date_posted = DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p')
                             WHERE id = '".$data['record_header']['id']."'");
            */
            
            //------------------------------------update template------------------------------------
            $this->db->query("UPDATE ojob_post_template SET date_posted = DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p')
                             WHERE id = '".$data['record_header']['id']."'");
            //------------------------------------update template------------------------------------
            
        }//end if
        

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

        
        //--------------------------------add template--------------------------------
        $builder = $this->db->table("ojob_post_template");
        $builder->insert($data['record_header']);
        $template_id = $this->db->insertID();
        //--------------------------------add template--------------------------------

        if(!$data['record_header']['inactive']){
            $this->db->query("UPDATE ".$data['table_name']." SET date_posted = DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p')
                             WHERE id = '".$id."'");

            //--------------------------------update template--------------------------------
            $this->db->query("UPDATE ojob_post_template SET date_posted = DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p')
                            WHERE id = '".$template_id."'");
            //--------------------------------update template--------------------------------
        }//end if

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