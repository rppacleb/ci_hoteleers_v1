<?php
namespace App\Models;

use CodeIgniter\Model;

class New_pass_model extends Model {
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

	function check_existence($data){
		$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE t0.inactive = false
					AND t0.username = BINARY('".$data['header']['username']."')";
		//$query = $this->db->query($qrystr);
		//return $query->row();

		$query = $this->db->query($qrystr);
		
		//return 'dsfa';
		if($query->getNumRows() > 0){
            $param['success'] = true;
            $param['data'] 	  = $query->getRow();
        }else{
            //return false;
            $param['success'] = false;
            $param['message'] = 'Invalid username!';
        }//end if

        return $param;
	}//end function auth_user

    function get_user($request){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
        $qrystr = "SELECT t0.*
                    FROM ousr t0
                    WHERE t0.inactive = false
                    AND t0.id = ('".$request['id']."')";
        //$query = $this->db->query($qrystr);
        //return $query->row();

        $query = $this->db->query($qrystr);
        
        //return 'dsfa';
        $param['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $param['success'] = true;
            $param['data']    = $query->getRow();
        }else{
            //return false;
            $param['success'] = false;
            $param['message'] = 'Invalid email!';
        }//end if

        return $param;
    }//end function auth_user


	function auth_user($data){
		$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
		$qrystr = "SELECT t0.*
					FROM ousr t0
					WHERE t0.inactive = false
					AND t0.username = BINARY('".$data['header']['username']."')
					AND t0.password = BINARY('".$data['header']['old_password']."')";
		//$query = $this->db->query($qrystr);
		//return $query->row();

		$query = $this->db->query($qrystr);
		
		//return 'dsfa';
		if($query->getNumRows() > 0){
            $param['success'] = true;
            $param['data'] 	  = $query->getRow();
        }else{
            //return false;
            $param['success'] = false;
            $param['message'] = 'Invalid password!';
        }//end if

        return $param;
	}//end function auth_user

	//Update header
    public function update_record($data){
    	$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($this->table);
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();

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
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */