<?php
namespace App\Models;

use CodeIgniter\Model;

class Active_jobs_applicant_model extends Model {
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

            $word_skip = array('with');

            $filter1    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['job_title'])));
            $filter2    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['job_description'])));
            $filter3    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['qualification'])));


            //job title filter for leads
            $filter_str1 = "(";
            foreach ($filter1 as $key => $value) {
                $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
                if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                    continue;
                }//end
                $filter_str1 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str1 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str1 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            }//end foreach
            $filter_str1 = substr($filter_str1, 0,strlen($filter_str1) - 3);
            $filter_str1 .= ")";
            //end job title filter for leads

            //job description filter for leads
            $filter_str2 = "(";
            foreach ($filter2 as $key => $value) {
                $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
                if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                    continue;
                }//end
                $filter_str2 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str2 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str2 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            }//end foreach
            $filter_str2 = substr($filter_str2, 0,strlen($filter_str2) - 3);
            $filter_str2 .= ")";
            //end job description filter for leads


            //qualifications filter for leads
            $filter_str3 = "(";
            foreach ($filter3 as $key => $value) {
                $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
                if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                    continue;
                }//end
                $filter_str3 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str3 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
                $filter_str3 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";

                
            }//end foreach
            $filter_str3 = substr($filter_str3, 0,strlen($filter_str3) - 3);
            $filter_str3 .= ")";
            //end qualifications filter for leads




            /*$filter_str2 = "(";
            foreach ($filter2 as $key => $value) {
                $filter_str2 .= "a.name LIKE '%".$value."%' OR ";
            }//end foreach
            $filter_str2 = substr($filter_str2, 0,strlen($filter_str2) - 3);
            $filter_str2 .= ")";
            */

            /*$filter_str3 = "(";
            foreach ($filter3 as $key => $value) {
                $filter_str3 .= "t2.highlights LIKE '%".$value."%' OR ";
            }//end foreach
            $filter_str3 = substr($filter_str3, 0,strlen($filter_str3) - 3);
            $filter_str3 .= ")";
            */


            /*$filter_str4 = "(";
            foreach ($filter3 as $key => $value) {
                $filter_str4 .= "t9.certification LIKE '%".$value."%' OR ";
            }//end foreach
            $filter_str4 = substr($filter_str4, 0,strlen($filter_str4) - 3);
            $filter_str4 .= ")";
            */

            
            if($request['view_type'] == "" || $request['view_type'] == "job_post"){
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t0.date_created,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
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
                                AND t0.user_id NOT IN(SELECT DISTINCT user_id FROM job_post_move_to WHERE id='{$request['job_post_id']}')";
                                


                               
            }else if($request['view_type'] == "short_listed"){
                //short listed
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t0.date_created,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
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
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                
                                AND t8.status = 'short listed'
                                AND t8.if_current = true
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                AND t5.if_current = true
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id
                                
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')";


                         
                //end short listed
            }else if($request['view_type'] == "interviews"){
                //interviews
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t0.date_created,
                                        IFNULL((SELECT status FROM job_post_for_interview
                                        WHERE user_id = t0.user_id ORDER BY date_created DESC LIMIT 1),'') as 'interview_status',
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
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
                                AND t5.if_current = true
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')";
                

                
                //end interviews
            }else if($request['view_type'] == "offered"){
                //offered
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t0.date_created,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
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
                                INNER JOIN job_post_move_to t8
                                ON t0.id = t8.id 
                                AND t0.user_id = t8.user_id
                                AND t8.status = 'offered'
                                AND t8.if_current = true
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                                LEFT JOIN profile_experience t3
                                ON t0.user_id = t3.id
                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id
                                AND t5.if_current = true
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')";
               
                
                //end short listed
            }else if($request['view_type'] == "hired"){
                //hired
                $qrystr     = "SELECT DISTINCT t1.id,
                                        t0.date_created,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
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
                                AND t5.if_current = true
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')";

                
                
                //end short listed
            }else if($request['view_type'] == "leads"){
                
                
                //leads
                $qrystr = "SELECT DISTINCT t1.id,
                        t1.name,
                        t2.doc_image,
                        t2.location,
                        CONCAT(t2.location) AS 'location_placeholder',
                        IFNULL((SELECT designation FROM profile_experience WHERE id = t1.id AND if_current = true LIMIT 1),'') AS 'current_job', 
                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t1.id AND if_current = true LIMIT 1),'') AS 'company_name',
                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t1.id 
                                                LIMIT 1),'') AS 'profile_saved'
                FROM ousr t1
                INNER JOIN oprofile t2
                ON t1.id = t2.id
                LEFT JOIN profile_experience t8
                ON t1.id = t8.id
                LEFT JOIN profile_skills t7
                ON t1.id = t7.id
                LEFT JOIN profile_education t5
                ON t1.id = t5.id
                LEFT JOIN profile_language t6
                ON t1.id = t6.id
                WHERE t1.inactive = false
                AND t1.user_type = 'applicant'
                AND (t1.name IS NOT NULL AND t1.name <> '')
                AND (
                        ".$filter_str1."
                    OR  ".$filter_str2."
                    OR  ".$filter_str3."
                )
                ";
                /*$qrystr     = "SELECT DISTINCT t1.id,
                                        t1.name,
                                        t2.doc_image,
                                        t2.location,
                                        CONCAT(t2.location) AS 'location_placeholder',
                                        IFNULL((SELECT designation FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'current_job', 
                                        IFNULL((SELECT company_name FROM profile_experience WHERE id = t0.user_id AND if_current = true LIMIT 1),'') AS 'company_name',
                                        IFNULL((SELECT user_id  FROM employer_saved_applicant 
                                                WHERE id = '".$request['user_id']."'             
                                                AND user_id = t0.user_id 
                                                LIMIT 1),'') AS 'profile_saved'
                                FROM job_post_applicant t0
                                LEFT JOIN profile_experience t8
                                ON t0.user_id = t8.id

                                INNER JOIN ojob_post t4
                                ON t0.id = t4.id
                                
                                INNER JOIN ousr t1
                                ON t0.user_id = t1.id
                                INNER JOIN oprofile t2
                                ON t0.user_id = t2.id
                               


                                LEFT JOIN profile_education t5
                                ON t0.user_id = t5.id

                                INNER JOIN oeducation a 
                                ON t5.education = a.id

                                LEFT JOIN profile_certifications_licenses t9
                                ON t0.user_id = t9.id

                                
                                LEFT JOIN profile_language t6
                                ON t0.user_id = t6.id
                                LEFT JOIN profile_skills t7
                                ON t0.user_id = t7.id 
                                WHERE t1.inactive = false
                                AND t1.user_type = 'applicant'
                                AND (t1.name IS NOT NULL AND t1.name <> '')
                                AND (
                                        ".$filter_str1."
                                    OR  ".$filter_str2."
                                    OR  ".$filter_str3."
                                    OR  ".$filter_str4."
                                )


                                
                                ";
                */

                
            }//end if


            if($request['view_type'] !== "leads"){
                if(isset($request['employer_id']) && $request['employer_id'] !== ""){
                    $qrystr .= " AND t4.employer = ".$request['employer_id']."";
                }//end if
    
                if(isset($request['job_post_id']) && $request['job_post_id'] !== ""){
                    $qrystr .= " AND t0.id = ".$request['job_post_id']."";
                }//end if
            }//end if
            

            
            if(isset($request['keyword']) && $request['keyword'] !== ""){
                

                $qrystr .= " AND (t1.name LIKE '%".$request['keyword']."%'";
                //$def_table = "t0.user_id";
                $def_table = "t1.id";
                if($request['view_type'] !== "leads"){
                    $def_table = "t1.id";
                }//end if
                $qrystr .= " OR IFNULL((SELECT company_name FROM profile_experience WHERE id = ".$def_table." AND if_current = true),'') LIKE '%".$request['keyword']."%'
                             OR IFNULL((SELECT designation FROM profile_experience WHERE id = ".$def_table." AND if_current = true),'') LIKE '%".$request['keyword']."%')";
            }//end if

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


            if($request['view_type'] !== "leads"){

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




            $in_cont = array();
            if(isset($request['location'])){
                $qrystr .= " AND t2.location IN ?";
                $in_cont[count($in_cont)] = $request['location'];
            }//end 

            

            //years
            $year_str = "";
            if(isset($request['years'])){
                $def_table = "t0.user_id";
                if($request['view_type'] == "leads"){
                    $def_table = "t1.id";
                }//end if

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
                                        FROM profile_experience a where a.id = ".$def_table.") > ".$value[0];
                        //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id)) > ".$value[0]."";
                    }else{
                       //$year_str .= "timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id)) BETWEEN ".$value[0]." AND ".$value[1].""; 
                        $year_str .= "(SELECT SUM(DATEDIFF((CASE WHEN (a.end_date = '' OR a.end_date IS NULL) 
                                                                THEN (STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')) 
                                                                ELSE (STR_TO_DATE(a.end_date,'%m/%d/%Y'))
                                                              END),
                                                        (STR_TO_DATE(a.start_date,'%m/%d/%Y'))  
                                                  ) / 365)
                                        FROM profile_experience a where a.id = ".$def_table.") BETWEEN ".$value[0]." AND ".$value[1];
                    }//end if

                    
                    if(($key+1) !== count($request['years'])){
                        $year_str .= " OR ";
                    }//end if
                }//end foreach

                $year_str  .= ")";
                

                //$qrystr .= " ".$operator." timestampdiff(YEAR,(SELECT MIN(STR_TO_DATE(a.start_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id),(SELECT MAX(STR_TO_DATE(a.end_date,'%m/%d/%Y')) FROM profile_experience a WHERE a.id=t0.user_id)) IN ?";
                //$in_cont[count($in_cont)] = $request['years'];

                $qrystr .= $year_str;
            }//end 

            //education
            if(isset($request['education'])){
                //$qrystr .= " AND t5.education IN (".implode(",",$request['education']).")";
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

            //skills
            if(isset($request['skills'])){
                $operator = "AND";
                
                $qrystr .= " ".$operator." t7.skills IN ?";
                $in_cont[count($in_cont)] = $request['skills'];
            }//end 

            if($request['view_type'] == "leads"){
                $qrystr .= " ORDER BY t1.name ASC";
            }else{
                if($request['view_type'] == "" || $request['view_type'] == "job_post"){
                    $qrystr .= " ORDER BY t0.date_created DESC";
                }else{
                    $qrystr .= " ORDER BY t8.date_created DESC";
                }//end if
                
            }//end if
           
            
            
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if




            

            $response['qrystr']         = $filter_str1;

            $query      				= $this->db->query($qrystr,$in_cont);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();   
	        }//end if


            //---------------------------------------get notification---------------------------------------
            
            if(isset($response['data']) && $request['view_type'] == "leads"){
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
            //---------------------------------------get notification---------------------------------------

            return $response;
    }//end function

    
    function get_counter($request){
        $response   = [];
        $qrystr     = "";
        $word_skip = array('with');
        $filter1    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['job_title'])));
        $filter2    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['job_description'])));
        $filter3    = explode(' ', $this->db->escapeString(strip_tags($request['filter_data']['qualification'])));
        
        //job title filter for leads
        $filter_str1 = "(";
        foreach ($filter1 as $key => $value) {
            $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
            if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                continue;
            }//end
            $filter_str1 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str1 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str1 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
        }//end foreach
        if (strlen($filter_str1) > 4) {
            $filter_str1 = substr($filter_str1, 0,strlen($filter_str1) - 3);
            $filter_str1 .= ")";
        } else {
            $filter_str1 = "";
        };
        //end job title filter for leads

        //job description filter for leads
        $filter_str2 = "(";
        foreach ($filter2 as $key => $value) {
            //$value = str_replace([',','.','(',')','/'],'',$value);
            $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
            if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                continue;
            }//end
            $filter_str2 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str2 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str2 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
        }//end foreach
        $filter_str2 = substr($filter_str2, 0,strlen($filter_str2) - 3);
        $filter_str2 .= ")";
        //end job description filter for leads


        //qualifications filter for leads
        $filter_str3 = "(";
        foreach ($filter3 as $key => $value) {
            $value =  preg_replace('/[^A-Za-z0-9\-]/', '', $value); //remove special char
            if(strlen($value) < 4 || in_array(strtolower($value),$word_skip)){
                continue;
            }//end
            $filter_str3 .= "t2.highlights regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str3 .= "t8.designation regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
            $filter_str3 .= "t8.short_description regexp '(^|[[:space:]])".$value."([[:space:]]|$)' OR ";
        }//end foreach
        $filter_str3 = substr($filter_str3, 0,strlen($filter_str3) - 3);
        $filter_str3 .= ")";
        //end qualifications filter for leads


        /* TODO NIX
        SELECT t0.user_id,t1.name,t3.designation
                       FROM job_post_applicant t0
                       LEFT JOIN profile_experience t3
                       ON t0.user_id = t3.id
                       INNER JOIN oprofile t5
                       ON t0.user_id = t5.id
                       LEFT JOIN profile_education t4
                       ON t0.user_id = t4.id
                       LEFT JOIN profile_certifications_licenses t6
                       ON t0.user_id = t6.id
                       INNER JOIN oeducation a 
                       ON t4.education = a.id
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t0.id = '26'
                        AND (MATCH(t3.designation) AGAINST('Systems Developer')
                            OR a.name LIKE '%bachelor%'
                            OR 'job post qualification' LIKE '%'+t5.highlights+'%'
                            OR 'job post qualification' LIKE '%'+t6.certification+'%'
                         );
        */

        
        $qrystr     = "SELECT 'applicant' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id) AS 'counter'
                       FROM job_post_applicant t0
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND t0.id = '".$request['job_post']."'
                        AND t0.user_id NOT IN(SELECT DISTINCT user_id FROM job_post_move_to WHERE id='{$request['job_post']}')
                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                       AND t0.status = 'short listed'
                       AND t0.if_current = true
                       AND t0.id = '".$request['job_post']."'
                       UNION ALL
                       SELECT 'for_interview' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                       AND t0.status = 'for interview'
                       AND t0.if_current = true
                       AND t0.id = '".$request['job_post']."'
                       UNION ALL
                       SELECT 'offered' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                       AND t0.status = 'offered'
                       AND t0.if_current = true
                       AND t0.id = '".$request['job_post']."'
                       UNION ALL
                       SELECT 'hired' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id) AS 'counter'
                       FROM job_post_move_to t0
                       INNER JOIN ousr t1
                       ON t0.user_id = t1.id
                       WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '') 
                       AND t0.status = 'hired'
                       AND t0.if_current = true
                       AND t0.id = '".$request['job_post']."'
                       UNION ALL
                        
                       SELECT 'leads' AS 'counter_type',
                        COUNT(DISTINCT t1.id) AS 'counter'
                       FROM ousr t1
                        INNER JOIN oprofile t2
                        ON t1.id = t2.id
                        LEFT JOIN profile_experience t8
                        ON t1.id = t8.id
                        LEFT JOIN profile_skills t7
                        ON t1.id = t7.id
                        LEFT JOIN profile_education t5
                        ON t1.id = t5.id
                        LEFT JOIN profile_language t6
                        ON t1.id = t6.id
                        WHERE t1.inactive = false
                        AND t1.user_type = 'applicant'
                        AND (t1.name IS NOT NULL AND t1.name <> '')
                        AND (
                                ".($filter_str1 != '' ? $filter_str1." OR" : "")."
                                 ".($filter_str2 != '' ? $filter_str2." OR" : "")." ".$filter_str3."
                        )
                       

                       
                       ";


        /*Leads
        
        SELECT 'leads' AS 'counter_type',
                    COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
            FROM job_post_applicant t0
            LEFT JOIN profile_experience t3
            ON t0.user_id = t3.id
            INNER JOIN oprofile t5
            ON t0.user_id = t5.id
            LEFT JOIN profile_education t4
            ON t0.user_id = t4.id
            LEFT JOIN profile_certifications_licenses t6
            ON t0.user_id = t6.id
            INNER JOIN oeducation a 
            ON t4.education = a.id
            INNER JOIN ousr t1
            ON t0.user_id = t1.id
            WHERE t1.inactive = false
            AND t1.user_type = 'applicant'
            AND (t1.name IS NOT NULL AND t1.name <> '')
            AND t0.id = '".$request['job_post']."'
            
            AND (
                    ".$filter_str1."
                OR  ".$filter_str2."
                OR  ".$filter_str3."
                OR  ".$filter_str4."
            )
        */
        
        // echo $qrystr;
        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        $response['qrystr']       = $filter_str2;
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


    function get_master_data2($param){
            $response   = [];
            $qrystr     = "";
            $qrystr     = "SELECT t0.*,t1.name as 'education_text'
                            FROM ojob_post t0
                            LEFT JOIN oeducation t1
                            ON t0.education = t1.id
                            WHERE 1";

            if(isset($param['filter']) && $param['filter'] !== ""){
                $qrystr .= " AND ".$param['filter']."";
            }//end if

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
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