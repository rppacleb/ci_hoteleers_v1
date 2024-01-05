<?php
namespace App\Models;

use CodeIgniter\Model;

class Contact_us_model extends Model {
	
    protected $table           = 'ordr';
    protected $table_lines     = 'rdr1';
    protected $primaryKey       = 'id';
    protected $record_type      = 'sales';

    //protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'name'];

    //protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;

	

    function get_record($type,$request,$perPage,$offset){
            $response   = [];
            $qrystr     = "";

            

            $qrystr     = "SELECT   t0.id,
                                    t1.company_name,
                                    t1.doc_image,
                                    t0.job_title,
                                    t0.location,
                                    CONCAT(t0.locality, ' ',t0.country) AS 'location_placeholder',
                                    DATE_FORMAT(STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y'), '%b %d, %Y') AS 'job_expiration_date',
                                    t2.name AS 'job_type_text',
                                    (SELECT COUNT(job_post) FROM usr_job_post_fav WHERE job_post = t0.id
                                    AND id = '".$request['user_id']."') AS 'saved'
                            FROM ojob_post t0
                            LEFT JOIN oemployer t1 
                            ON t0.employer = t1.id
                            LEFT JOIN ojob_type t2
                            ON t0.job_type = t2.id
                            WHERE t0.inactive = false
                            AND STR_TO_DATE(t0.job_expiration_date,'%m/%d/%Y') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y'),'%m/%d/%Y')
                            AND t0.vacancies > 0
                            AND t0.status = 'active'
                            AND (STR_TO_DATE(remove_on,'%m/%d/%Y %h:%i %p') >= STR_TO_DATE(DATE_FORMAT(NOW(),'%m/%d/%Y %h:%i %p'),'%m/%d/%Y %h:%i %p') OR remove_on IS NULL OR remove_on = '')
                            ";
            $qrystr .= " ORDER BY (SELECT COUNT(DISTINCT user_id) FROM job_post_views WHERE id=t0.id) DESC";
            
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT 9";
            }//end if

            $query                      = $this->db->query($qrystr);
            $response['num_rows']       = $query->getNumRows();
            if($query->getNumRows() > 0){
                $response['data']       = $query->getResultArray();   
            }//end if

            return $response;
    }//end function


    function get_category($table){
            $qrystr     = "SELECT * FROM ".$table."
                            WHERE inactive = false";
            $query      = $this->db->query($qrystr);
            return $query->getResultArray();
        //return $query->getResult();
    }//end function
  

   

    public function get_banner($param){
        $response = [];
        $qrystr = "SELECT t0.*
                    FROM ".$param["table_name"]." t0
                    WHERE ".$param["filter"]."";
        $query  = $this->db->query($qrystr);
        $data   = $query->getResultArray();
        $response['num_rows']   = $query->getNumRows();
        if($query->getNumRows() > 0){
            $response['data']       = $query->getResultArray();  
        }//end if
        return $response;
    }//End function

    

  
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */