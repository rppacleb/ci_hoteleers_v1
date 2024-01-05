<?php
namespace App\Models;

use CodeIgniter\Model;

class Homepage_banner_model extends Model {
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



            $qrystr     = "SELECT t3.*
                            FROM ousr t3
                            INNER JOIN oemployer t0
                            ON t3.employer = t0.id
                            LEFT JOIN oindustry t1
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            WHERE 1";

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


    function load_data($id){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.*
                            FROM ohomepage_banner t0
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