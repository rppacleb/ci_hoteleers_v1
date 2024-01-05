<?php
namespace App\Models;

use CodeIgniter\Model;

class Audit_trail_model extends Model {
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

	function get_current_header_record($id,$table_name){
        $qrystr     = "SELECT t0.*
                        FROM ".$table_name." t0
                        WHERE t0.id = '$id'
                        ORDER BY t0.id";
        
        $query      = $this->db->query($qrystr);
        return $query->getResultArray();
    }//End 

    function get_current_line_record($id,$table_name){
        $qrystr     = "SELECT t0.*
                        FROM ".$table_name." t0
                        WHERE t0.id = '$id'
                        ORDER BY t0.id,t0.line";
        $query      = $this->db->query($qrystr);
        return $query->getResultArray();
    }//End 

    function get_columns($table_name){
        $qrystr     = "DESC ".$table_name."";
        $query      = $this->db->query($qrystr);
        return $query->getRow();
    }//end function

    //Get system notes list
    function system_notes_list($id,$record_type){
        $qrystr = "SELECT t0.date_time,
                        t1.name,
                        t0.action,
                        t0.line,
                        t0.record_field,
                        t0.record_field_old_value,
                        t0.record_field_new_value
                    FROM oaud t0
                    LEFT JOIN ousr t1
                    ON t0.user_id = t1.id
                    WHERE t0.record_type = '".$record_type."'";
        if($id <> ''){
            $qrystr .= " AND t0.record_id = '$id'";
        }//End if
        $qrystr .= " ORDER BY t0.date_time DESC";
        $query = $this->db->query($qrystr);
        return $query->getResultArray();
    }//Get system notes list

    //Add
    public function add($data){
        $this->db->transBegin();
        $this->db->table('oaud')->insertBatch($data['audit']);
        
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return 0;
        } else {
            $this->db->transCommit();
            return 1;
        }//End if
    }//End function

    
   

    public function add_lines($data){
        $this->db->transBegin();
        $this->db->table('oaud')->insertBatch($data['audit_lines']);
        
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return 0;
        } else {
            $this->db->transCommit();
            return 1;
        }//End if
    }//End function
    
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */