<?php
namespace App\Models;

use CodeIgniter\Model;

class Backup_vw_model extends Model {
	
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

	

    function get_record($table,$id,$categ,$perPage,$offset){

 
   
            $qrystr     = "SELECT t0.*,t1.name,t1.description,t2.name AS 'item_category_text',TO_BASE64(doc_image) AS 'doc_image'
                            FROM ".$table." t0
                            INNER JOIN omenu t3
                            ON t0.id = t3.id
                            LEFT JOIN oitm t1
                            ON t0.item = t1.id
                            AND t1.inactive = false
                            INNER JOIN ocateg t2
                            ON t1.item_category = t2.id
                            WHERE t3.default_menu = true
                            AND t3.inactive = false
                            
                            ";
            if($categ !== null && $categ != 0){
                $qrystr .= " AND t1.item_category = '$categ'";
            }

            $qrystr .= " ORDER BY t0.item_category,t0.line";
            if($perPage !== null && $offset !== null){
                $qrystr .= " LIMIT ".$perPage." OFFSET ".$offset."";
            }//end if
           
            
            $query      = $this->db->query($qrystr);
            return $query->getResultArray();
        
    
        //return $query->getResult();
    }//end function


    function get_category($table){
            $qrystr     = "SELECT * FROM ".$table."
                            WHERE inactive = false";
            $query      = $this->db->query($qrystr);
            return $query->getResultArray();
        //return $query->getResult();
    }//end function
  

   

    public function check_duplicate($table,$data){
        $response = [];
        $qrystr = "SELECT t0.*
                    FROM ".$table." t0
                    WHERE email_add = '".$data['header']['email_add']."'
                    ";
        $query  = $this->db->query($qrystr);
        $data   = $query->getResultArray();

        $response['num_rows']   = $query->getNumRows();

        if($query->getNumRows() > 0){
            $response['data']       = $data[0]['id'];   
        }

        return $response;
    }//End function

    //Add
    public function add($table,$data){
        $this->db->transBegin();
        $this->db->table($table)->insert($data['header']);
        $id = $this->db->insertID();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return 0;
        } else {
            $this->db->transCommit();
            return $id;
        }//End if
    }//End function

    //Update
    public function update_rec($table,$data){
        $this->db->transBegin();
        $builder = $this->db->table($table);
        $builder->set($data['header']);
        $builder->where('id', $data['header']['id']);
        $builder->update();
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return 0;
        } else {
            $this->db->transCommit();
            return $data['header']['id'];
        }//End if
    }//End function

    public function add_lines($data){
        $param              = [];
        $param['success']   = true;
        $param['message']   = '';
        $param['data']      = [];

        $this->db->transBegin();

        
        
        if($data['header']['id'] <> '' && $data['header']['id'] <> 0){

            //update header
            $builder = $this->db->table($this->table);
            $builder->set($data['header']);
            $builder->where('id', $data['header']['id']);
            $builder->update();
            //end update header

            $param['data']['id']            = $data['header']['id'];
            $param['data']['order_number']  = $data['header']['order_number'];

            //remove lines
            $this->db->table($this->table_lines)->delete(array('id' => $data['header']['id']));
            $this->db->table('oinv')->delete(array('id' => $data['header']['id'], "trantype" => 'sales'));
        }else{
            //add header
            $this->db->table($this->table)->insert($data['header']);
            $id = $this->db->insertID();
            $param['data']['id'] = $id;
            $param['data']['order_number'] = str_pad($id, 10, '0', STR_PAD_LEFT);
            //end add header

            //update
            $builder = $this->db->table($this->table);
            $builder->set($param['data']);
            $builder->where('id', $param['data']['id']);
            $builder->update();
            //end update

            for ($x=0; $x <= count($data['lines']) - 1; $x++) {
                $data['lines'][$x]['id'] = $id;
            }//end for
        }//end if

        

       
        //insert lines
        $this->db->table($this->table_lines)->insertBatch($data['lines']);


        

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();

            $param['success'] = false;
            $param['message'] = 'Error inserting to database';
           
        } else {
            $data['inventory'] = [];
            //check lines after delete
            for ($x=0; $x <= count($data['lines']) - 1; $x++) {
                $totalqty           = 0;
                 
                $data_row           = $data['lines'][$x];

                for ($z=0; $z <= count($data['lines']) - 1; $z++) {
                    $row            = $data['lines'][$z];
                    $item2          = $row['item'];
                    $quantity2      = $row['qty'];
                    if($data_row['item'] == $item2){
                        $totalqty       += $quantity2;  
                    }//End if
                }//End for

                //stock checking
                //=============================================
                $validate = $this->stock_checking($data_row['item'],$totalqty);


                if($validate['success'] == false){
                    $param['success'] = false;
                    $param['message'] = $validate['message'];
                    break;
                }//end if
                //=============================================
                //end stock checking

                $data['inventory'][] = array(
                    'id'            => $param['data']['id'],
                    'trantype'      => $this->record_type,
                    'line'          => $data_row['line'],
                    'item'          => $data_row['item'],
                    'qty'           => ($data_row['qty'] * -1)
                );


            }//end for
            //end check lines after delete



            //Add to Inventory
            $this->db->table('oinv')->insertBatch($data['inventory']);
            //end insert inventory

            if ($this->db->transStatus() === FALSE) {
                $this->db->transRollback();

                $param['success'] = false;
                $param['message'] = 'Error inserting to database';
               
            }//end if

            if($param['success']){
                $this->db->transCommit();
                $param['success'] = true;
                $param['message'] = '';
            }//end if
        }//End if

      
        

        return $param;
    }//End function

    //get item details
    function get_item_details($id){
        $qrystr = "SELECT t0.*
                    FROM oitm t0";
        if($id <> ''){
            $qrystr .= " WHERE t0.id = '$id'";
        }//end if
        $query = $this->db->query($qrystr);

        if($query->getNumRows() > 0){
            $query      = $this->db->query($qrystr);
            return $query->getResultArray();
        }else{
            return false;
        }//end if
        
    }//end function
    //end get item details

    //stock checking
    function check_stock($id){
        $qrystr = "SELECT t0.item,t1.name,t1.description,
                            SUM(t0.qty) AS 'quantity' 
                    FROM oinv t0
                    LEFT JOIN oitm t1
                    ON t0.item = t1.id";
        if($id <> ''){
            $qrystr .= " WHERE t0.item = '$id' 
                        GROUP BY t0.item,t1.name,t1.description";
        }else{
            $qrystr .= " GROUP BY t0.item,t1.name,t1.description";
        }//end if
        $query = $this->db->query($qrystr);

        if($query->getNumRows() > 0){
            return $query->getResultArray();  
        }else{
            return false;
        }//end if
        
    }//end function
    //end stock checking

    //Check Stock
    public function stock_checking($item,$quantity){

        $param = [];
        $param['success'] = true;
        $param['message'] = '';
        $res    = $this->check_stock($item);
        

        if($res){
            
            $itemname   = '';
            $itemstock  = 0;
            foreach ($res as $r) {
                $itemname   = $r['name'] .' - '. $r['description'];
                $itemstock  = $r['quantity'];
            }//End foreach

            if($itemstock < $quantity){
                $param['message'] = 'Insufficient Stock for '. $itemname;
                $param['success'] = false;
            }//end if
            
        }else{

            $data       = $this->get_item_details($item);

            $itemname   = '';
            $itemtype   = '';
            foreach ($data as $r) {
                $itemname   = $r['name'] .' - '. $r['description'];
                $itemtype   = $r['item_type'];
                
            }//End foreach
            
            if($itemtype == 'inventoryitem'){
                $param['message'] = 'Insufficient Stock for '. $itemname;
                $param['success'] = false;
            }//end if
            
        }//end if
        return $param;
    }//end function
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */