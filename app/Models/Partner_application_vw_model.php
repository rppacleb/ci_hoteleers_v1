<?php
namespace App\Models;

use CodeIgniter\Model;

class Partner_application_vw_model extends Model {
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

    function load_data($id){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.*,
                            t1.name AS 'industry_text', 
                            t2.name AS 'status_text',
                            (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'date_created',
                            (DATE_FORMAT(t0.date_created, '%b %Y')) AS 'joined_date',
                            (t3.doc_image) AS 'doc_image'
                            FROM osignup t0
                            LEFT JOIN oindustry t1 
                            ON t0.industry = t1.id
                            LEFT JOIN ostatus t2
                            ON t0.status = t2.id
                            LEFT JOIN oemployer t3
                            ON t0.id = t3.signup
                            WHERE t0.id = '$id'";


            $qrystr .= " ORDER BY t0.date_created DESC";

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getRow();   
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
            $param['message'] = 'Error updating record!';
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
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */