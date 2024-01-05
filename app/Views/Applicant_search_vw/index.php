<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;
var job_post_id                 = <?php echo !isset($_GET['job_post'])? "" : $_GET['job_post']; ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? "" : $_SESSION['userid']; ?>;
var user                     = <?php echo !isset($id)? "" : $id; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;

var mod_type                    = <?php echo !isset($_GET['mod_type'])? '""' : '"'.$_GET['mod_type'].'"'; ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<?php
$job_post_id = !isset($_GET['job_post'])? "" : $_GET['job_post'];
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<!-- stepper css -->
<style>
    .circle{
      display: hidden;
    }

    .check {
        position: absolute;
        /* transform: translate(0px, -15px) */
      visibility: hidden;
    }

    .stepper {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      min-width: 700px;
      max-width: 700px;
      margin: 0 auto;
    }

    .step {
      text-align: center;
      cursor: pointer;
      padding: 20px 0;
      flex-basis: 20%;
      position: relative;
    }

    .step-line {
      width: calc(100% - 35px);
      border: 2px dashed #ccc;
      position: absolute;
      top: 50%;
      left: 45%;
      transform: translate(25%, -16px);
      z-index: -1;
    }

    .step.complete .step-number {
      display: none;
    }

    .step.complete .circle {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: #ccc;
      font-size: 16px;
      margin-left: 54px;
    }

    .step.complete .check {
        visibility: visible;
        /* filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(119%); */
        margin-left: -16px;
    }

    .step.active .step-number {
      background: rgb(0, 41, 170);
      opacity: 0.8;
      font-size: 16px;
      color: #fff;
      font-weight: bold;
      border: none;
    }

    .step.complete .step-number {
      font-size: 16px;
      font-weight: bold;
      border: none;
    }

    .step.active .step-title {
      font-weight: bold;
    }

    .step-number {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 30px;
      height: 30px;
      background-color: #ccc;
      border-radius: 50%;
      color: #555;
      font-size: 16px;
      margin: 0 auto;
    }

    .step-number:hover {
      background: #f4623a;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      border: none;
    }

    .step-title {
      margin-top: 5px;
    }
  </style>

<!-- stepper css end -->

<div class="row">
    <p class="text-muted mb-4" style="font-size: 15px !important"><a class="text-link" href="#" onClick="history.back()">Back</a> / <span id="job_title"></span> / Applicant</p>
	<div class="col-xl-3 col-lg-3">
		<h4>Applicant</h4>
	</div><!--./col-->
	<div class="col-xl-9 col-lg-9">
         <?php if($status == 'applied'){?>
            <div class="row outside_button">
                
                <div class="col-xl-4 col-lg-2 col-md-4 col-sm-6 col-6 align-self-center" style="min-width:1.7in;">
                    <a target="_blank" href="<?php echo base_url('generate/pdf/'.$id.'') ?>" class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_edit"><i class="fa fa-print"></i></a> <small>Save or Print Profile</small>
                </div>

                <!-- <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 align-self-center text-right" style="min-width:1.4in;">
                    <a href="<?php echo base_url('schedule/add/0?user_id='.$id.'&job_post='.$job_post_id.'') ?>" class="btn btn-pill-sm btn-pill-sm-outline-light-2x text-primary xbtn_for_interview d-none">Set Schedule</a>
                </div> -->

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 align-self-center">
                    <select name="header[status]" class="custom-select custom-select-sm d-none" placeholder="Search" aria-label="Search">
                        <option value = "">Move To...</option>
                        <option value = "short listed">Shortlisted</option>
                        <option value = "for interview">Set Schedule</option>
                        <option value = "offered">Offered</option>
                        <option value = "hired">Hired</option>
                    </select><!--./select-->  
                </div>
                
                <!-- <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 align-self-center text-right">
                    <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Submit</button>
                </div> -->
                <div class="col d-flex align-self-center justify-content-end" style="min-width:1.4in;">
                    <a class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm text-decoration-none btn_compare">Compare With</a>
                </div>

            </div>
        <?php }?>
        <!-- Stepper -->
        <div class="stepper">
            <div id="step1" class="step complete" data-step="">
                <div class="step-number">1</div>
                <div class="circle">
                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="check"></div>
                <div class="step-title">Pending</div>
                <div class="step-line"></div>
            </div>
            <div id="step2" class="step active" data-step="short listed">
                <div class="step-number">2</div>
                <div class="circle">
                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="check"></div>
                <div class="step-title">Shortlisted</div>
                <div class="step-line"></div>
            </div>
            <div id="step3" class="step" data-step="for interview">
                <div class="step-number">3</div>
                <div class="circle">
                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="check"></div>
                <div class="step-title">Schedule Interview</div>
                <div class="step-line"></div>
            </div>
            <div id="step4" class="step" data-step="offered">
                <div class="step-number">4</div>
                <div class="circle">
                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="check"></div>
                <div class="step-title">Offered</div>
                <div class="step-line"></div>
            </div>
            <div id="step5" class="step" data-step="hired">
                <div class="step-number">5</div>
                <div class="circle">
                    <svg class="check" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                    </svg>
                </div>
                <div class="check"></div>
                <div class="step-title">Hired</div>
            </div>
        </div>
        <!-- Stepper end -->
	</div><!--./col-->
	
