<?php
namespace App\Models;

use CodeIgniter\Model;

class Manage_dropdown_model extends Model {
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

    function get_record($type,$perPage,$offset){
    		$response 	= [];
    		$qrystr 	= "";

            $qrystr     = "SELECT t0.* 
                            FROM o".$type." t0";
            if($type == 'perks_and_benefits'){
                $qrystr     = "SELECT t0.* 
                            FROM o".$type." t0
                            LEFT JOIN ousr t1
                            ON t0.created_by = t1.id
                            WHERE t1.user_type = 'admin'";
            }//end if

    		/*if($type == 'education'){
    			$qrystr     = "SELECT t0.* 
    							FROM oeduc t0";
    		}else if($type == 'job_type'){
    			$qrystr     = "SELECT t0.* 
    							FROM ojob t0";
    		}//end if
            */

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
        
    
        //return $query->getResult();
    }//end function

    function load_data($type,$id){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                            FROM o".$type." t0
                            WHERE t0.id = '$id'";

            /*if($type == 'education'){
                $qrystr     = "SELECT t0.* 
                                FROM oeduc t0
                                WHERE t0.id = '$id'";
            }else if($type == 'job_type'){
                $qrystr     = "SELECT t0.* 
                                FROM ojob t0
                                WHERE t0.id = '$id'";
            }//end if*/

            $qrystr .= " ORDER BY t0.date_created DESC";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getRow();   
            }//end if
            return $response;
        //return $query->getResult();
    }//end function

    function check_duplicate($param){
            $response   = [];
            $qrystr     = "";

            //if($param['type'] == 'perks_and_benefits'){
               // $qrystr     = "SELECT t0.* 
                                //FROM o".$param["type"]." t0
                                //WHERE t0.id NOT IN(SELECT id FROM operks_and_benefits_removed WHERE user_id = '".$param['user_id']."')
                                //AND t0.name IN ?";
            //}else{
                $qrystr     = "SELECT t0.* 
                                FROM o".$param["type"]." t0
                                WHERE t0.created_by = '".$param['user_id']."'
                                AND t0.name IN ?";
            //}
            

            /*if($param["type"] == 'education'){
                $qrystr     = "SELECT t0.* 
                                FROM oeduc t0
                                WHERE t0.name IN(".$param["names"].")";
            }else if($param["type"] == 'job_type'){
                $qrystr     = "SELECT t0.* 
                                FROM ojob t0
                                WHERE t0.name IN(".$param["names"].")";
            }//end if*/

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function

    function check_duplicate_removed($param){
            $response   = [];
            $qrystr     = "";

            //if($param['type'] == 'perks_and_benefits'){
               // $qrystr     = "SELECT t0.* 
                                //FROM o".$param["type"]." t0
                                //WHERE t0.id NOT IN(SELECT id FROM operks_and_benefits_removed WHERE user_id = '".$param['user_id']."')
                                //AND t0.name IN ?";
            //}else{
                $qrystr     = "SELECT t0.* 
                                FROM o".$param["type"]." t0
                                WHERE t0.id IN ?
                                AND t0.user_id = '".$param["record_header"]['user_id']."'";
            //}
            

            /*if($param["type"] == 'education'){
                $qrystr     = "SELECT t0.* 
                                FROM oeduc t0
                                WHERE t0.name IN(".$param["names"].")";
            }else if($param["type"] == 'job_type'){
                $qrystr     = "SELECT t0.* 
                                FROM ojob t0
                                WHERE t0.name IN(".$param["names"].")";
            }//end if*/

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function

    function check_removed($param){
            $response   = [];
            $qrystr     = "";

            //if($param['type'] == 'perks_and_benefits'){
               // $qrystr     = "SELECT t0.* 
                                //FROM o".$param["type"]." t0
                                //WHERE t0.id NOT IN(SELECT id FROM operks_and_benefits_removed WHERE user_id = '".$param['user_id']."')
                                //AND t0.name IN ?";
            //}else{
                $qrystr     = "SELECT t0.* 
                                FROM o".$param["type"]." t0
                                WHERE t0.created_by = '".$param['user_id']."'
                                AND t0.name IN ?";
            //}
            

            /*if($param["type"] == 'education'){
                $qrystr     = "SELECT t0.* 
                                FROM oeduc t0
                                WHERE t0.name IN(".$param["names"].")";
            }else if($param["type"] == 'job_type'){
                $qrystr     = "SELECT t0.* 
                                FROM ojob t0
                                WHERE t0.name IN(".$param["names"].")";
            }//end if*/

           
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            // $last_query = $this->db->getLastQuery();
            // echo $last_query;
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
        
    
        //return $query->getResult();
    }//end function


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

    //add record
    public function add_record($data){
    	$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $this->db->table($data['table_name'])->insert($data['record_header']);
        $id = $this->db->insertID();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creation of record!';
        } else {
            $this->db->transCommit();
            $param['success'] = true;
            $param['data'] 	  = array(
            	"id" => $id
            );
        }//End if

        return $param;
    }//end add record

    //add batch record
    public function add_record_batch($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        
        if(isset($data['record_lines_delete'])){
            if(count($data['record_lines_delete']) > 0){
                $builder = $this->db->table('operks_and_benefits_removed');
                $builder->whereIn('id', $data['record_lines_delete']);
                $builder->delete(); 
            }//end if
        }//end if
        


        $this->db->table($data['table_name'])->insertBatch($data['record_lines']);
        $id = $this->db->insertID();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creation of record!';
        } else {
            

            $ids = array();
            for ($x=0;$x <= count($data['record_lines']) - 1;$x++) { 
                $ids[]      = $id;
                $id         += 1; 
            }//for

            $param['success'] = true;
            $param['data']    = array(
                "id" => $ids
            );

            $this->db->transCommit();
        }//End if

        return $param;
    }//end add batch record

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
	
    //delete record
    public function delete_record($data){
    	$param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($data['table_name']);
        //$builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->delete();

        if($data['table_name'] == 'operks_and_benefits'){
            $builder = $this->db->table('operks_and_benefits_removed');
            $builder->where('id', $data['record_header']['id']);
            //$builder->where('user_id', $data['user_id']);
            $builder->delete();
        }//end if

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error deleting record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
            $param['data'] 	  = array(
            	"id" => $data['record_header']['id']
            );
        }//End if

        return $param;
    }//End delete header
	//end delete record

    //delete record
    public function delete_line_record($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();
        $builder = $this->db->table($data['table_name']);
        //$builder->set($data['record_header']);
        $builder->whereIn('id', $data['record_lines_delete']);
        $builder->delete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error deleting record!';
        } else {
            $this->db->transCommit();
            
            $param['success'] = true;
           
        }//End if

        return $param;
    }//End delete header
    //end delete record
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */