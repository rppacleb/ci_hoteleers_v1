<?php
namespace App\Models;

use CodeIgniter\Model;

class Insight_model extends Model {
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
    /*

    compute hiring speed
    SELECT b.job_title,ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y')))),COUNT(DISTINCT a.user_id) AS 'applicant_count',
    ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y'))) / COUNT(DISTINCT a.user_id))
                                    FROM job_post_move_to a
                                    INNER JOIN ojob_post b
                                    ON a.id = b.id
                                    WHERE  a.status = 'hired'
                                    AND a.if_current = 1
                                    GROUP BY b.job_title;

  old

  SELECT 
  ROUND(SUM(DATEDIFF(STR_TO_DATE(a.date_created,'%Y-%m-%d'),STR_TO_DATE(b.date_posted,'%m/%d/%Y')))/COUNT(a.user_id),0)
  FROM `job_post_applicant` a
  INNER JOIN ojob_post b
  ON a.id = b.id
  WHERE a.id = t0.id
    */
//TODO
    function get_hiring_speed($request){
        $response   = [];
        $qrystr   = "";
        $qrystr     = "SELECT 'active' AS 'counter_type',
                                        SUM(x.hiring_speed) AS 'total_hiring_speed',
                                        SUM(x.applicant_count) AS 'total_applicant_count',
                                        (SELECT SUM(vacancies_placeholder) 
                                            FROM ojob_post b
                                            WHERE b.employer = '".$request['employer_id']."'
                                             AND b.inactive = false
                                                AND b.status = 'active'
                                                AND b.vacancies > 0
                                                AND DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                AND (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR b.remove_on IS NULL OR b.remove_on = '')
                                            ) AS 'total_vacancies',

                                        (SELECT SUM(1) FROM (SELECT DISTINCT b.id,a.user_id 
                                                FROM job_post_views a
                                                INNER JOIN ojob_post b 
                                                ON a.id = b.id
                                                WHERE b.employer = '".$request['employer_id']."'
                                             AND b.inactive = false
                                                AND b.status = 'active'
                                                AND b.vacancies > 0
                                                AND DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                AND (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR b.remove_on IS NULL OR b.remove_on = '')) y
                                            ) AS 'total_job_post_views'

                        FROM (
                            SELECT b.id,
                                    b.job_title,
                                    ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y')))) AS 'hiring_speed',
                                    COUNT(DISTINCT a.user_id) AS 'applicant_count',
                                    (SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = a.id) AS 'job_post_views'
                            FROM job_post_move_to a
                            INNER JOIN ojob_post b
                            ON a.id = b.id
                            WHERE  a.status = 'hired'
                            AND a.if_current = 1
                            AND b.employer = '".$request['employer_id']."'
                            AND b.inactive = false
                            AND b.status = 'active'
                            AND b.vacancies > 0
                            AND DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR b.remove_on IS NULL OR b.remove_on = '')
                            GROUP BY b.id,b.job_title
                        ) x
                        UNION ALL
                        SELECT 'hired' AS 'counter_type',
                                SUM(x.hiring_speed) AS 'total_hiring_speed',
                                SUM(x.applicant_count) AS 'total_applicant_count',
                                (SELECT SUM(vacancies_placeholder) 
                                            FROM ojob_post b
                                            WHERE b.employer = '".$request['employer_id']."'
                                                AND (b.inactive = true
                                                OR b.status = 'closed'
                                                OR b.vacancies <= 0
                                                OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                                                ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) > 0
                                            ) AS 'total_vacancies',

                                (SELECT SUM(1) FROM (SELECT DISTINCT b.id,a.user_id FROM job_post_views a
                                                INNER JOIN ojob_post b 
                                                ON a.id = b.id
                                                WHERE b.employer = '".$request['employer_id']."'
                                                AND (b.inactive = true
                                                OR b.status = 'closed'
                                                OR b.vacancies <= 0
                                                OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                                                ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) > 0) y
                                            ) AS 'total_job_post_views'
                        FROM (
                            SELECT b.id,
                                    b.job_title,
                                    ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y')))) AS 'hiring_speed',
                                    (COUNT(DISTINCT a.user_id)) AS 'applicant_count'
                            FROM job_post_move_to a
                            INNER JOIN ojob_post b
                            ON a.id = b.id
                            WHERE  a.status = 'hired'
                            AND a.if_current = 1
                            AND b.employer = '".$request['employer_id']."'
                            AND (b.inactive = true
                            OR b.status = 'closed'
                            OR b.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) > 0
                            GROUP BY b.id,b.job_title
                        ) x
                        UNION ALL
                        SELECT 'deactivated' AS 'counter_type',
                                SUM(x.hiring_speed) AS 'total_hiring_speed',
                                SUM(x.applicant_count) AS 'total_applicant_count',
                                
                                (SELECT SUM(vacancies_placeholder) 
                                            FROM ojob_post b
                                            WHERE b.employer = '".$request['employer_id']."'
                                                AND (b.inactive = true
                                                OR b.status = 'closed'
                                                OR b.vacancies <= 0
                                                OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                                                ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) <= 0
                                            ) AS 'total_vacancies',
                                (SELECT SUM(1) FROM (SELECT DISTINCT b.id,a.user_id FROM job_post_views a
                                                INNER JOIN ojob_post b 
                                                ON a.id = b.id
                                                WHERE b.employer = '".$request['employer_id']."'
                                                AND (b.inactive = true
                                                OR b.status = 'closed'
                                                OR b.vacancies <= 0
                                                OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                                OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                                                ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) <= 0


                                                ) y
                                            ) AS 'total_job_post_views'
                        FROM (

                            SELECT b.id,
                                b.job_title,
                                ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y')))) AS 'hiring_speed',
                                COUNT(DISTINCT a.user_id) AS 'applicant_count',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = a.id) AS 'job_post_views'
                            FROM job_post_move_to a
                            INNER JOIN ojob_post b
                            ON a.id = b.id
                            WHERE  a.status = 'hired'
                            AND a.if_current = 1
                            AND b.employer = '".$request['employer_id']."'
                            AND (b.inactive = true
                            OR b.status = 'closed'
                            OR b.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(b.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(b.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = b.id) <= 0
                            GROUP BY b.id,b.job_title
                        ) x
                    ";
        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();   
        }//end if
        return $response;
    }//end function
		

	function get_record($type,$request,$perPage,$offset){
    		$response 	= [];
    		$qrystr 	= "";

            if($type == 'active'){

                $qrystr     = "SELECT t1.doc_image,
                                t0.id,
                                t0.job_title,
                                DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'),'%b %d, %Y') AS 'job_expiration_date',
                                t0.vacancies,

                                t0.vacancies_placeholder,
                                (SELECT COUNT(DISTINCT user_id) 
                                    FROM job_post_move_to 
                                    WHERE id = t0.id
                                    AND status = 'hired'
                                    AND if_current = true) AS 'hired_applicant',


                                IFNULL((SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = t0.id),0) AS 'job_post_views',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_move_to WHERE id = t0.id AND (status = 'for interview')) AS 'job_post_interviews',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count',
                                (SELECT ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y'))) / COUNT(DISTINCT a.user_id))
                                    FROM job_post_move_to a
                                    INNER JOIN ojob_post b
                                    ON a.id = b.id
                                    WHERE a.id = t0.id
                                    AND a.status = 'hired'
                                    AND a.if_current = 1
                                    AND b.employer = t1.id
                                    GROUP BY b.job_title) AS 'hiring_speed'
                            FROM ojob_post t0
                            INNER JOIN oemployer t1
                            ON t0.employer = t1.id
                            WHERE t0.inactive = false
                            AND t0.status = 'active'
                            AND t0.vacancies > 0
                            AND DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                            ";
            }else if($type == 'hired'){
                $qrystr     = "SELECT t1.doc_image,
                                t0.id,
                                t0.job_title,
                                DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'),'%b %d, %Y') AS 'job_expiration_date',
                                t0.vacancies,
                                t0.vacancies_placeholder,
                                (SELECT COUNT(DISTINCT user_id) 
                                    FROM job_post_move_to 
                                    WHERE id = t0.id
                                    AND status = 'hired'
                                    AND if_current = true) AS 'hired_applicant',
                                
                                IFNULL((SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = t0.id),0) AS 'job_post_views',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_move_to WHERE id = t0.id AND (status = 'for interview')) AS 'job_post_interviews',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count',
                                (SELECT ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y'))) / COUNT(DISTINCT a.user_id))
                                    FROM job_post_move_to a
                                    INNER JOIN ojob_post b
                                    ON a.id = b.id
                                    WHERE a.id = t0.id
                                    AND a.status = 'hired'
                                    AND a.if_current = 1
                                    AND b.employer = t1.id
                                    GROUP BY b.job_title) AS 'hiring_speed'
                            FROM ojob_post t0
                            INNER JOIN oemployer t1
                            ON t0.employer = t1.id
                            WHERE (t0.inactive = true
                            OR t0.status = 'closed'
                            OR t0.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) > 0
                            ";
            }else if($type == 'deactivated'){
                $qrystr     = "SELECT t1.doc_image,
                                t0.id,
                                t0.job_title,
                                DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'),'%b %d, %Y') AS 'job_expiration_date',
                                t0.vacancies,
                                t0.vacancies_placeholder,
                                (SELECT COUNT(DISTINCT user_id) 
                                    FROM job_post_move_to 
                                    WHERE id = t0.id
                                    AND status = 'hired'
                                    AND if_current = true) AS 'hired_applicant',
                                IFNULL((SELECT COUNT(DISTINCT(user_id)) FROM job_post_views WHERE id = t0.id),0) AS 'job_post_views',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_move_to WHERE id = t0.id AND (status = 'for interview')) AS 'job_post_interviews',
                                (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) AS 'applicant_count',
                                (SELECT ROUND(SUM(DATEDIFF(a.date_created,STR_TO_DATE(b.date_posted,'%m/%d/%Y'))) / COUNT(DISTINCT a.user_id))
                                    FROM job_post_move_to a
                                    INNER JOIN ojob_post b
                                    ON a.id = b.id
                                    WHERE a.id = t0.id
                                    AND a.status = 'hired'
                                    AND a.if_current = 1
                                    AND b.employer = t1.id
                                    GROUP BY b.job_title) AS 'hiring_speed'
                            FROM ojob_post t0
                            INNER JOIN oemployer t1
                            ON t0.employer = t1.id
                            WHERE (t0.inactive = true
                            OR t0.status = 'closed'
                            OR t0.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) <= 0
                            ";
            }//end if
            

	

            if(isset($request['employer_id']) && $request['employer_id'] !== ""){
                $qrystr .= " AND t0.employer = ".$request['employer_id']."";
            }//end if

			if(isset($request['keyword']) && $request['keyword'] !== ""){
				$qrystr .= " AND (t0.job_title LIKE '%".$request['keyword']."%')";
			}//end if

         


           
            $qrystr .= " ORDER BY t0.date_created ASC";
            
            if($perPage !== null && $offset !== null){
                //$qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if

            $qrystr .= " LIMIT 3";

            $query      				= $this->db->query($qrystr);
            $response['num_rows']   	= $query->getNumRows();
	        if($query->getNumRows() > 0){
	            $response['data']       = $query->getResultArray();   
	        }//end if

            return $response;
    }//end function


    function get_counter($request){
        $response   = [];
        $qrystr     = "";


        if($request['type'] == 'active'){
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
                       GROUP BY 'applicant'
                       UNION ALL
                       SELECT 'job_post' AS 'counter_type',
                                COUNT(DISTINCT t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."'
                       AND t0.inactive = false
                        AND t0.status = 'active'
                        AND t0.vacancies > 0
                        AND DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                        AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')

                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
        }else if($request['type'] == 'closed'){
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
                                COUNT(DISTINCT t0.id) AS 'counter'
                       FROM ojob_post t0
                       WHERE t0.employer = '".$request['employer_id']."' 
                       AND (t0.inactive = true
                            OR t0.status = 'closed'
                            OR t0.vacancies <= 0
                            OR DATE_ADD((STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y')), INTERVAL 30 DAY) <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            OR (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))
                            ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t0.id) > 0

                       UNION ALL
                       SELECT 'short_listed' AS 'counter_type',
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
        }else if($request['type'] == 'deactivated'){
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
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
                                COUNT(DISTINCT t0.user_id,t0.id) AS 'counter'
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
        }//end if
        
        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();   
        }//end if

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


    function get_pie_chart_data($request){
        $response       = [];
        $qrystr         = "";
        $qrystr         = "SELECT t0.id,t2.location AS 'country',COUNT(DISTINCT t0.user_id) AS 'count'
                          FROM job_post_applicant t0
                          INNER JOIN ojob_post t1
                          ON t0.id = t1.id
                          INNER JOIN oprofile t2
                          ON t0.user_id = t2.id
                          WHERE t0.id = '".$request['id']."'
                          GROUP BY t0.id,t2.location
                          ORDER BY COUNT(DISTINCT t0.user_id) DESC";

        $query                      = $this->db->query($qrystr);
        $response['num_rows']       = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();
        }else{
            $response['data']       = null;
        }//end if

        return $response;
    }//end function


    function get_origin_counter($request){
        $response       = [];
        $qrystr         = "";

        if($request["type"] == 'active'){



            $qrystr         = "

                        SELECT SUM(x.count) AS 'count'
                        FROM
                        (

                            SELECT t0.id,t2.location AS 'country',COUNT(DISTINCT t0.user_id) AS 'count'
                              FROM job_post_applicant t0
                              INNER JOIN ojob_post t1
                              ON t0.id = t1.id
                              INNER JOIN oprofile t2
                              ON t0.user_id = t2.id
                              INNER JOIN ousr t3
                              ON t0.user_id = t3.id
                              WHERE t1.inactive = false
                                AND t1.status = 'active'
                                AND t1.vacancies > 0
                                AND STR_TO_DATE(t1.job_expiration_date,'%m/%d/%Y') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                AND (STR_TO_DATE(t1.remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR t1.remove_on IS NULL OR t1.remove_on = '')
                                AND t1.employer = '".$request['employer_id']."'

                              GROUP BY t0.id,t2.location
                              ORDER BY COUNT(DISTINCT t0.user_id) DESC
                        ) x";


        }else if($request["type"] == 'hired'){

            
          

            $qrystr         = "SELECT SUM(x.count) AS 'count'
                            FROM
                            (

                                SELECT t0.id,t2.location AS 'country',COUNT(DISTINCT t0.user_id) AS 'count'
                                  FROM job_post_applicant t0
                                  INNER JOIN ojob_post t1
                                  ON t0.id = t1.id
                                  INNER JOIN oprofile t2
                                  ON t0.user_id = t2.id
                                  INNER JOIN ousr t3
                                  ON t0.user_id = t3.id
                                  WHERE (t1.inactive = true
                                    OR t1.status = 'closed'
                                    OR t1.vacancies <= 0
                                    OR STR_TO_DATE(t1.job_expiration_date,'%m/%d/%Y') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                                    OR (STR_TO_DATE(t1.remove_on,'%m/%d/%Y %h:%i %p') <= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p'))

                                    ) AND (SELECT COUNT(DISTINCT(user_id)) FROM job_post_applicant WHERE id = t1.id) > 0
                                    AND t1.employer = '".$request['employer_id']."'

                                  GROUP BY t0.id,t2.location
                                  ORDER BY COUNT(DISTINCT t0.user_id) DESC
                                ) x";




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
        //$builder = $this->db->table($data['table_name']);
        //$builder->set($data['record_header']);
        //$builder->where('id', $data['record_header']['id']);
        //$builder->update();

        //create employer
        $id = 0;
        if(isset($data['for_update'])){
        	for ($i=0; $i < count($data['for_update']); $i++) { 
	        	//$this->db->query(implode(";",$data['user']));
	        	$this->db->query($data['for_update'][$i]);
	        	$id = $this->db->insertID();
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