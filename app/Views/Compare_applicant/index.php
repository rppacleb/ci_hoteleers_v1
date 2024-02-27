<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var applicant_id                = <?php echo !isset($_GET['user_id'])? '""' : $_GET['user_id']; ?>;
var job_post               	 	= <?php echo !isset($_GET['job_post'])? '""' : $_GET['job_post']; ?>;
var status                		= <?php echo !isset($_GET['status'])? '""' : "'".$_GET['status']."'"; ?>;

var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;

var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>



<div class="row">
    <p class="text-muted mb-4"><a class="text-link" href="#" onClick="history.back()">Back</a> / Compare Applicant</p>
    <div class="col">
        <h5>Compare Applicant</h5>
    </div>
</div>


<div class="form-group row">
    <div class="col-2 d-none">
        <input readonly class="form-control" type="text" name="header[job_post]"/>
    </div>
    <div class="col">
        <div class="input-group">
            <input placeholder="Enter Job Post" class="form-control" type="text" id="header[job_post_text]"/>
        </div><!--./input-group input-group-sm-->
    </div><!--./col-10-->
</div><!--./form-group-->

<div class="form-group row">
    <div class="col">
        <select name="header[status]" class="custom-select view" placeholder="Search" aria-label="Search">
		    <option value="short listed">Shortlisted</option>
		    <option value="for interview">For Interview</option>
		    <option value="offered">Offered</option>
		</select>
    </div><!--./col-10-->
</div><!--./form-group-->

<div class="row">
	
	
	<div class="col">
		
		<div class="input-group mb-3">
		  <input readonly name="header[applicant1]" type="text" class="form-control d-none" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">

		  <input disabled name="header[applicant1_text]" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append d-none">
		    <button class="btn btn-primary btn_find1" type="button">Find</button>
		  </div>
		</div><!--./input-group-->
	</div><!--./col-->

	

	<div class="col">
		
		<div class="input-group mb-3">
		  <input readonly name="header[applicant2]" type="text" class="form-control d-none" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">

		  <input name="header[applicant2_text]" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find2" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->




<!--applicant section-->

<div class="card-deck">


        
            <div class="card mb-3 d-flex">
                <div class="card-header">
                    <h4>Primary Information</h4>
                    <div id="loader" class="text-center">
                        
                    </div>
                </div>
                <div class="card-body">
                    <form class="frm_data_entry">
                    <div class="row">
                        <div class="col">
                            <div class="media">
                              <img src="<?php echo base_url('files/images/default/user.png') ?>" id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
                              <div class="media-body">
                                <h6 id="header[company_name]" class="mt-0"></h6>
                                <p id="header[location]"></p>
                              </div>
                            </div>
                            <hr/>
                            <p id="header[date_created]"></p>
                        </div>
                    </div>

                  
                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Doc Content</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Doc Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Old Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Id</label>
                        <div class="col">
                          <input readonly class="form-control-plaintext form-control-sm mb-2" type="text" name="header[id]" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">First Name </label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Middle Name</label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[middle_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Last Name </label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Email </label>
                        <div class="col align-self-center">
                              <input disabled name="header[email_add]" type="text" class="form-control-plaintext form-control-sm" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                   


                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Mobile Number</label>
                        <div class="col-3 align-self-center">
                            <select disabled class="custom-select-plaintext custom-select-sm form-control-plaintext" name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                   
                    
                    

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right">Location </label>
                        <div class="col">
                            <textarea readonly class="form-control-plaintext form-control-sm ca-textarea" name="header[location]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                    <div class="form-group row d-none">
                      <label class="col-4 col-form-label">Country</label>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    



                    <div class="form-group row ca-internship">
                        <label class="col-4 col-form-label text-right align-self-center">Internship</label>
                        <div class="col-1 align-self-center w-auto">
                            <input disabled type="checkbox" name="header[internship]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    </form><!--./form-->
                </div><!--./card-body-->
            </div><!--./card-->
        
  
        
            <div class="card mb-3" >
                <div class="card-header">
                    <h4>Primary Information</h4>
                    <div id="loader" class="text-center">
                        
                    </div>
                </div>
                <div class="card-body">
                    <form class="frm_data_entry2">
                    <div class="row">
                        <div class="col">
                            <div class="media">
                              <img src="<?php echo base_url('files/images/default/user.png') ?>" id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
                              <div class="media-body">
                                <h6 id="header[company_name]" class="mt-0"></h6>
                                <p id="header[location]"></p>
                              </div>
                            </div>
                            <hr/>
                            <p id="header[date_created]"></p>
                        </div>
                    </div>
                  
                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Doc Content</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Doc Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Old Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label">Id</label>
                        <div class="col">
                          <input readonly class="form-control-plaintext form-control-sm mb-2" type="text" name="header[id]" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">First Name </label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Middle Name</label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[middle_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Last Name </label>
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Email </label>
                        <div class="col align-self-center">
                              <input disabled name="header[email_add]" type="text" class="form-control-plaintext form-control-sm" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                   


                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Mobile Number</label>
                        <div class="col-3 align-self-center">
                            <select disabled class="custom-select-plaintext custom-select-sm form-control-plaintext" name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col align-self-center">
                            <input disabled class="form-control-plaintext form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                   
                                

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right">Location </label>
                        <div class="col">
                            <textarea readonly class="form-control-plaintext form-control-sm ca-textarea" name="header[location2]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                    <div class="form-group row d-none">
                      <label class="col-4 col-form-label">Country</label>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country2]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    



                    <div class="form-group row ca-internship2">
                        <label class="col-4 col-form-label text-right align-self-center">Internship</label>
                        <div class="col-1 w-auto align-self-center">
                            <input disabled type="checkbox" name="header[internship]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                </form><!--./form-->
                </div><!--./card-body-->
            </div><!--./card-->
 
