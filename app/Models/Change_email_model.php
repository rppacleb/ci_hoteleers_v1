<?php
namespace App\Models;

use CodeIgniter\Model;

class Change_email_model extends Model {
	protected $table      = 'profile_verification_code';
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
            $param['message'] = 'Invalid email!';
        }//end if

        return $param;
	}//end function auth_user

    function check_code($data){
		$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];
		$qrystr = "SELECT t0.*,
                          (MINUTE(TIMEDIFF(NOW(),date_created)) / 60) AS 'validity_hours'
					FROM profile_verification_code t0 
                    WHERE t0.id = '".$data["header"]["id"]."' 
					AND t0.verification_code = '".$data["placeholder"]["verification_code"]."' 
                    AND t0.inactive = 0
                    ORDER BY t0.date_created DESC LIMIT 1";
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
            $param['message'] = 'Invalid verification code!';
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
            $builder->where('id', $data['record_header']['id']);
            $builder->where('inactive', 1);
            $builder->delete();

            $builder = $this->db->table($this->table);
            $builder->set($data['record_header']);
            $builder->where('id', $data['record_header']['id']);
            $builder->where('verification_code', $data['record_header']['verification_code']);
            $builder->update();

        if(isset($data['record_ousr'])){
            $builder = $this->db->table('ousr');
            $builder->set($data['record_ousr']);
            $builder->where('id', $data['record_header']['id']);
            $builder->update();
        }//end if

        if(isset($data['record_profile'])){
            $builder = $this->db->table('oprofile');
            $builder->set($data['record_profile']);
            $builder->where('id', $data['record_header']['id']);
            $builder->update();
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
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */