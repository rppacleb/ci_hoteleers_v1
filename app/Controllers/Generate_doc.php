<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
//use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

use App\Models\Generate_doc_model;
use App\Models\Audit_trail_model;
use App\Libraries\Pcl_lib;

//EXCEL/CSV
//prerequisite :
// * https://getcomposer.org/doc/00-intro.md#installation-windows

//installation :
// * https://www.youtube.com/watch?v=d8H7RDN9bEM
// * https://laratutorials.com/codeigniter-4-export-data-to-excel-example/

//documentation : https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/
class Generate_doc extends BaseController
{
  protected $model;
  protected $session;
  protected $audit_trail;
  protected $record_type;
  protected $lib;
  protected $permission;

  public function __construct(){
    $this->lib        = new Pcl_lib();
    $this->model      = new Generate_doc_model();
    $this->audit_trail    = new Audit_trail_model();
    $this->record_type    = 'applicant_search';
    $this->session      = session();
    $this->permission     = array();
  }
  public function generate_csv() {
      define('DS', DIRECTORY_SEPARATOR);
      $dir = FCPATH . DS . "upload" . DS;
      $fileName = 'users.csv';  
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Id');
      $sheet->setCellValue('B1', 'Name');
      $sheet->setCellValue('C1', 'Skills');
      $sheet->setCellValue('D1', 'Address');
      $sheet->setCellValue('E1', 'Age');
      $sheet->setCellValue('F1', 'Designation');       
      /*
      $rows = 2;
      foreach ($users as $val){
          $sheet->setCellValue('A' . $rows, $val['id']);
          $sheet->setCellValue('B' . $rows, $val['name']);
          $sheet->setCellValue('C' . $rows, $val['skills']);
          $sheet->setCellValue('D' . $rows, $val['address']);
          $sheet->setCellValue('E' . $rows, $val['age']);
          $sheet->setCellValue('F' . $rows, $val['designation']);
          $rows++;
      } */

      $writer = new Csv($spreadsheet);
      $writer->setDelimiter(',');
      $writer->setEnclosure('"');
      $writer->setLineEnding("\r\n");
      $writer->setSheetIndex(0);
      $writer->save($fileName);
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Type: application/csv");
      header("Content-Disposition: attachment; filename=".basename($fileName)."");
      header("Expires: 0");
      header("Cache-Control: must-revalidate");
      header("Pragma: public");
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Length:". filesize($fileName));
      flush();
      readfile($fileName);
      exit;
      //redirect(base_url()."/upload/".$fileName); 
  }//end function

  public function index2() {
      //$db      = \Config\Database::connect();
      //$builder = $db->table('users');   
      //$query = $builder->query("SELECT * FROM users");
      //$users = $query->getResult();
      define('DS', DIRECTORY_SEPARATOR);
      $dir = FCPATH . DS . "upload" . DS;
      $fileName = 'users.xlsx';  
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Id');
      $sheet->setCellValue('B1', 'Name');
      $sheet->setCellValue('C1', 'Skills');
      $sheet->setCellValue('D1', 'Address');
      $sheet->setCellValue('E1', 'Age');
      $sheet->setCellValue('F1', 'Designation');       
      /*
      $rows = 2;
      foreach ($users as $val){
          $sheet->setCellValue('A' . $rows, $val['id']);
          $sheet->setCellValue('B' . $rows, $val['name']);
          $sheet->setCellValue('C' . $rows, $val['skills']);
          $sheet->setCellValue('D' . $rows, $val['address']);
          $sheet->setCellValue('E' . $rows, $val['age']);
          $sheet->setCellValue('F' . $rows, $val['designation']);
          $rows++;
      } */
      $writer = new Xlsx($spreadsheet);
      $writer->save($fileName);
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=".basename($fileName)."");
      header("Expires: 0");
      header("Cache-Control: must-revalidate");
      header("Pragma: public");
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Length:". filesize($fileName));
      flush();
      readfile($fileName);
      exit;
      //redirect(base_url()."/upload/".$fileName); 
  }//end function

//PDF
//prerequisite :
// * https://getcomposer.org/doc/00-intro.md#installation-windows

//installation :
// * https://www.positronx.io/codeigniter-pdf-tutorial-generate-pdf-in-codeigniter/

//documentation : https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/
  public function generate_pdf($type,$id){
    $param      = array();
    $request    = $this->request->getVar();
    $res        = $this->model->load_data($id,$request);

    if($res['num_rows'] > 0){
        $param = $res;
    }//end if
    
    //echo json_encode($param);

    
    $dompdf = new \Dompdf\Dompdf(); 
    $dompdf->loadHtml(view('Pdf_vw/resume',$param));
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    //$dompdf->stream(); download pdf
    $dompdf->stream("dompdf_out.pdf", array("Attachment" => false)); //preview pdf
    exit(0);//preview pdf
    
  }//end function
}