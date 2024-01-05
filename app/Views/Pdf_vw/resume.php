<?php
$upload_path = base_url('files/uploads');

//logo
$context = stream_context_create([ 
    'ssl' => [ 
        'verify_peer' => FALSE, 
        'verify_peer_name' => FALSE,
        'allow_self_signed'=> TRUE 
    ] 
]);
$path           = "";
if($data[0]['doc_image'] == "" || $data[0]['doc_image'] == null){
  $path           = 'https://dummyimage.com/76x76/dee2e6/6c757d.jpg';
}else{
  $path           = $upload_path.'/'.rawurlencode($data[0]['doc_image']);  
}

$type           = pathinfo($path, PATHINFO_EXTENSION);
$path = str_replace('https://', 'https://hoteleers:h0teleers@dmin2023@', $path); //for hoteleers
try {
    $data_file      = file_get_contents($path,false,$context);
}catch (Exception $e) {
    $path           = 'https://dummyimage.com/76x76/dee2e6/6c757d.jpg';
    $data_file      = file_get_contents($path,false,$context);
}//end try

$base64_logo    = 'data:image/' . $type . ';base64,' . base64_encode($data_file);
//end logo
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hoteleers</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <style>
 

      .txt-justify{
        text-align:justify;
        text-justify: inter-word;
        word-break: break-all;
      }
    
      .brdr-top{
        border-top:1px solid #000;
      }
      .brdr-left{
        border-left:1px solid #000;
      }
      .brdr-right{
        border-right:1px solid #000;
      }
      .brdr-bottom{
        border-bottom:1px solid #000;
      }
      .brdr-top-tr{
        border-top:1;
      }
      .brdr-bottom-tr{
        border-bottom:1;
      }
      .brdr-left-tr{
        border-left:1;
      }
      .brdr-right-tr{
        border-right:1;
      }
      .valign-b{
        vertical-align:bottom;
      }
      .valign-t{
        vertical-align:top;
      }
      .valign-m{
        vertical-align:middle;
      }
      table{
          font-family: tahoma,geneva,NoToSans,sans-serif;
          font-size: 10pt;
      }
  </style>
</head>
<body>
  <div class="container mt-5">
    <table class="table table-striped table-hover mt-5" style="width:100%;">
        <tr>
            
            <td valign="top">
                <h1><?php echo $data[0]['full_name']?></h1>
                <p> <b>Email :</b> <?php echo $data[0]['email_add']?><br/>
                    <b>Contact Number :</b> <?php echo $data[0]['dial_code'].$data[0]['contact_number']?><br/>
                    <b>Address :</b> <?php echo $data[0]['location']?>
                </p>
            </td>

            <td style="width:1.8in;" valign="top" class="text-right">
            
                <img class="img-thumbnail" src="<?php echo $base64_logo ?>" style="width: 1.5in;height: 1.5in;">
            </td>
        </tr>
        
    </table>

    <table class="table table-striped table-hover mt-5" style="width:100%;">
            <tr>
                
                <td><b>HIGHLIGHTS</b></td>
            </tr>
            <tr>
                <td><?php echo $data[0]['highlights']?></td>
            </tr>
    </table>

    <br/>
    <br/>
    <table class="table table-striped table-hover mt-5" style="width:100%;">
        
        <tr>
            <td colspan="3"><b>EXPERIENCE</b></td>
        </tr>
    
        <?php
            $html = '';
            foreach ($line_experience as $key => $value) {
                $html .= '<tr>';
                    $html .= '<td style="width:1.5in;"></td>';
                    $html .= '<td style="width:0.2in;"></td>';
                    $html .= '<td></td>';
                $html .= '</tr>';

                $html .= '<tr>';
                   
                    $html .= '<td colspan="3" class="brdr-bottom"><b>'.$value['start_date'].' - '.$value['end_date'].'</b></td>';
                $html .= '</tr>';

                $html .= '<tr>';
                    $html .= '<td style="width:1.5in;"><b>Company Name</b></td>';
                    $html .= '<td style="width:0.2in;"><b>:</b></td>';
                    $html .= '<td>'.$value['company_name'].'</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<td style="width:1.5in;"><b>Position</b></td>';
                    $html .= '<td style="width:0.2in;"><b>:</b></td>';
                    $html .= '<td>'.$value['designation'].'</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<td style="width:1.5in;"><b>Short Description</b></td>';
                    $html .= '<td style="width:0.2in;"><b>:</b></td>';
                    $html .= '<td>'.$value['short_description'].'</td>';
                $html .= '</tr>';

                

                $html .= '<tr>';
                    $html .= '<td style="width:1.5in;"><b>Current</b></td>';
                    $html .= '<td style="width:0.2in;"><b>:</b></td>';
                    $html .= '<td>'.((int)$value['if_current']? 'Yes' : 'No').'</td>';
                $html .= '</tr>';

                $html .= '<tr style="height:0.5in;">';
                    $html .= '<td colspan="3">&nbsp;</td>';
                $html .= '</tr>';
                
            }//end if
            echo $html;
        ?>
    </table>

    <br/>
    <br/>
    <table class="table table-striped table-hover mt-5" style="width:100%;">
        
        <tr>
            
            <td><b>SKILLS</b></td>
        </tr>
    
        <?php
            $html = '';
            foreach ($line_skills as $key => $value) {
                $html .= '<tr>';
                    $html .= '<td>'.$value['skills'].'</td>';
                $html .= '</tr>';
                
            }//end if
            echo $html;
        ?>
    </table>
  </div>
</body>
</html>