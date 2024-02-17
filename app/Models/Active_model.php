<?php
namespace App\Models;

use CodeIgniter\Model;

class Active_model extends Model {
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
            if($type == 'prospect'){
                    $qrystr     = "SELECT t0.id,
                                    t0.username,
                                    t0.location,
                                    CONCAT(t0.location) AS 'location_placeholder',
                                    t0.company_name,
                                    t0.status AS 'status_id',
                                    t2.name AS 'status',
                                    t1.name AS 'industry',
                                    (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'application_date'
                            FROM osignup t0
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            WHERE t0.user_type = 'company'
                            AND t0.status <> 2";
                
            }else if($type == 'active'){
                $qrystr     = "SELECT t0.id,
                                    t0.company_name,
                                    t0.location,
                                    CONCAT(t0.location) AS 'location_placeholder',
                                    t1.name AS 'industry',
                                   
                                    
                                    (CASE WHEN(t0.start_date IS NULL OR t0.start_date = '') THEN NULL ELSE DATE_FORMAT(STR_TO_DATE(t0.start_date, '%m/%d/%Y'), '%b %d, %Y') END) AS 'start_date',
                                    (CASE WHEN(t0.end_date IS NULL OR t0.end_date = '') THEN NULL ELSE DATE_FORMAT(STR_TO_DATE(t0.end_date, '%m/%d/%Y'), '%b %d, %Y') END) AS 'end_date',

                                    t0.inactive,
                                    t0.status,
                                    (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 'Pending' WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 'Activated' ELSE 'Inactive' END) AS 'activated'
                            FROM oemployer t0
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE t0.status = 1
                            AND t0.deactivated = 0
                            AND t0.paused = 0";

                $qrystr .= " AND (
                                CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 24 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 24 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '4'";
                
            }else if($type == 'inactive'){
                $qrystr     = "SELECT t0.id,
                                    t0.company_name,
                                    t0.location,
                                    CONCAT(t0.location) AS 'location_placeholder',
                                    t1.name AS 'industry',
                                    t0.start_date,
                                    IFNULL(DATE_FORMAT(STR_TO_DATE(t0.start_date, '%m/%d/%Y'), '%b %d, %Y'),'') AS 'start_date',
                                    t0.end_date,
                                    IFNULL(DATE_FORMAT(STR_TO_DATE(t0.end_date, '%m/%d/%Y'), '%b %d, %Y'),'') AS 'end_date',
                                    t0.inactive,
                                    t0.status,
                                    (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 'Pending' WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 'Activated' ELSE 'Inactive' END) AS 'activated'
                            FROM oemployer t0
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE (t0.deactivated = 1
                                OR (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '5'
                            )

                            AND t0.paused = 0";
            }//end if
            

		    if(isset($request['keyword']) && $request['keyword'] !== ""){
                $qrystr .= " AND (t0.company_name LIKE '%".$request['keyword']."%'";
                $qrystr .= " OR t0.location LIKE '%".$request['keyword']."%'";
                $qrystr .= " OR t1.name LIKE '%".$request['keyword']."%')";
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
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */