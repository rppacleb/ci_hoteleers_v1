<?php
namespace App\Models;

use CodeIgniter\Model;

class Schedule_model extends Model {
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
                                   t1.doc_image,
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

         


           
            $qrystr .= " ORDER BY STR_TO_DATE(CONCAT(t0.interview_date,' ',t0.interview_start_time),'%m/%d/%Y %h:%i %p') ASC";
            
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

            $qrystr     = "SELECT t0.*,t1.job_title,t2.email_add,t3.company_name,t2.name
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


    //check duplicate
    function check_hired_offered($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT COUNT(id) AS 'id'
                                                    FROM job_post_move_to 
                                                    WHERE (status = 'offered' OR status = 'hired')
                                                    AND id = ".$param["job_post_id"]."
                                                    AND user_id = ".$param["user_id"]."";

            

           
            $query                      = $this->db->query($qrystr);
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