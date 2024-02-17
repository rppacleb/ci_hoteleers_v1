<?php
namespace App\Models;

use CodeIgniter\Model;

class Employer_vw_model extends Model {
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

            $qrystr     = "SELECT t0.id,
            						t0.username,
            						t0.location,
									t0.company_name,
									t0.status AS 'status_id',
                                    t3.signup,
							        t1.name AS 'status',
							        t2.name AS 'industry',
							        (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'application_date',
                                    t0.honorifics,
                                    t0.first_name,
                                    t0.last_name,
                                    t0.designation,
                                    t0.work_email,
                                    t0.dial_code,
                                    t0.contact_number,
                                    t3.deactivated,
                                    t3.paused,
                                    t3.dial_code AS 'employer_dial_code',
                                    t3.contact_number AS 'employer_contact_number',
							FROM osignup t0
                            INNER JOIN oemployer t3
                            ON t0.id = t3.signup
							LEFT JOIN ostatus t1
							ON t0.status = t1.id
                            LEFT JOIN oindustry t2
                            ON t0.industry = t2.id
							WHERE t0.user_type = 'company'
							AND t0.status <> 2";

			if(isset($request['status']) && $request['status'] !== ""){
				$qrystr .= " AND t0.status = '".$request['status']."'";
			}//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t0.company_name LIKE '".$request['keyword']."'";
				$qrystr .= " OR t0.location LIKE '".$request['keyword']."'";
				$qrystr .= " OR t2.name LIKE '".$request['keyword']."')";
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

    function load_data($id){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.*,
                            t1.name AS 'industry_text',
                            t2.name AS 'status_text',
                            (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'date_created',
                            (DATE_FORMAT(t3.date_created, '%b %Y')) AS 'joined_date',
                            (t0.doc_image) AS 'doc_image',
                            t4.line,
                            t4.doc_image AS 'line_doc_image',
                            t4.file_size AS 'line_file_size',

                            t3.honorifics,
                            t3.first_name,
                            t3.last_name,
                            t3.designation,
                            t3.work_email,
                            t0.dial_code,
                            t0.contact_number,
                            t0.deactivated,
                            t0.paused,

                            (CASE WHEN((DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_SUB(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 0 ELSE 1 END) AS expired

                            FROM oemployer t0
                            LEFT JOIN employer_image t4
                            ON t0.id = t4.id
                            LEFT JOIN oindustry t1 
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            LEFT JOIN osignup t3
                            ON t0.signup = t3.id
                            WHERE t0.id = '$id'";


            $qrystr .= " ORDER BY t0.date_created DESC";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }//end if
            return $response;
        //return $query->getResult();
    }//end function


    function load_history($type,$request,$perPage,$offset){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT   t0.id,
                                    (CASE WHEN (t0.start_date IS NULL OR t0.start_date = '') THEN t1.start_date ELSE t0.start_date END) AS 'start_date',
                                    (CASE WHEN (t0.end_date IS NULL OR t0.start_date = '') THEN t1.end_date ELSE t0.end_date END) AS 'end_date',
                                    t0.status,
                                    (DATE_FORMAT(t0.date_created, '%m/%d/%Y %h:%i %p')) AS 'date_created'
                            FROM oemployer_history t0
                            INNER JOIN oemployer t1
                            ON t0.id = t1.id
                            WHERE t0.id = '".$request['id']."'";


            if(isset($request['status']) && $request['status'] !== ""){
                $qrystr .= " AND t0.status = '".$request['status']."'";
            }//end if

            if(isset($request['keyword']) && $request['keyword'] !== ""){
                $qrystr .= " AND (t0.company_name LIKE '".$request['keyword']."'";
                $qrystr .= " OR t0.location LIKE '".$request['keyword']."'";
                $qrystr .= " OR t2.name LIKE '".$request['keyword']."')";
            }//end if

            $qrystr .= " ORDER BY t0.date_created DESC";
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        //return $query->getResult();
    }//end function


    function get_master_data($type){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT t0.*
							FROM o".$type." t0";
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
                                WHERE t0.id <> '".$param["dup_id"]."' AND
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

    //check status
    function check_status($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.deactivated,t0.paused,t1.work_email
                                FROM oemployer t0
                                INNER JOIN osignup t1
                                ON t0.signup = t1.id
                                WHERE t0.id = '".$param["record_header"]['id']."'";

            

           
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function
    //end check status

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

        //create user
        /*
        $user_id = 0;
        if(isset($data['user'])){
        	for ($i=0; $i < count($data['user']); $i++) { 
	        	//$this->db->query(implode(";",$data['user']));
	        	$this->db->query($data['user'][$i]);
	        	$user_id = $this->db->insertID();
	        }//end for
        }//end if
        */
        //end create user

        //create history
        $history_id = 0;
        if(isset($data['history'])){
            for ($i=0; $i < count($data['history']); $i++) { 
                //$this->db->query(implode(";",$data['user']));
                $this->db->query($data['history'][$i]);
                $history_id = $this->db->insertID();
            }//end for
        }//end if
        
        //end create history

        if(isset($data['record_signup'])){
            $builder = $this->db->table('osignup');
            $builder->set($data['record_signup']);
            $builder->where('id', $data['record_signup']['id']);
            $builder->update();
        }//end if

        //add lines
        if(count($data['record_lines']) > 0){
            //$this->db->table('employer_image')->whereNotIn('id',$data['record_lines_retain']);
            //$this->db->table('employer_image')->delete();
            $this->db->table('employer_image')->delete(array('id' => $data['record_header']['id']));

            //$this->db->table('employer_image')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('employer_image')->insertBatch($data['record_lines']);
        }else{
            $this->db->table('employer_image')->delete(array('id' => $data['record_header']['id']));
        }//end if
        //end add lines

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


    //update record
    public function process_account($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($data['table_name']);
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();

        //create history
        $history_id = 0;
        if(isset($data['history'])){
            for ($i=0; $i < count($data['history']); $i++) { 
                //$this->db->query(implode(";",$data['user']));
                $this->db->query($data['history'][$i]);
                $history_id = $this->db->insertID();
            }//end for
        }//end if
        
        //end create history

       

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

        //add lines
        if(count($data['record_lines']) > 0){
            //replace id header id
            for ($i=0; $i < count($data['record_lines']); $i++) { 
                $data['record_lines'][$i]['id'] = $id;
            }//end for
            $this->db->table('employer_image')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('employer_image')->insertBatch($data['record_lines']);
        }//end if
        //end add lines

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $id,
                "employer_id" => $employer_id
            );
        }//End if

        return $param;
    }//end function
    //end add record
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */