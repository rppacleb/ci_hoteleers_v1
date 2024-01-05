<?php
namespace App\Models;

use CodeIgniter\Model;

class Signup_model extends Model {
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


    function get_record($param){
        $response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
        $qrystr = "SELECT t0.*
                    FROM o".$param['type']." t0
                    WHERE t0.inactive = false
                    ORDER BY t0.sequence DESC,t0.name ASC";
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

	function auth_user($param){
		$response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];
		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE t0.inactive = false
					AND t0.username = BINARY('".$param['header']['username']."')
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

    function check_duplicate($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["table_name"]." t0
                                WHERE t0.status <> 3 
                                AND t0.username IN ?";      
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
        //return $query->getResult();
    }//end function

    function check_duplicate2($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["table_name"]." t0
                                WHERE 1 
                                AND t0.username IN ?";      
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
        //return $query->getResult();
    }//end function

	function auth_email($param){
		$response              = [];
        $response['success']   = true;
        $response['message']   = '';
        $response['data']      = [];

		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE t0.inactive = false
					AND t0.username = BINARY('".$param['header']['username']."')";
		$query = $this->db->query($qrystr);

		$response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
        	$response['success']    = true;   
            $response['data']       = $query->getRow();   
        }else{
        	$response['success']    = false; 
        	$response['message']    = "Incorrect email address";  
        }//end if
		
		//return 'dsfa';
		return $response;

	}//end auth_user

    //add batch record
    public function add_record($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $this->db->table($data['table_name'])->insertBatch($data['record_header']);
        //$this->db->table($data['table_name'])->insert($data['record_header']);
        $id = $this->db->insertID();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creation of record!';
        } else {
            
            

            $this->db->transCommit();

            $ids = array();
            for ($x=0;$x <= count($data['record_header']) - 1;$x++) { 
                $ids[]      = $id;
                $id         += 1; 
            }//for

            $param['success'] = true;
            $param['data']    = array(
                "id" => $ids
            );
        }//End if

        return $param;
    }//end add batch record


    //add user
    public function add_user($data){
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

       
        //add profile
        $profile_id = 0;
        if(isset($data['record_profile'])){
            if(count($data['record_profile']) > 0){
                $data['record_profile']['id'] = $id;
                $builder = $this->db->table('oprofile');
                $builder->insert($data['record_profile']);
                $profile_id = $id;
            }//end if
        }//end if
        //end add profile

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creating record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data']    = array(
                "id" => $id,
                "profile_id" => $profile_id
            );
        }//End if

        return $param;
    }//end function
    //end add user

    //Update
    public function update_rec($table,$data){
        $this->db->transBegin();
        $builder = $this->db->table($table);
        $builder->set($data['header']);
        $builder->where('id', $data['header']['id']);
        $builder->update();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return 0;
        } else {
            $this->db->transCommit();
            return $data['header']['id'];
        }//End if
    }//End function
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */