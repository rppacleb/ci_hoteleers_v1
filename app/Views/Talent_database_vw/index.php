<?php require_once('app/Views/libraries/header.php'); ?>



<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<?php
$job_post_id = !isset($_GET['job_post'])? "" : $_GET['job_post'];
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>

<script type="text/javascript">
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;
var job_post_id                 = <?php echo !isset($_GET['job_post'])? '""' : $_GET['job_post']; ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? '""' : $_SESSION['userid']; ?>;
var user                        = <?php echo !isset($id)? '""' : $id; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
var mod_type                    = <?php echo !isset($_GET['mod_type'])? '""' : '"'.$_GET['mod_type'].'"'; ?>;
</script>

<div class="row mb-5">
    <div class="col-xl-3 col-lg-3 mt-1">
    <p class="text-muted"><a class="text-link" href="#" onClick="history.back()">Back</a> / Applicant</p>

    </div><!--./col-->
    <div class="col">
            
            
            <div class="row outside_button">
                <div class="col">
                    <a target="_blank" href="<?php echo base_url('generate/pdf/'.$id.'') ?>" class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_edit"><i class="fa fa-print"></i></a> <small>Save or Print Profile</small>
                </div>
            
                <div class="col text-right">
                    <button data-toggle="modal" data-target="#invite_to_job_modal" class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button">Invite to Job</button>
                </div>
            </div>
        
    </div><!--./col-->
    
</div><!--./row-->


<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
        <div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[company_name]" class="my-0"></h6>
            <small class="text-muted" id="header[userid]"></small><br/>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
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
                        <label class="col-3 col-form-label">Doc Content</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Doc Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Old Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Job Post ID</label>
                        <div class="col">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[job_post_id]" value="<?php echo $job_post_id;?>" />
                        </div>
                    </div>

                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Id</label>
                        <div class="col">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">First Name <span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
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
                        <label class="col-3 col-form-label text-right align-self-center">Last Name <span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Email <span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
                        <div class="col align-self-center">
                              <input value="" Placeholder="Email" name="header[email_add]" type="text" class="form-control form-control-sm" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                   


                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Mobile Number<span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
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
                        <label class="col-3 col-form-label text-right align-self-center">Location <span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" name="header[location]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    

                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label">Country</label>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    



                    <div class="form-group row tdvw-internship">
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
                        <label class="col-3 col-form-label text-right">Highlights <span class="text-danger fw-bolder tdvw-asterisk">*</span></label>
                        <div class="col-8">
                            <textarea class="form-control form-control-sm tdbvw-textarea" name="header[highlights]" maxlength="400"></textarea>
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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

                    
                    <div class="btn btn-group tdvw-addBtn">
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
                    <div class="btn btn-group tdvw-addBtn">
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
                    <div class="btn btn-group tdvw-addBtn">
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
            <div class="row outside_button">
                <div class="col text-right">
                    <button data-toggle="modal" data-target="#invite_to_job_modal" class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button">Invite to Job</button>
                </div>
            </div>
        </div><!--./text-right-->
    </div><!--./col-->
</div><!--./row-->


<!--CONTENT END TAG-->          
        </div><!--./col content-->
    </div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->  

<?php require_once('app/Views/libraries/copyright.php'); ?>


<div class="modal fade" id="invite_to_job_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row mb-5">
                <div class="col">
                    <h4>Active Jobs Posted</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    
                    <div class="input-group input-group-md mb-3">
                      <input name="header[keyword]" type="text" class="form-control" placeholder="Job Title" aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn_find btn-md pr-4 pl-4 pt-3 pb-3" type="button">Find</button>
                      </div><!--./input-group-append-->
                    </div><!--./input-group-->
                </div><!--./col-->
            </div><!--./row-->

      

            <!--jobs section-->
            <div class="row">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col">
                            <p><small class="text-muted pagination_result"></small></p>
                        </div><!--./col--> 
                    </div><!--./row-->

                    <div id="main_loader" class="row row-cols-2">
                    </div>
                    

                    <div class="row mb-2">
                        <div class="col">
                            <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1 text-center text-muted-header" style="min-width:0.5in;">
                                            ID
                                        </div><!--./col-->

                                        <div class="col text-left text-muted-header" style="min-width:1in;">
                                            TITLE
                                        </div><!--./col-->

                                        <div class="col text-left text-muted-header">
                                            EXP. DATE
                                        </div><!--./col-->
                                        
                                        <div class="col text-center text-muted-header">
                                            HIRED
                                        </div><!--./col-->

                                        <div class="col text-center text-muted-header">
                                            JOB POST VIEWS
                                        </div><!--./col-->

                                        <div class="col text-center text-muted-header">
                                            INTERVIEWS
                                        </div><!--./col-->

                                        <div class="col-xl-1 col-lg-1" style="min-width:1in;">
                                            
                                        </div><!--./col-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--./row-->

                    <div id="main_container">
                    </div>
                    <div class="row">
                        <!--pagination-->
                        <div class="col">
                            <nav>
                                <ul class="pagination main_pagination justify-content-start" aria-type="main">

                                </ul>
                            </nav>
                        </div><!--./col-->
                        <!--pagination-->
                        <div class="col-2">
                            
                        </div><!--./col-2-->
                    </div><!--./row-->
                </div><!--./col-->
            </div><!--./row-->
            <!--jobs section-->

        </div><!--./modal-body-->
    </div>
  </div>
</div>

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




<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>


<script src="<?php echo base_url('assets/main/js/talent_database_vw.js?v='). date('Ymdi') ?>"></script>