</div>


<div class="card-deck">
    
        
        <div class="card mb-3">
            <div class="card-header">
                <h4>Highlights</h4>
            </div><!--./card-header-->

            <div class="card-body">
                <form class="frm_data_entry">
                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right">Highlights </label>
                        <div class="col">
                            <textarea disabled class="form-control-plaintext form-control-sm ca-textarea" name="header[highlights]" maxlength="400"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                </form>
            </div>
        </div><!--./card-->
    
    
        <div class="card mb-3">
            <div class="card-header">
                <h4>Highlights</h4>
            </div><!--./card-header-->

            <div class="card-body">
                <form class="frm_data_entry2">
                <div class="form-group row">
                    <label class="col-4 col-form-label text-right">Highlights </label>
                    <div class="col">
                        <textarea disabled class="form-control-plaintext form-control-sm ca-textarea" name="header[highlights]" maxlength="400"></textarea>
                    </div><!--./col-10-->
                </div><!--./form-group-->

                </form>
            </div>
        </div><!--./card-->
        
    
</div><!--./row-->

<div class="card-deck">
    
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Experience</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry">
            <div id="experience_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Experience</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">
            <div id="experience_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">
    
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Skills</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry">
            <div id="skills_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
        
    

    <div class="card mb-3">
        <div class="card-header">
            <h4>Skills</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">
            <div id="skills_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">

        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Education</h4>
        </div><!--./card-header-->

        <div class="card-body">
            
            <form class="frm_data_entry">
            <div id="education_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
        
    

    <div class="card mb-3">
        <div class="card-header">
            <h4>Education</h4>
        </div><!--./card-header-->

        <div class="card-body">
            
            <form class="frm_data_entry2">
            <div id="education_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">
   
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Language</h4>
        </div><!--./card-header-->

        <div class="card-body">
            <form class="frm_data_entry">
            
            <div id="language_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
    

    <div class="card mb-3">
        <div class="card-header">
            <h4>Language</h4>
        </div><!--./card-header-->

        <div class="card-body">
            <form class="frm_data_entry2">
            
            <div id="language_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Certifications and Licenses</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry">
            <div id="certification_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->

    <div class="card mb-3">
        <div class="card-header">
            <h4>Certifications and Licenses</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">
            <div id="certification_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">
  
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Projects</h4>
        </div><!--./card-header-->

        <div class="card-body">
            
            <form class="frm_data_entry">
            <div id="projects_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
       

    <div class="card mb-3">
        <div class="card-header">
            <h4>Projects</h4>
        </div><!--./card-header-->

        <div class="card-body">
            
            <form class="frm_data_entry2">
            <div id="projects_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">

        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Seminars & Trainings</h4>
        </div><!--./card-header-->

        <div class="card-body">
            <form class="frm_data_entry">
            
            <div id="seminar_training_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
  

    <div class="card mb-3">
        <div class="card-header">
            <h4>Seminars & Trainings</h4>
        </div><!--./card-header-->

        <div class="card-body">
            <form class="frm_data_entry2">
            
            <div id="seminar_training_content">
                
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">

    <div class="card mb-3">
        <div class="card-header">
            <h4>Awards & Achievements</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry">
            <div id="awards_achievements_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
    

    <div class="card mb-3">
        <div class="card-header">
            <h4>Awards & Achievements</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">
            <div id="awards_achievements_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">

    <div class="card mb-3">
        <div class="card-header">
            <h4>Affiliations</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry">
            <div id="affiliations_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
   

    <div class="card mb-3">
        <div class="card-header">
            <h4>Affiliations</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">
            <div id="affiliations_content">
            </div><!--./experience_content-->
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
</div><!--./row-->


<div class="card-deck">
   
        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Resume</h4>
        </div><!--./card-header-->
        <div class="card-body">
            
            <form class="frm_data_entry">
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
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
        
    


        
    <div class="card mb-3">
        <div class="card-header">
            <h4>Resume</h4>
        </div><!--./card-header-->
        <div class="card-body">
            <form class="frm_data_entry2">

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
            </form>
        </div><!--./card-body-->
    </div><!--./card-->
        
    
</div><!--./row-->

<div class="row">	
	<!--applicant 1 section-->
	<div class="col">
        

		<form id="frm_data_entry">
        </form><!--./form-->
        
	</div><!--./col-->
	<!--applicant 1 section-->
	
	<!--applicant 2 section-->
	<div class="col">
		<form id="frm_data_entry2">



            
        </form><!--./form-->
        
	</div><!--./col-->
	<!--applicant 2 section-->
</div><!--./row-->
<!--applicant section-->








<!--CONTENT END TAG-->			
		</div><!--./col content-->
	</div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->	

<?php require_once('app/Views/libraries/copyright.php'); ?>
  

<!-- Footer Menu -->

<div class="modal fade" id="job_post_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_modal_title">Copy</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="job_post_modal_body">
					
        </div>
    </div>
  </div>
</div>

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

<script src="<?php echo base_url('assets/main/js/compare_applicant.js?v='). date('Ymdi') ?>"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAGyohoEluWcR09ZROWb0cSHKa-QoqZmwM&libraries=places&callback=initMap"></script> -->
