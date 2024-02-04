<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php require_once('app/Views/libraries/top-bar.php'); ?>

<div class="row justify-content-center mb-4">
    <div class="col-2">
    </div>
    <div class="col-auto">
        <?php
            if(
                (isset($_GET['req_job_application']) || isset($_GET['req_primary'])) 
                && ($_GET['req_job_application'] || $_GET['req_primary'])
            )
            {
        ?>
            <div class="alert alert-warning">
                <?php echo isset($_GET['req_job_application']) && $_GET['req_job_application']? '<b>Must input at least one work experience, education or attach a resume before applying a job!</b>' : ''; ?>
                <?php echo isset($_GET['req_primary']) && $_GET['req_primary']? '<b>Must input your first name, last name and location first before applying a job!!</b>' : ''; ?>
            </div>
        <?php }?>
    </div>
</div>


<div class="row mobile-aivwrowpic">
    <div class="col mobile-aivw">
		<div class="media mb-2">
          <div class="container2" >
                
                <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:125px;height:125px;">
                <!-- <label for="file-upload" class="custom-file-upload text-primary tooltip_icon" data-toggle="tooltip" data-placement="bottom" title="(MAX 5MB) GIF | PNG | JPG | JPEG"><i class="fa fa-camera"></i></label>
                <label class="custom-file-upload2 text-danger" ><i class="fas fa-times"></i></label> -->
               
          </div>

          <div class="media-body">
            <h6 id="header[company_name]" class="mt-0"></h6>
            <p id="header[location]" class="aivw-headlocation"></p>
            <label for="file-upload"><p class="text-link mb-0 custom-file-upload"><i class="fa fa-pencil mr-2"></i> Edit photo</p></label>
            <p class="custom-file-upload2" style="color: #6c757d;"><i class="fa fa-trash mr-2"></i> Delete</p>
          </div>




        </div>
        <hr/>
        <p id="header[date_created]"></p>
	</div>
</div>

<div class="row mobile-aivwprofrow desktop-lock">
    <div class="col-1 mobile-aivwspacer"></div>

    <div class="col-4 mb-5">
        <h4 class="mb-5 d-none">
            <a style="text-decoration:none;" class="text-muted" href="<?php echo base_url('applicant_info/') ?>">Profile</a>
            <a style="text-decoration:none;" class="text-muted" href="<?php echo base_url('applicant_info/'.$type.'/'.$id.'') ?>">/ <?php echo $type;?></a>
        </h4>
    </div><!--./col-->

    <div class="col">
        <div class="outside_button text-right">
            <?php if($type == 'edit'){?>
                <a href="<?php echo base_url('applicant_info/view/'.$id.'') ?>" class="text-primary mr-4">Cancel</a> 
            <?php }?>

            <?php if($type == 'view'){
                    if(in_array('edit' ,$access)){
            ?>

                <a href="<?php echo base_url('applicant_info/edit/'.$id.'') ?>" class="btn btn-sm btn-pill-sm-no-brdr btn-primary btn_edit">Edit</a>
            <?php   }
                }
            ?>
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Save</button>
        </div><!--./text-right-->
    </div><!--./col-->

</div><!--./row-->


<div class="row desktop-lock">
    <div class="col-1 mobile-aivwspacer"></div>
	<div class="col-3 desktop-aivw">
		<div class="media">
          <div class="container2" >
                
                <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
                <!-- <label for="file-upload" class="custom-file-upload text-primary tooltip_icon" data-toggle="tooltip" data-placement="bottom" title="(MAX 5MB) GIF | PNG | JPG | JPEG"><i class="fa fa-camera"></i></label>
                <label class="custom-file-upload2 text-danger" ><i class="fas fa-times"></i></label> -->
               
          </div>

          <div class="media-body">
            <h6 id="header[company_name]" class="my-0"></h6>
            <small class="text-muted my-0" id="header[userid]"></small><br/>
            <p id="header[location]" class="aivw-headlocation"></p>
            
            <label for="file-upload">
                <p class="text-link mb-0 custom-file-upload"><i class="fa fa-pencil mr-2"></i> Edit photo</p>
            </label>
            <p class="custom-file-upload2" style="color: #6c757d;"><i class="fa fa-trash mr-2"></i> Delete</p>
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
                          <label class="col-3 col-form-label"></label>
                          <div class="col d-none">
                            <input type='file' id="file-upload" name='header[userfile][]' size='20' />
                            
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
                        <label class="col-3 col-form-label">Id</label>
                        <div class="col">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">First Name <span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Middle Name</label>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[middle_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Last Name <span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Email <span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-6 col-xl-6 align-self-center desktop-aivwemail">
                              <input readonly Placeholder="Email" name="header[email_add]" type="text" class="form-control-plaintext form-control-sm" maxlength="100">
                        </div><!--./col-->
                        <!-- <div class="col-auto">
                            <a title="Change email" href="#" id="change_email" class="show_on_view">
                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 20px;"></i>
                            </a>
                        </div> -->
                    </div><!--./row-->
                   


                    <div class="form-group row desktop-aivwmobilenumber">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Mobile Number</label>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 aivw-mobcode align-self-center">
                            <input class="form-control form-control-sm d-none" type="text" name="placeholder[dial_code]"/>
                            <select name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){
                               
                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4 col-sm-4 col-md-4 col-lg-6 col-xl-6 align-self-center">
                            <input id="contact_number" class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-aivwmobilenumber-view">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Mobile Number<span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 pr-0 aivw-mobcode align-self-center">
                        <input class="form-control form-control-sm d-none" type="text" name="placeholder[dial_code]"/>
                            <select name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4 col-sm-4 col-md-4 col-lg-6 col-xl-6 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10--> 
                    </div><!--./form-group-->

                    <div class="form-group row mobile-aivwmobilenumber-edit">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Mobile Number<span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2 aivw-mobcode align-self-center">
                            <input class="form-control form-control-sm d-none" type="text" name="placeholder[dial_code]"/>
                            <select name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row mobile-aivwmobilenumber-edit">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 align-self-center"></div>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-6 col-xl-6 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10--> 
                    </div><!--./form-group-->

                    
                   
                    
                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Location <span class="text-danger fw-bolder aivw-asterisk">*</span></label>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
                            <div class="input-group input-group-sm aivw-withsel">
                                <input class="form-control form-control-sm d-none" type="text" name="placeholder[location]"/>
                                <select name="header[location]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label">Country</label>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    



                    <div class="form-group row aivw-internship">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right d-flex align-self-center justify-content-end gap-2">
                            <div class="c-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable this if you are applying as an Intern.">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </div>
                            <div>Internship</div>
                        </div>
                        <div class="col-2 align-self-center d-flex">
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
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Highlights</label>
                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8">
                            <textarea class="form-control form-control-sm aivw-textarea" name="header[highlights]" maxlength="2000"></textarea>
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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

                    
                    <div class="btn btn-group aivw-addBtn">
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
                    <div class="btn btn-group aivw-addBtn">
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
                    <div class="btn btn-group aivw-addBtn">
                        <button name="btn_add_affiliations" class="btn btn-sm btn-secondary" type="button">Add Affiliations</button>
                    </div>
                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3">
                <div class="card-header">
                    <h4>Job Preferences</h4>
                </div><!--./card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            Industry
                        </div>
                    </div>
                    <div id="industry_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group aivw-addBtn">
                        <button name="btn_add_industry" class="btn btn-sm btn-secondary" type="button">Add Industry</button>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col">
                            Job Level
                        </div>
                    </div>

                    <div id="job_level_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group aivw-addBtn">
                        <button name="btn_add_job_level" class="btn btn-sm btn-secondary" type="button">Add Job Level</button>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col">
                            Job Type
                        </div>
                    </div>
                    <div id="job_type_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group aivw-addBtn">
                        <button name="btn_add_job_type" class="btn btn-sm btn-secondary" type="button">Add Job Type</button>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col">
                            Department
                        </div>
                    </div>

                    <div id="department_content">
                    </div><!--./experience_content-->
                    <div class="btn btn-group aivw-addBtn">
                        <button name="btn_add_department" class="btn btn-sm btn-secondary" type="button">Add Department</button>
                    </div>
                </div><!--./card-body-->
            </div><!--./card-->


            <div class="card mb-3">
                <div class="card-header">
                    <h4>Resume</h4>
                </div><!--./card-header-->
                <div class="card-body">
                    <div class="form-group row to_hide <?php echo $class;?> mt-4 mb-3">

                      <div class="col align-self-center text-center">
                            <!-- Upload Resume -->
                            <div class="image-upload">
                              <label id="company_file_placeholder" for="company_file" class="custom-file-upload-no-hover text-primary" style="font-size: 20pt;">
                                <a class='btn btn-pill-sm-primary text-primary btn-sm upload-resumebtn' style="font-size: 1rem; padding: 1px 1px; width: 1.5in; border: 2px solid rgba(var(--bs-primary-rgb));">Upload Resume</a>
                              </label>
                            </div>
                            
                      </div>

                      <!-- <div class="col align-self-center text-center">
                            Clear Resume
                            <div class="image-upload">
                              <label class="custom-file-upload-no-hover text-danger btn_remove_multiple" style="font-size: 20pt;">
                                <i class="fa fa-times"></i>
                              </label>
                            </div>
                            <button name='btn_remove_multiple' type='button' class='btn btn-danger btn-sm'>Clear Resume</button>
                      </div> -->

                      <!-- <label class="col-1 col-form-label">
                        <i data-toggle="tooltip" data-placement="top" title="(MAX 40MB) DOCX | DOC | PDF" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i>
                         

                      </label> -->
                      <div class="col d-none">
                        <input type='file' id="company_file" name='header[company_file][]' accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                            <button name='btn_upload_multiple' type='button' class='btn btn-primary btn-sm'>Upload</button>
                            <button name='btn_remove_multiple' type='button' class='btn btn-danger btn-sm'>Remove</button>
                      </div><!--./col-->

                      <div class="row mt-2">
                          <div class="col text-center">
                            <i data-toggle="tooltip" data-placement="top" title="" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i>
                            <span class="text-muted">(MAX 40MB) DOCX | DOC | PDF</span>
                          </div>
                      </div>
                    </div><!--./row-->

                    <div id="image_cont" class="row row-cols-1">
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




<div class="row desktop-lock">
    <div class="col">
        <div class="outside_button text-right">
            <?php if($type == 'edit'){?>
                <a href="<?php echo base_url('applicant_info/view/'.$id.'') ?>" class="text-primary mr-4">Cancel</a> 
            <?php }?>
           

            <?php if($type == 'view'){
                    if(in_array('edit' ,$access)){
            ?>

                <a href="<?php echo base_url('applicant_info/edit/'.$id.'') ?>" class="btn btn-sm btn-pill-sm-no-brdr btn-primary btn_edit">Edit</a>
            <?php   }
                }
            ?>
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Save</button>
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

<!--multiselect dropdown-->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/applicant_info_vw.js?v='). date('Ymdi') ?>"></script>


