<?php
namespace App\Models;

use CodeIgniter\Model;

class Home_model extends Model {
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

	function get_profile($param){
		$response 	= [];
		
		$qrystr = "SELECT t0.*,
							t1.*,
							(CASE WHEN(t0.user_type = 'applicant') THEN t1.first_login ELSE 0 END) AS 'first_login',
                            (CASE WHEN(t0.user_type = 'applicant' OR t0.user_type = 'employer') THEN t0.password_changed ELSE 0 END) AS 'password_changed',

                            (SELECT COUNT(id) FROM profile_education WHERE id = t0.id) AS 'education_count',
                            (SELECT COUNT(id) FROM profile_language WHERE id = t0.id) AS 'language_count',
                            (SELECT COUNT(id) FROM profile_industry WHERE id = t0.id) AS 'industry_count',
                            (SELECT COUNT(id) FROM profile_job_level WHERE id = t0.id) AS 'job_level_count',
                            (SELECT COUNT(id) FROM profile_job_type WHERE id = t0.id) AS 'job_type_count',
                            (SELECT COUNT(id) FROM profile_department WHERE id = t0.id) AS 'department_count',
                            (SELECT COUNT(id) FROM profile_experience WHERE id = t0.id) AS 'experience_count'
                            
					FROM ousr t0
					LEFT JOIN oprofile t1 
					ON t0.id = t1.id
					WHERE t0.inactive = false
					AND t0.id = '".$param['user_id']."'";
		$query = $this->db->query($qrystr);
		$response['num_rows']   	= $query->getNumRows();
		if($query->getNumRows() > 0){
            $response['data']       = $query->getRow();
        }else{
        	$response['data']       = null;
        }//end if

		return $response;
		//return $query->getRow();

	}//end function






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

        //update user
        if(isset($data['record_user']) > 0){
            $builder = $this->db->table('ousr');
            $builder->set($data['record_user']);
            $builder->where('id', $data['record_user']['id']);
            $builder->update();
        }//end if
        //end update user

        

        //add education

        if(isset($data['record_lines']) && count($data['record_lines']['row_education']) > 0){
            $this->db->table('profile_education')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_education')->insertBatch($data['record_lines']['row_education']);
        }//end if
        //end add education

        //add language
        if(isset($data['record_lines']) && count($data['record_lines']['row_language']) > 0){
            $this->db->table('profile_language')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_language')->insertBatch($data['record_lines']['row_language']);
        }//end if
        //end add language

        

        //add industry
        if(isset($data['record_lines']) && count($data['record_lines']['row_industry']) > 0){
            $this->db->table('profile_industry')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_industry')->insertBatch($data['record_lines']['row_industry']);
        }//end if
        //end add industry

        //add job level
        if(isset($data['record_lines']) && count($data['record_lines']['row_job_level']) > 0){
            $this->db->table('profile_job_level')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_job_level')->insertBatch($data['record_lines']['row_job_level']);
        }//end if
        //end add job level

        //add job type
        if(isset($data['record_lines']) && count($data['record_lines']['row_job_type']) > 0){
            $this->db->table('profile_job_type')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_job_type')->insertBatch($data['record_lines']['row_job_type']);
        }//end if
        //end job type

        //add department
        if(isset($data['record_lines']) && count($data['record_lines']['row_department']) > 0){
            $this->db->table('profile_department')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_department')->insertBatch($data['record_lines']['row_department']);
        }//end if
        //end add department

        

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


	//update record
    public function update_record_bak($data){
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
	
	//add record
    public function add_record_bak($data){
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


    //add batch record
    public function add_record_batch($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();

        $industry_id    = 0;
        $job_level_id   = 0;
        $job_type_id    = 0;
        $department_id  = 0;
        if(count($data['record_lines_industry']) > 0){
            $builder = $this->db->table('profile_industry');
            $builder->where('id', $data['record_header']['id']);
            $builder->delete();

            $this->db->table('profile_industry')->insertBatch($data['record_lines_industry']);
            $industry_id = $this->db->insertID();
        }//end if
        if(count($data['record_lines_job_level']) > 0){
            $builder = $this->db->table('profile_job_level');
            $builder->where('id', $data['record_header']['id']);
            $builder->delete();
            $this->db->table('profile_job_level')->insertBatch($data['record_lines_job_level']);
            $job_level_id = $this->db->insertID();
        }//end if
        if(count($data['record_lines_job_type']) > 0){
            $builder = $this->db->table('profile_job_type');
            $builder->where('id', $data['record_header']['id']);
            $builder->delete();

            $this->db->table('profile_job_type')->insertBatch($data['record_lines_job_type']);
            $job_type_id = $this->db->insertID();
        }//end if
        if(count($data['record_lines_deparment']) > 0){
            $builder = $this->db->table('profile_department');
            $builder->where('id', $data['record_header']['id']);
            $builder->delete();
            $this->db->table('profile_department')->insertBatch($data['record_lines_deparment']);
            $department_id = $this->db->insertID();
        }//end if
            

        $builder = $this->db->table($data['table_name']);
        $builder->set($data['record_header']);
        $builder->where('id', $data['record_header']['id']);
        $builder->update();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error creation of record!';
        } else {
            

            $industry_ids   = array();
            $job_level_ids  = array();
            $job_type_ids   = array();
            $department_ids = array();
            for ($x=0;$x <= count($data['record_lines_industry']) - 1;$x++) { 
                $industry_ids[]      = $industry_id;
                $industry_id         += 1; 
            }//for
            for ($x=0;$x <= count($data['record_lines_job_level']) - 1;$x++) { 
                $job_level_ids[]      = $job_level_id;
                $job_level_id         += 1; 
            }//for
            for ($x=0;$x <= count($data['record_lines_job_type']) - 1;$x++) { 
                $job_type_ids[]      = $job_type_id;
                $job_type_id         += 1; 
            }//for
            for ($x=0;$x <= count($data['record_lines_deparment']) - 1;$x++) { 
                $department_ids[]      = $department_id;
                $department_id         += 1; 
            }//for

            $param['success'] = true;
            $param['data']    = array(
                "industry_ids"      => $industry_ids,
                "job_level_ids"     => $job_level_ids,
                "job_type_ids"      => $job_type_ids,
                "department_ids"    => $department_ids
            );

            $this->db->transCommit();
        }//End if

        return $param;
    }//end add batch record

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

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */