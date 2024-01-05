<?php
namespace App\Models;

use CodeIgniter\Model;

class Generate_doc_model extends Model {
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

    function load_data($id,$request){
            $response   = [];
            $qrystr     = "";

            $response['data'] = [];

            $qrystr     = "SELECT t2.name AS 'full_name',
                                    t1.*,
                                    (DATE_FORMAT(t1.date_created, '%b %d, %Y')) AS 'date_created',
                                    (DATE_FORMAT(t1.date_created, '%b %Y')) AS 'joined_date',
                                     (SELECT COUNT(a.id) 
                                        FROM ojob_post a
                                        WHERE a.id = t2.id 
                                        AND (a.inactive = true
                                        OR a.status = 'closed'
                                        OR a.vacancies <= 0
                                        OR STR_TO_DATE(a.job_expiration_date,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                        OR (STR_TO_DATE(a.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p')))
                                    ) AS is_closed
                                     
                            FROM oprofile t1
                            INNER JOIN ousr t2
                            ON t1.id = t2.id
                            WHERE t1.id = '$id'";

            /*$qrystr     = "SELECT t1.name AS 'full_name',t0.*,
                                (DATE_FORMAT(t0.date_created, '%b %d, %Y')) AS 'date_created',
                                (DATE_FORMAT(t0.date_created, '%b %Y')) AS 'joined_date',
                                (CASE WHEN(t4.status IS NULL)
                                THEN
                                    ''
                                ELSE 
                                    t4.status
                                END) AS 'status',
                                (CASE WHEN(t5.id IS NULL) THEN 0 ELSE 0 END) AS 'is_interviewed',
                                (SELECT COUNT(a.id) 
                                    FROM ojob_post a
                                    WHERE a.id = t2.id 
                                    AND (a.inactive = true
                                    OR a.status = 'closed'
                                    OR a.vacancies <= 0
                                    OR STR_TO_DATE(a.job_expiration_date,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                    OR (STR_TO_DATE(a.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p')))
                                ) AS is_closed
                            FROM oprofile t0
                            INNER JOIN ousr t1
                            ON t0.id = t1.id
                            INNER JOIN job_post_applicant t2 
                            ON t0.id = t2.user_id
                            AND t1.id = t2.user_id
                            INNER JOIN ojob_post t3
                            ON t2.id = t3.id
                            LEFT JOIN job_post_move_to t4
                            ON t3.id = t4.id
                            AND t0.id = t4.user_id
                            AND t4.if_current = true
                            LEFT JOIN job_post_for_interview t5
                            ON t3.id = t5.id
                            AND t0.id  = t5.user_id
                            AND STR_TO_DATE(CONCAT(t5.interview_date, ' ',t5.interview_end_time), '%m/%d/%Y %h:%i %p') > NOW()
                            WHERE t0.id = '$id'
                            ";*/

            

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();
            }//end if

            //experience
            $response['line_experience'] = [];
            $qrystr     = "SELECT   t0.*,
                                    DATE_FORMAT(STR_TO_DATE(t0.start_date,'%m/%d/%Y'), '%b %d, %Y') AS 'start_date',
                                    DATE_FORMAT(STR_TO_DATE(t0.end_date,'%m/%d/%Y'), '%b %d, %Y') AS 'end_date'
                            FROM profile_experience t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_experience'] = $query->getResultArray();
            }//end if
            //end experience

            //skills
            $response['line_skills'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_skills t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_skills'] = $query->getResultArray();
            }//end if
            //end skills

            //education
            $response['line_education'] = [];
            $qrystr     = "SELECT   t0.*,
                                    t1.name AS 'education_text'
                            FROM profile_education t0
                            LEFT JOIN oeducation t1
                            ON t0.education = t1.id
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_education'] = $query->getResultArray();
            }//end if
            //end education

            //language
            $response['line_language'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_language t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_language'] = $query->getResultArray();
            }//end if
            //end language

            //certifications and licenses
            $response['line_certification'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_certifications_licenses t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_certification'] = $query->getResultArray();
            }//end if
            //end certifications and licenses

            //projects
            $response['line_projects'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_projects t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_projects'] = $query->getResultArray();
            }//end if
            //end projects


            //seminars and trainings
            $response['line_seminars_trainings'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_seminars_trainings t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_seminars_trainings'] = $query->getResultArray();
            }//end if
            //end seminars and trainings


            //awards and achievements
            $response['line_awards_achievements'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_awards_achievements t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_awards_achievements'] = $query->getResultArray();
            }//end if
            //end awards and achievements

            //affiliations
            $response['line_affiliations'] = [];
            $qrystr     = "SELECT   t0.*
                            FROM profile_affiliations t0 
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_affiliations'] = $query->getResultArray();
            }//end if
            //end affiliations


            //industry
            $response['line_industry'] = [];
            $qrystr     = "SELECT   t0.line,
                                    t0.industry,
                                    t1.name AS 'industry_text' 
                            FROM profile_industry t0 
                            LEFT JOIN oindustry t1 
                            ON t0.industry = t1.id
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_industry'] = $query->getResultArray();
            }//end if
            //end industry

            //job_level
            $response['line_job_level'] = [];
            $qrystr     = "SELECT   t0.line,
                                    t0.job_level,
                                    t1.name AS 'job_level_text' 
                            FROM profile_job_level t0 
                            LEFT JOIN ojob_level t1 
                            ON t0.job_level = t1.id
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_job_level'] = $query->getResultArray();
            }//end if
            //end job_level

            //job type
            $response['line_job_type'] = [];
            $qrystr     = "SELECT   t0.line,
                                    t0.job_type,
                                    t1.name AS 'job_type_text' 
                            FROM profile_job_type t0 
                            LEFT JOIN ojob_type t1 
                            ON t0.job_type = t1.id
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_job_type'] = $query->getResultArray();
            }//end if
            //end job type

            //department
            $response['line_department'] = [];
            $qrystr     = "SELECT   t0.line,
                                    t0.department,
                                    t1.name AS 'department_text' 
                            FROM profile_department t0 
                            LEFT JOIN odepartment t1 
                            ON t0.department = t1.id
                            WHERE t0.id = '$id'
                            ORDER BY t0.line ASC";
            $query      = $this->db->query($qrystr);
            if($query->getNumRows() > 0){
                $response['line_department'] = $query->getResultArray();
            }//end if
            //end department

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
                                WHERE t0.id <> '".$param["dup_id"]."' AND
                                t0.".$param["dup_filter"]." IN ?";
            $query                      = $this->db->query($qrystr,[$param["names"]]);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
    }//end function
	//end check duplicate

    //check status
    function check_status($param){
            $response   = [];
            $qrystr     = "";

            $qrystr     = "SELECT t0.* 
                                FROM ".$param["dup_table"]." t0
                                WHERE ".$param["dup_filter"]."";
            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if
            return $response;
    }//end function
    //end check status

    

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

        //update user
        if(isset($data['record_user']) > 0){
            $builder = $this->db->table('ousr');
            $builder->set($data['record_user']);
            $builder->where('id', $data['record_user']['id']);
            $builder->update();
        }//end if
        //end update user

        //add experience
        if(count($data['record_lines']['row_experience']) > 0){
            $this->db->table('profile_experience')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_experience')->insertBatch($data['record_lines']['row_experience']);
        }//end if
        //end add experience

        //add skills
        if(count($data['record_lines']['row_skills']) > 0){
            $this->db->table('profile_skills')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_skills')->insertBatch($data['record_lines']['row_skills']);
        }//end if
        //end add skills

        //add education
        if(count($data['record_lines']['row_education']) > 0){
            $this->db->table('profile_education')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_education')->insertBatch($data['record_lines']['row_education']);
        }//end if
        //end add education

        //add language
        if(count($data['record_lines']['row_language']) > 0){
            $this->db->table('profile_language')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_language')->insertBatch($data['record_lines']['row_language']);
        }//end if
        //end add language

        //add certification and licenses
        if(count($data['record_lines']['row_certification']) > 0){
            $this->db->table('profile_certifications_licenses')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_certifications_licenses')->insertBatch($data['record_lines']['row_certification']);
        }//end if
        //end add certification and licenses

        //add projects
        if(count($data['record_lines']['row_projects']) > 0){
            $this->db->table('profile_projects')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_projects')->insertBatch($data['record_lines']['row_projects']);
        }//end if
        //end add projects

        //add seminar trainings
        if(count($data['record_lines']['row_seminar_training']) > 0){
            $this->db->table('profile_seminars_trainings')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_seminars_trainings')->insertBatch($data['record_lines']['row_seminar_training']);
        }//end if
        //end add seminar trainings

        //add award and achievements
        if(count($data['record_lines']['row_award_achievement']) > 0){
            $this->db->table('profile_awards_achievements')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_awards_achievements')->insertBatch($data['record_lines']['row_award_achievement']);
        }//end if
        //end add award and achievements

        //add affiliation
        if(count($data['record_lines']['row_affiliation']) > 0){
            $this->db->table('profile_affiliations')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_affiliations')->insertBatch($data['record_lines']['row_affiliation']);
        }//end if
        //end add affiliation

        //add industry
        if(count($data['record_lines']['row_industry']) > 0){
            $this->db->table('profile_industry')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_industry')->insertBatch($data['record_lines']['row_industry']);
        }//end if
        //end add industry

        //add job level
        if(count($data['record_lines']['row_job_level']) > 0){
            $this->db->table('profile_job_level')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_job_level')->insertBatch($data['record_lines']['row_job_level']);
        }//end if
        //end add job level

        //add job type
        if(count($data['record_lines']['row_job_type']) > 0){
            $this->db->table('profile_job_type')->delete(array('id' => $data['record_header']['id']));
            $this->db->table('profile_job_type')->insertBatch($data['record_lines']['row_job_type']);
        }//end if
        //end job type

        //add department
        if(count($data['record_lines']['row_department']) > 0){
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
            $param['data'] 	  = array(
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

       //update
        $for_update_id = 0;
        if(isset($data['for_update'])){
            for ($i=0; $i < count($data['for_update']); $i++) { 
                //$this->db->query(implode(";",$data['user']));
                $this->db->query($data['for_update'][$i]);
                $for_update_id = $this->db->insertID();
            }//end for
        }//end if
        //end update

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