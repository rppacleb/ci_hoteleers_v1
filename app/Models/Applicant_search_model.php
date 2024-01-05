<?php
namespace App\Models;

use CodeIgniter\Model;

class Applicant_search_model extends Model {
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

            /*$qrystr     = "SELECT t0.id, 
                                t0.name, 
                                t1.location, 
                                t2.designation AS 'current_job', 
                                t2.company_name, 
                                (SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id) AS 'start_date', 
                                
                                (SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id) AS 'end_date',   
                                timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id)) AS 'years_of_exp'
                        FROM ousr t0 
                        INNER JOIN oprofile t1 
                        ON t0.id = t1.id 
                        LEFT JOIN profile_experience t2 
                        ON t0.id = t2.id 
                        AND t2.if_current = true 
                        WHERE t0.inactive = false 
                        AND t0.id = 75";
               */

            $qrystr     = "SELECT DISTINCT t0.id,
                                t0.name,
                                t0.date_created,
                                t1.doc_image,
                                t1.location,
                                CONCAT(t1.location) AS 'location_placeholder',
                                IFNULL((SELECT designation FROM profile_experience WHERE id = t0.id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.id AND if_current = true LIMIT 1),'') AS 'company_name', 
                                IFNULL((SELECT user_id  FROM employer_saved_applicant WHERE id = '".$request['user_id']."' AND user_id = t0.id  LIMIT 1),'') AS 'profile_saved'
                        FROM ousr t0 
                        INNER JOIN oprofile t1 
                        ON t0.id = t1.id
                        LEFT JOIN profile_experience t2
                        ON t0.id = t2.id
                        LEFT JOIN profile_education t3
                        ON t0.id = t3.id
                        LEFT JOIN profile_language t4
                        ON t0.id = t4.id
                        LEFT JOIN profile_skills t5
                        ON t0.id = t5.id
                        WHERE t0.inactive = false
                        AND t0.user_type = 'applicant'
                        AND (t0.name IS NOT NULL AND t0.name <> '')";


            //
			/*if(isset($request['status']) && $request['status'] !== ""){
                $qrystr .= " AND (CASE WHEN((DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '".$request['status']."'";
                

                

				
			}//end if*/

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t0.name LIKE '%".$request['keyword']."%'";
				$qrystr .= " OR t1.location LIKE '%".$request['keyword']."%'";
				$qrystr .= " OR t2.designation LIKE '%".$request['keyword']."%'";
				$qrystr .= " OR t2.company_name LIKE '%".$request['keyword']."%')";
			}//end if

            $in_cont = array();
            if(isset($request['location'])){
                $qrystr .= " AND t1.location IN ?";
                $in_cont[count($in_cont)] = $request['location'];
            }//end 

           
            if(isset($request['job_title'])){
                $operator = "OR";
                $nix = implode(" ",$request['job_title']);
                //$qrystr .= " AND (MATCH(t2.designation)
                                //AGAINST('".$nix."')";

                $q = "";
                foreach ($request['job_title'] as $key => $value) {
                    $q .= "t2.designation LIKE '%".$value."%' OR ";
                }//end foreach

                $q = substr($q, 0, strlen($q) - 3);

                

                $qrystr .= " AND (".$q.")";
            }//end job title
            


            if(isset($request['skills'])){
                $operator = "OR";
                $nix = implode(" ",$request['skills']);
                $qrystr .= " AND MATCH(t5.skills) AGAINST('".$nix."')";
            }//end skills

            /*
            //job title
            if(isset($request['job_title'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t2.designation IN ?";
                $in_cont[count($in_cont)] = $request['job_title'];
            }//end job title
            */

           /*
            SELECT timestampdiff(YEAR,(STR_TO_DATE(a.start_date,'%m/%d/%Y')),  
                     (CASE WHEN (a.end_date = '' OR a.end_date IS NULL) 
                        THEN (STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')) 
                        ELSE (STR_TO_DATE(a.end_date,'%m/%d/%Y'))
                      END)
                    
                    )
FROM profile_experience a where a.id = 108;
           */

            //years
            $year_str = "";
            if(isset($request['years'])){
                $operator = "AND";
                $year_str  .= " ".$operator." (";
                foreach ($request['years'] as $key => $value) {

                    if($value[1] == '0' || $value[1] == 0){

                        $year_str .= "(SELECT SUM(DATEDIFF((CASE WHEN (a.end_date = '' OR a.end_date IS NULL) 
                                                                THEN (STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')) 
                                                                ELSE (STR_TO_DATE(a.end_date,'%m/%d/%Y'))
                                                              END),
                                                        (STR_TO_DATE(a.start_date,'%m/%d/%Y'))  
                                                  ) / 365)
                                        FROM profile_experience a where a.id = t0.id) > ".$value[0];

                        //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id)) > ".$value[0]."";
                    }else{
                       //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.id)) BETWEEN ".$value[0]." AND ".$value[1].""; 

                       $year_str .= "(SELECT SUM(DATEDIFF((CASE WHEN (a.end_date = '' OR a.end_date IS NULL) 
                                                                THEN (STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')) 
                                                                ELSE (STR_TO_DATE(a.end_date,'%m/%d/%Y'))
                                                              END),
                                                        (STR_TO_DATE(a.start_date,'%m/%d/%Y'))  
                                                  ) / 365)
                                        FROM profile_experience a where a.id = t0.id) BETWEEN ".$value[0]." AND " .$value[1];
                    }//end if

                    
                    if(($key+1) !== count($request['years'])){
                        $year_str .= " OR ";
                    }//end if
                }//end foreach

                $year_str  .= ")";

                $qrystr .= $year_str;
            }//end 

            //education
            if(isset($request['education'])){
                $operator = "AND";
                

                $qrystr .= " ".$operator." t3.education IN ?";
                $in_cont[count($in_cont)] = $request['education'];
            }//end 

            //language
            if(isset($request['language'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t4.language IN ?";
                $in_cont[count($in_cont)] = $request['language'];
            }//end 

            /*
            //skills
            if(isset($request['skills'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t5.skills IN ?";
                $in_cont[count($in_cont)] = $request['skills'];
            }//end 
            */

            //filter intern
            if (isset($request['filter_intern'])) {
                if ($request['filter_intern'] === "true") {
                    $operator = "AND";
                    $qrystr .= " ".$operator." t1.internship = true";
                }
            }

            //filter invited
            if (isset($request['filter_invited'])) {
                if ($request['filter_invited'] === "true") {
                    $operator = "AND";
                    $qrystr .= " ".$operator." (SELECT COUNT(*) 
                                FROM onotification
                                WHERE record_type = 'job_post'
                                AND created_by = '".$request['user_id']."' 
                                AND user_id = t0.id) > 0";
                }//end if
            }


           
            // $qrystr .= " ORDER BY t0.name ASC";
            $qrystr .= " ORDER BY t0.date_created DESC";
            
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if
            $response['qrystr'] = $qrystr;
            $query = $this->db->query($qrystr,$in_cont);
            $response['num_rows'] = $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray(); 
               
	        }//end if

            


            //get notification
            
            if(isset($response['data'])){
                $in_cont = array();
                $user_id = array();
                for ($i = 0; $i <= count($response['data']) - 1; $i++) {
                    $map_data = $response['data'][$i];
                    $user_id[] = $map_data['id'];
                }//end for
                $in_cont[count($in_cont)] = $user_id;

                if(count($user_id) > 0){
                    $qrystr = "SELECT t0.*,t1.job_title
                            FROM onotification t0
                        LEFT JOIN ojob_post t1
                        ON t0.record_id = t1.id
                        WHERE t0.record_type = 'job_post'
                        AND t0.created_by = '".$request['user_id']."'
                        AND t0.user_id IN ?";
                    $query = $this->db->query($qrystr,$in_cont);
                    
                    if($query->getNumRows() > 0){
                        $result = $query->getResultArray();
                        for ($i = 0; $i <= count($result) - 1; $i++) {
                            $map_data = $result[$i];
                            if(!isset($response['data_notification'][$map_data["user_id"]])){
                                $response['data_notification'][$map_data["user_id"]] = array();
                            }//end if

                            $response['data_notification'][$map_data["user_id"]][] = $map_data;
                            
                        }//end for
                        //$response['data_notification'] = $query->getResultArray();   
                    }//end if
                }//end if
            }//end if
        
            //end get notification

            return $response;
    }//end function

    


    function get_master_data($type){
    		$response 	= [];
    		$qrystr 	= "";
            $qrystr     = "SELECT t0.*
							FROM o".$type." t0
                            WHERE t0.name NOT IN('declined')";
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
        $builder->where('user_id', $data['record_header']['user_id']);
        $builder->delete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $param['success'] = false;
            $param['message'] = 'Error deleting record!';
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