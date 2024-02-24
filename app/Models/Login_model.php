<?php
namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model {
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

	function auth_user($param){
		$response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
		$qrystr = "SELECT t0.*,
                    t2.doc_image,
                    t2.first_name,
                    t0.employer,
                    t1.company_name,
                    t1.doc_image AS 'employer_doc_image',
                    (CASE WHEN(t0.user_type = 'admin' OR t0.user_type = 'applicant') THEN 'Activated' 
                    ELSE  
                        (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t1.start_date, ' ',t1.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t1.end_date, ' ',t1.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 'Pending' WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t1.start_date, ' ',t1.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t1.end_date, ' ',t1.end_time), '%m/%d/%Y %h:%i %p'))) THEN 'Activated' ELSE 'Inactive' END)
                    END) AS 'activated',
                    t1.deactivated,
                    t0.logged_in
                    

					FROM ousr t0
                    LEFT JOIN oemployer t1
                    ON t0.employer = t1.id
                    LEFT JOIN oprofile t2 
                    ON t0.id = t2.id
					WHERE t0.inactive = false
					AND LOWER(t0.username) = LOWER('".$param['header']['username']."')
					AND t0.password = BINARY('".$param['header']['password']."')";
		//$query = $this->db->query($qrystr);
		//return $query->row();

		$query = $this->db->query($qrystr);
		$response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
        	$response['success']    = true;   
            $response['data']       = $query->getRow();   
        }else{
        	$response['success']    = false; 
        	$response['message']    = "Incorrect password";  
        }//end if
		
		return $response;

	}//end auth_user

	function auth_email($param){
		$response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];

		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE 1
					AND LOWER(t0.username) = LOWER('".$param['header']['username']."')";
		$query = $this->db->query($qrystr);

		$response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            if(!$query->getRow()->inactive){
                $response['success']    = true;   
                $response['data']       = $query->getRow();   
            }else{
                $response['success']    = false; 
                $response['message']    = "User not yet activated!";
            }
        	
        }else{

        	$response['success']    = false; 
        	$response['message']    = "Incorrect email address!";  
        }//end if
		
		//return 'dsfa';
		return $response;

	}//end auth_user

    //update last logged in
    public function update_last_logged_in($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
        $this->db->transBegin();
        $this->db->query("UPDATE ousr SET 
                            last_logged_in = DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),
                            logged_in = 1
                             WHERE id = '".$data['record_header']['id']."'");

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $data['record_header']['id']
            );
        }//End if

        return $param;
    }//End update header
    //end update last logged in

    //update last logged in
    public function update_logged_in($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
        $this->db->transBegin();
        $this->db->query("UPDATE ousr SET 
                            logged_in = 0
                             WHERE id = '".$data['record_header']['id']."'");

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $data['record_header']['id']
            );
        }//End if

        return $param;
    }//End update header
    //end update last logged in

    //update not logged out
    public function update_not_logged_out(){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
        $this->db->transBegin();
        $this->db->query("UPDATE ousr SET 
                            logged_in = 0
                             WHERE DATEDIFF(STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y'), STR_TO_DATE(last_logged_in,'%m/%d/%Y')) >= 1");

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
           
        }//End if

        return $param;
    }//End update header
    //end update not logged out


    //archive expired job post
    public function archive_job_post(){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
        $this->db->transBegin();

        //move ousr to ousr_archive
        $this->db->query("INSERT INTO ousr_archive
            SELECT * FROM ousr WHERE employer IN(SELECT DISTINCT t0.id
                FROM oemployer t0
                LEFT JOIN oindustry t1
                ON t0.industry = t1.id
                LEFT JOIN ostatus t2
                ON t0.status = t2.id
                WHERE ((CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '5'
                )
                AND t0.paused = 0
            )"
        );

        //delete to ousr
        $this->db->query("DELETE FROM ousr WHERE employer IN(SELECT DISTINCT t0.id
                FROM oemployer t0
                LEFT JOIN oindustry t1
                ON t0.industry = t1.id
                LEFT JOIN ostatus t2
                ON t0.status = t2.id
                WHERE ((CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '5'
                )
                AND t0.paused = 0
            )"
        );
        //end delete to ousr

        //create history
        /*
        $this->db->query("INSERT INTO oemployer_history(id,status)
                          SELECT DISTINCT t0.id,'deactivated'
                            FROM oemployer t0
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE (t0.deactivated = 1
                                OR (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '5'
                            )
                            AND t0.paused = 0"
        );
        */
        //end create history
        
        

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error updating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
           
        }//End if

        return $param;
    }//End update header
    //end archive expired job post
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */