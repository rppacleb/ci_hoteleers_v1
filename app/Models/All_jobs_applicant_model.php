<?php
namespace App\Models;

use CodeIgniter\Model;

class All_jobs_applicant_model extends Model {
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


            
            if($request['view_type'] == "" || $request['view_type'] == "job_post"){
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        CONCAT(t2.location) AS 'location_placeholder',
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                AND t0.user_id NOT IN(SELECT DISTINCT user_id FROM job_post_move_to WHERE id= t4.id)
                        
                                
                                ";

                


            }else if($request['view_type'] == "short_listed"){
                //short listed
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.locality, ' ',t2.country) AS 'location_placeholder',
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                AND t8.if_current = true
                                AND t8.status = 'short listed'
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                               
                                ";


              
            }else if($request['view_type'] == "interviews"){
                //interviews
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.locality, ' ',t2.country) AS 'location_placeholder',
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                AND t8.status = 'for interview'
                                AND t8.if_current = true
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                
                                ";
                

                //end interviews
            }else if($request['view_type'] == "offered"){
                //offered
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.locality, ' ',t2.country) AS 'location_placeholder',
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                AND t8.if_current = true
                                AND t8.status = 'offered'
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                
                                ";
                
                
                //end short listed
            }else if($request['view_type'] == "hired"){
                //hired
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.locality, ' ',t2.country) AS 'location_placeholder',
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                AND t8.status = 'hired'
                                AND t8.if_current = true
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                
                                ";

                
                
                //end short listed
            }else if($request['view_type'] == "leads"){
                //leads
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.locality, ' ',t2.country) AS 'location_placeholder',
                                        t4.id AS 'job_post_id',
                                        t4.job_title,
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                
                                AND t8.status = 'hired'
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                

                                AND (t4.industry IN(SELECT industry FROM profile_industry WHERE id = t0.user_id) OR 
                                t4.job_level IN(SELECT job_level FROM profile_job_level WHERE id = t0.user_id) OR
                                t4.job_type IN(SELECT job_type FROM profile_job_type WHERE id = t0.user_id) OR 
                                t4.department IN(SELECT department FROM profile_department WHERE id = t0.user_id))
                                ";

                
            }//end if
            

			/*if(isset($request['status']) && $request['status'] !== ""){
                $qrystr .= " AND (CASE WHEN((DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour) IS NULL OR (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p')) IS NULL)) THEN 1 WHEN (CURRENT_TIMESTAMP BETWEEN (DATE_ADD(STR_TO_DATE(CONCAT(t0.start_date, ' ',t0.start_time), '%m/%d/%Y %h:%i %p'),INTERVAL 12 hour)) AND (STR_TO_DATE(CONCAT(t0.end_date, ' ',t0.end_time), '%m/%d/%Y %h:%i %p'))) THEN 4 ELSE 5 END) = '".$request['status']."'";
                

                

				
			}//end if*/
            if($request['status'] == 'closed'){
                $qrystr  .= " AND (t4.inactive = true
                            OR t4.status = 'closed'
                            OR t4.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t4.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR STR_TO_DATE(t4.remove_on,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t4.id) > 0";

            }else if($request['status'] == 'deactivated'){
                $qrystr .= " AND (t4.inactive = true
                            OR t4.status = 'closed'
                            OR t4.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t4.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y'))
                            OR (STR_TO_DATE(t4.remove_on,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y'))
                            ) 
                            AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t4.id) <= 0";
            }else{

                $qrystr  .= " AND t4.inactive = false
                                AND t4.status = 'active'
                                AND t4.vacancies > 0
                                AND DATE_ADD((STR_TO_DATE(t4.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                AND (STR_TO_DATE(remove_on,'%m/%d/%Y') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y') OR remove_on IS NULL OR remove_on = '')";
            }//end if

            if(isset($request['employer_id']) && $request['employer_id'] !== ""){
                $qrystr .= " AND t4.employer = ".$request['employer_id']."";
            }//end if

          
            

            /*
            SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        IFNULL(t3.designation,'') AS 'current_job', 
                                        IFNULL(t3.company_name,'') AS 'company_name',
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '98'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                AND t3.if_current = true
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                AND t5.if_current = true
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 


                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
            */

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t1.name LIKE '%".$request['keyword']."%'";
				$qrystr .= " OR t3.company_name LIKE '%".$request['keyword']."%'
                            OR t3.designation LIKE '%".$request['keyword']."%')";
			}//end if

            if($request['view_type'] !== "leads"){
                /*if(isset($request['job_title'])){
                    $operator = "OR";
                    $nix = implode(" ",$request['job_title']);
                    $qrystr .= " AND MATCH(t3.designation)
                                    AGAINST('".$nix."')";
                    
                }//end job title
                */

                if(isset($request['job_title'])){
                    $operator = "OR";
                    $nix = implode(" ",$request['job_title']);
                    //$qrystr .= " AND (MATCH(t2.designation)
                                    //AGAINST('".$nix."')";

                    $q = "";
                    foreach ($request['job_title'] as $key => $value) {
                        $q .= "t3.designation LIKE '%".$value."%' OR ";
                    }//end foreach

                    $q = substr($q, 0, strlen($q) - 3);

                    $qrystr .= " AND (".$q.")";
                }//end job title
            }else{
               /* if(isset($request['job_title'])){
                    $operator = "OR";
                    $nix = implode(" ",$request['job_title']);
                    $qrystr .= " AND MATCH(t8.designation)
                                    AGAINST('".$nix."')";
                }//end job title*/

                if(isset($request['job_title'])){
                    $operator = "OR";
                    $nix = implode(" ",$request['job_title']);
                    //$qrystr .= " AND (MATCH(t2.designation)
                                    //AGAINST('".$nix."')";

                    $q = "";
                    foreach ($request['job_title'] as $key => $value) {
                        $q .= "t8.designation LIKE '%".$value."%' OR ";
                    }//end foreach

                    $q = substr($q, 0, strlen($q) - 3);

                    $qrystr .= " AND (".$q.")";
                }//end job title
            }//end if

            if(isset($request['skills'])){
                $operator = "OR";
                $nix = implode(" ",$request['skills']);
                $qrystr .= " AND MATCH(t7.skills) AGAINST('".$nix."')";
            }//end skills


            //filter intern
            if (isset($request['filter_intern'])) {
                if ($request['filter_intern'] === "true") {
                    $operator = "AND";
                    $qrystr .= " ".$operator." t2.internship = true";
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
                                AND user_id = t1.id) > 0";
                }//end if
            }



            $in_cont = array();
            if(isset($request['location'])){
                $qrystr .= " AND t2.location IN ?";
                $in_cont[count($in_cont)] = $request['location'];
            }//end 


            /*
            //job title
            if(isset($request['job_title'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t4.job_title IN ?";
                $in_cont[count($in_cont)] = $request['job_title'];
            }//end job title
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
                                        FROM profile_experience a where a.id = t0.user_id) > ".$value[0];

                        //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id)) > ".$value[0]."";
                    }else{
                       //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id)) BETWEEN ".$value[0]." AND ".$value[1].""; 
                        $year_str .= "(SELECT SUM(DATEDIFF((CASE WHEN (a.end_date = '' OR a.end_date IS NULL) 
                                                                THEN (STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')) 
                                                                ELSE (STR_TO_DATE(a.end_date,'%m/%d/%Y'))
                                                              END),
                                                        (STR_TO_DATE(a.start_date,'%m/%d/%Y'))  
                                                  ) / 365)
                                        FROM profile_experience a where a.id = t0.user_id) BETWEEN ".$value[0]." AND ".$value[1];
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
                

                $qrystr .= " ".$operator." t5.education IN ?";
                $in_cont[count($in_cont)] = $request['education'];
            }//end 

            //language
            if(isset($request['language'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t6.language IN ?";
                $in_cont[count($in_cont)] = $request['language'];
            }//end 

            /*
            //skills
            if(isset($request['skills'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t7.skills IN ?";
                $in_cont[count($in_cont)] = $request['skills'];
            }//end 
            */

            if($request['view_type'] == "leads"){
                $qrystr .= " ORDER BY t1.name ASC";
            }else{
                if($request['view_type'] == "" || $request['view_type'] == "job_post"){
                    $qrystr .= " ORDER BY t0.date_created DESC";
                }else{
                    $qrystr .= " ORDER BY t8.date_created DESC";
                }//end if
                
            }
           
            //$qrystr .= " ORDER BY t1.name ASC";
            
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if

            $query      				= $this->db->query($qrystr,$in_cont);
            // Retrieve the last executed query
            $last_query = $this->db->getLastQuery();

            // Display the last executed query
            echo $last_query;
            // $response['num_rows']   	= $query->getNumRows();
	        // if($query->getNumRows() > 0){
	        //     $response['data']       = $query->getResultArray();   
	        // }

            return $response;
    }//end function

    
    function get_counter($request){
        $response   = [];
        $qrystr     = "";

        if($request['status'] == 'closed'){
            $qrystr     = "SELECT 'applicant' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_applicant t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'
                       AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) > 0
                        
                            
                        GROUP BY 'applicant'
                       UNION ALL
                       SELECT 'job_post' AS 'counter_type',
                                COUNT(t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."' 
                       AND (t0.inactive = true
                            OR t0.status = 'closed'
                            OR t0.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) > 0
                        GROUP BY 'job_post'
                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'short listed'
                       
                       AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) > 0
                        GROUP BY 'short_listed'
                       UNION ALL
                       SELECT 'for_interview' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'for interview'
                       
                        AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) > 0
                        GROUP BY 'for_interview'
                       UNION ALL
                       SELECT 'offered' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'offered'
                       
                        AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) > 0
                        GROUP BY 'offered'

                       ";
        }else if($request['status'] == 'deactivated'){
            $qrystr     = "SELECT 'applicant' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_applicant t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) <= 0
                        GROUP BY 'applicant'
                       UNION ALL
                       SELECT 'job_post' AS 'counter_type',
                                COUNT(t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."' 
                       AND (t0.inactive = true
                            OR t0.status = 'closed'
                            OR t0.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) <= 0
                        GROUP BY 'job_post'
                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'  
                       AND t0.status = 'short listed'
                       
                       AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) <= 0
                        GROUP BY 'short_listed'
                       UNION ALL
                       SELECT 'for_interview' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'for interview'
                       
                        AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) <= 0
                        GROUP BY 'for_interview'
                       UNION ALL
                       SELECT 'offered' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'  
                       AND t0.status = 'offered'
                       
                        AND (t2.inactive = true
                            OR t2.status = 'closed'
                            OR t2.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t2.id) <= 0
                        GROUP BY 'offered'


                       ";
        }else{
            $qrystr     = "SELECT 'applicant' AS 'counter_type',
                                COUNT(t0.user_id) AS 'counter'
                       FROM job_post_applicant t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id 
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'
                       AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        AND t0.user_id NOT IN(SELECT DISTINCT user_id FROM job_post_move_to WHERE id= t2.id)
                        GROUP BY 'applicant'
                       UNION ALL
                       SELECT 'job_post' AS 'counter_type',
                                COUNT(t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."'
                       AND t0.inactive = false
                        AND t0.status = 'active'
                        AND t0.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'job_post'
                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t0.if_current = true
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'                         
                       AND t0.status = 'short listed'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'short_listed'
                       UNION ALL
                       SELECT 'for_interview' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                       AND t0.if_current = true
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."'
                       AND t0.status = 'for interview'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                        GROUP BY 'for_interview'
                       UNION ALL
                       SELECT 'offered' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ojob_post t2
                       ON t0.id = t2.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                       AND t0.if_current = true
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t2.employer = '".$request['employer_id']."' 
                       AND t0.status = 'offered'
                       
                        AND t2.inactive = false
                        AND t2.status = 'active'
                        AND t2.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t2.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')

                        GROUP BY 'offered'

                       ";
        }//end if

        
        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
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

            if(isset($param['filter']) && $param['filter'] !== ""){
                $qrystr .= " AND ".$param['filter']."";
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


    //check duplicate
    function check_duplicate2($param){
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