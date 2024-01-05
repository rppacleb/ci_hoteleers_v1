<?php
namespace App\Models;

use CodeIgniter\Model;

class Schedule_vw_model extends Model {
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
							        t1.name AS 'status',
							        t2.name AS 'industry',
							        (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'application_date'
							FROM osignup t0
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

    

    function load_data($id,$request){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.*,
                                DATE_FORMAT(STR_TO_DATE(t0.interview_date,'%m/%d/%Y'), '%b %d, %Y') AS 'interview_date_placeholder',
                                t1.status AS 'notif_status'
                            FROM job_post_for_interview t0
                            LEFT JOIN onotification t1
                            ON t0.id = t1.base_ref
                            WHERE t0.id = '$id'";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }//end if

            $qrystr     = "SELECT t0.job_title,
                                  t2.company_name,
                                   (SELECT name FROM ousr WHERE id = '".$request['user_id']."') AS 'applicant_name',
                                   (SELECT email_add FROM ousr WHERE id = '".$request['user_id']."') AS 'applicant_email'
                            FROM ojob_post t0
                            LEFT JOIN oemployer t2
                            ON t0.employer = t2.id
                            WHERE t0.id = '".$request['job_post']."'";

            $query                      = $this->db->query($qrystr);
            $response['num_rows2']      = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['placeholder']       = $query->getResultArray();
            }//end if

            return $response;
        //return $query->getResult();
    }//end function

    function process_invitation($request){
        $response   = array(
            "success" 	=> false
        );

        $qrystr     = "";
        try{
            $this->db->transBegin();
            $builder = $this->db->table('onotification');
            $builder->set($request["record_header"]);
            $builder->where("base_ref",$request["record_header"]["id"]);
            $builder->update();

            if ($this->db->transStatus() === FALSE) {
                $this->db->transRollback();
                $response['success'] = false;
                $response['message'] = 'Error deleting record!';
            } else {
                $this->db->transCommit();
                $response['success'] = true;
                $response['message'] = 'Success!';
            }//End if*/
        }catch (\Exception $e) {
            $response["success"] = false;
            $response["message"] = $e->getMessage();
        }//End try
        return $response;
    }//end if

    function get_invitation($request){
        $response   = [];
        $qrystr     = "";
        if(isset($_SESSION['userid'])){
            $qrystr = "SELECT t0.*,
                                (SELECT STR_TO_DATE(CONCAT(interview_date, ' ',interview_end_time), '%m/%d/%Y %h:%i %p') < NOW()
                                FROM job_post_for_interview WHERE id = t0.base_ref) AS 'is_expired' 
                        FROM onotification t0
                        LEFT JOIN job_post_for_interview t1 
                        ON t0.base_ref = t1.id
                        WHERE t1.id = '".$request["record_header"]['id']."'";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }//end if
        }else{
            $response['num_rows'] = 0;
            $response['data'] = array();
        }//end if
        

        return $response;
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


    //check duplicate
    function check_duplicate($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["dup_table"]." t0
                                WHERE ".$param["dup_filter"]."";
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
    }//end function
    //end check duplicate


    //check duplicate
    function check_status($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                            FROM  ".$param["dup_table"]." t0
                            WHERE ".$param["dup_filter"]."";
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
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

        

       //update
        $for_update_id = 0;
        if(isset($data['for_update'])){
            for ($i=0; $i < count($data['for_update']); $i++) { 
                //$this->db->query(implode(";",$data['user']));
                $this->db->query($data['for_update'][$i]);
                $for_update_id = $this->db->insertID();
            }//end for
        }//end if
        //end update

        //insert notification
        if(isset($data["notification"])){
            $data["notification"]["base_ref"] = $id;
            $builder = $this->db->table('onotification');
            $builder->insert($data['notification']);
        }//end if
        //end insert notification

        //add move to
        $builder = $this->db->table('job_post_move_to');
        $builder->insert($data['move_to']);
        //$id = $this->db->insertID();
        //end add move to
        

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