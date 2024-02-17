<?php
namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model {
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


            if($type == 'user_archived'){
                $qrystr     = "SELECT t3.*,t4.*
                            FROM ousr_archive t3
                            INNER JOIN oemployer t0
                            ON t3.employer = t0.id
                            INNER JOIN oprofile t4 
                            ON t3.id = t4.id
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE 1";  
            }else{
                $qrystr     = "SELECT t3.*,t4.*
                            FROM ousr t3
                            INNER JOIN oemployer t0
                            ON t3.employer = t0.id
                            INNER JOIN oprofile t4 
                            ON t3.id = t4.id
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE 1";
            }
            

			if(isset($request['filter']) && $request['filter'] !== ""){
                $qrystr .= " AND ".$request['filter_field']." = " . $request['filter'];
			}//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t3.name LIKE '".$request['keyword']."'
                            OR t3.designation LIKE '".$request['keyword']."'
                            OR t3.email_add LIKE '".$request['keyword']."')";
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

    


    function get_master_data($param){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT t0.*
							FROM ".$param['table_name']." t0
                            WHERE 1";

            if(isset($param["filter_field"])){
                $qrystr .= " AND ".$param["filter_field"]." = '".$param["filter_value"]."'";
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

    function check_related_records($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["rr_table"]." t0
                                WHERE t0.".$param["rr_filter"]." IN ?";
            $query                      = $this->db->query($qrystr,[$param["rr_filter_name"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function


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
            $param['message'] = 'Error updating record.';
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

        // return $data;

        $this->db->transBegin();
        $this->db->query("INSERT INTO ousr_archive
            SELECT * FROM ousr WHERE id = '".$data['record_header']['id']."'"
        );

        $builder = $this->db->table($data['table_name']);
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();

        // $builder = $this->db->table('oprofile');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_affiliations');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_awards_achievements');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_certifications_licenses');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_department');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_education');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_experience');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_industry');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_job_level');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_job_type');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_language');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_projects');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_seminars_trainings');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('profile_skills');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        // $builder = $this->db->table('usr_job_post_fav');
        // $builder->where('id', $data['record_header']['id']);
        // $builder->delete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error deleting record.';
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