</div><!--./row-->


<div class="row">
	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
		<div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded-circle" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[company_name]" class="my-0 text-break"></h6>
            <small class="text-muted" id="header[userid]"></small><br/>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
        <hr/>
        <div class="row">
            <div class="col-auto">
                <div class="table-responsive">
                    <table id="activity_logs" class="table table-borderless d-none text-muted">
                            <tr>
                                <td class="text-left fw-bolder">Action Logs</td>
                            </tr>
                            
                        
                    </table>
                </div>
            </div>
        </div>
	</div>
	<div class="col">


		<form id="frm_data_entry">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Primary Information</h4>
                </div>
                <div class="card-body">
                    <?php $class = "";
                        if($_SESSION['usertype'] == 'admin'){
                            $class = "d-none";
                        }//end if

                    ?>

                    <div class="form-group row to_hide <?php echo $class;?>">
                          <label class="col-3 col-form-label"><i data-toggle="tooltip" data-placement="top" title="(MAX 5MB) GIF | PNG | JPG | JPEG" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i></label>
                          <div class="col">
                            <input type='file' name='header[userfile][]' size='20' />
                            
                                <button name='btn_upload' type='button' class='btn btn-primary btn-sm'>Upload</button>
                                <button name='btn_remove' type='button' class='btn btn-danger btn-sm'>Remove</button>
                                
                          </div>
                    </div><!--./row-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label align-self-center">Doc Content</label>
                        <div class="col align-self-center">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label align-self-center">Doc Image</label>
                        <div class="col align-self-center">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label align-self-center">Old Image</label>
                        <div class="col align-self-center">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label align-self-center">Job Post ID</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[job_post_id]" value="<?php echo $job_post_id;?>" />
                        </div>
                    </div>

                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label align-self-center">Id</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">First Name</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Middle Name</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[middle_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Last Name</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Email</label>
                        <div class="col align-self-center">
                              <input value="" Placeholder="Email" name="header[email_add]" type="text" class="form-control form-control-sm" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                   


                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Mobile Number</label>
                        <div class="col-2 align-self-center">
                            <select class="custom-select custom-select-sm" name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                   
                    <div class="form-group row ">
                        <label class="col-3 col-form-label text-right align-self-center">Location</label>
                        <div class="col align-self-center asvw-withsel">
                            <input class="form-control form-control-sm" name="header[location]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                   


                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label">Country</label>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->

                    



                    <div class="form-group row asvw-internship">
                        <label class="col-3 col-form-label text-right align-self-center">Internship</label>
                        <div class="col-1 align-self-center">
                            <input type="checkbox" class="w-auto" name="header[internship]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                </div><!--./card-body-->
            </div><!--./card-->


            <div class="card mb-3">
                <div class="card-header">
                    <h4>Highlights</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Highlights</label>
                        <div class="col">
                            <textarea class="form-control form-control-sm asvw-textarea" name="header[highlights]" maxlength="400"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                </div>
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Experience</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="experience_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_experience" class="btn btn-sm btn-secondary" type="button">Add Experience</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Skills</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="skills_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_skills" class="btn btn-sm btn-secondary" type="button">Add Skills</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->


            <div class="card mb-3">
                <div class="card-header">
                    <h4>Education</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="education_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_education" class="btn btn-sm btn-secondary" type="button">Add Education</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->
            

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Language</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="language_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_language" class="btn btn-sm btn-secondary" type="button">Add Language</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Certifications and Licenses</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="certification_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_certification" class="btn btn-sm btn-secondary" type="button">Add Certifications and Licenses</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->


            <div class="card mb-3">
                <div class="card-header">
                    <h4>Projects</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="projects_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_projects" class="btn btn-sm btn-secondary" type="button">Add Projects</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Seminars & Trainings</h4>
                </div><!--./card-header-->

                <div class="card-body">
                    
                    
                    <div id="seminar_training_content">
                        
                    </div><!--./experience_content-->

                    
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_seminar_training" class="btn btn-sm btn-secondary" type="button">Add Seminars & Trainings</button>
                    </div>


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Awards & Achievements</h4>
                </div><!--./card-header-->
                <div class="card-body">
                    <div id="awards_achievements_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_awards_achievements" class="btn btn-sm btn-secondary" type="button">Add Awards & Achievements</button>
                    </div>
                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Affiliations</h4>
                </div><!--./card-header-->
                <div class="card-body">
                    <div id="affiliations_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group asvw-addBtn">
                        <button name="btn_add_affiliations" class="btn btn-sm btn-secondary" type="button">Add Affiliations</button>
                    </div>
                </div><!--./card-body-->
            </div><!--./card-->

            <!-- <div class="card mb-3">
                <div class="card-header">
                    <h4>Job Preferences</h4>
                </div>
                <div class="card-body">
                    <div id="industry_content">
                    </div>
                    <div class="btn btn-group">
                        <button name="btn_add_industry" class="btn btn-sm btn-secondary" type="button">Add Industry</button>
                    </div>

                    <div id="job_level_content">
                    </div>
                    <div class="btn btn-group">
                        <button name="btn_add_job_level" class="btn btn-sm btn-secondary" type="button">Add Job Level</button>
                    </div>

                    <div id="job_type_content">
                    </div>
                    <div class="btn btn-group">
                        <button name="btn_add_job_type" class="btn btn-sm btn-secondary" type="button">Add Job Type</button>
                    </div>

                    <div id="department_content">
                    </div>
                    <div class="btn btn-group">
                        <button name="btn_add_department" class="btn btn-sm btn-secondary" type="button">Add Department</button>
                    </div>
                </div>
            </div> -->


            <div class="card mb-3">
                <div class="card-header">
                    <h4>Resume</h4>
                </div><!--./card-header-->
                <div class="card-body">
                    <div class="form-group row to_hide <?php echo $class;?>">
                      <label class="col-1 col-form-label">
                        <i data-toggle="tooltip" data-placement="top" title="(MAX 40MB) DOCX | DOC" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i>
                         

                      </label>
                      <div class="col">
                        <input type='file' name='header[company_file][]' accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                            <button name='btn_upload_multiple' type='button' class='btn btn-primary btn-sm'>Upload</button>
                            <button name='btn_remove_multiple' type='button' class='btn btn-danger btn-sm'>Remove</button>
                      </div><!--./col-->
                    </div><!--./row-->

                    <div id="image_cont">
                    </div><!--./row-->

                    <div id="image_cont_form" class="row row-cols-1">
                        <div class="form-group row d-none">
                            <label class="col-3 col-form-label">Doc Content</label>
                            <div class="col">
                                <input readonly class="form-control form-control-sm" type="text" name="file[resume_content]"/>
                            </div><!--./col-10-->
                        </div><!--./form-group-->

                        <div class="form-group row d-none">
                            <label class="col-3 col-form-label">Doc Image</label>
                            <div class="col">
                                <input readonly class="form-control form-control-sm" type="text" name="header[resume]"/>
                            </div><!--./col-10-->
                        </div><!--./form-group-->

                        <div class="form-group row d-none">
                            <label class="col-3 col-form-label">Old Image</label>
                            <div class="col">
                                <input readonly class="form-control form-control-sm" type="text" name="file[old_resume]"/>
                            </div><!--./col-10-->
                        </div><!--./form-group-->
                    </div><!--./image_cont_form-->



                </div><!--./card-body-->
            </div><!--./card-->




            
            


            
        </form>

        
	</div><!--./col-->
	
</div><!--./row-->




<div class="row">
    <div class="col">
        <div class="outside_button text-right">
            <?php if($type == 'edit'){?>
                <a href="<?php echo base_url('applicant_info/view/'.$id.'') ?>" class="text-primary mr-4">Cancel</a> 
            <?php }?>
           

          
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Submit</button>
        </div><!--./text-right-->
    </div><!--./col-->
</div><!--./row-->


<!--CONTENT END TAG-->			
		</div><!--./col content-->
	</div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->	

<?php require_once('app/Views/libraries/copyright.php'); ?>
  

<!-- Footer Menu -->
<?php require_once('app/Views/libraries/footer-menu.php'); ?>
<?php require_once('app/Views/libraries/footer.php'); ?>
<!-- Footer Menu -->



<!-- datatables -->
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.buttons.min.js') ?>"></script>
<!-- datatables -->





<!--Autocomplete-->
<script src="<?php echo base_url('assets/autocomplete/js/jquery.mockjax.js') ?>"></script>
<script src="<?php echo base_url('assets/autocomplete/js/jquery.autocomplete.js') ?>"></script>
<!--Autocomplete-->

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/applicant_search_vw.js?v='). date('Ymdi') ?>"></script>



