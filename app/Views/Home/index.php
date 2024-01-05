<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">

<!--multiselect dropdown-->
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<script type="text/javascript">
	var user_id 	= <?php echo $_SESSION['userid']; ?>;
	var first_login = <?php echo $profile["data"]->first_login; ?>;
	var user_type 	= <?php echo isset($profile["data"]->user_type)? '"'.$profile["data"]->user_type.'"' : '""'; ?>;
	var password_changed = <?php echo $profile["data"]->password_changed; ?>;

	var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>



<?php require_once('app/Views/libraries/top-bar.php'); ?>


			


<!--CONTENT END TAG-->			
		</div><!--./col content-->
		
	</div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->	


        


<?php require_once('app/Views/libraries/copyright.php'); ?>
  



<!-- Footer Menu -->



<!--Required Modal-->
<div class="modal fade" id="required_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body" id="required_modal_body">
        	<div class="row">
	        	<div class="col">
	        		<form id="frm_preference">
	        			<div class="card mb-3">
			                <div class="card-header">
			                    <h4>Primary Information</h4>
			                </div>
			                <div class="card-body">
			                	<div class="form-group row d-none">
			                        <label class="col-3 col-form-label">Id</label>
			                        <div class="col">
			                          <input readonly class="form-control form-control-sm mb-2" type="text" name="header[id]" value="<?php echo $user_id;?>" />
			                        </div>
			                    </div>
			                    
			                    <div class="form-group row">
			                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">First Name <span class="text-danger fw-bolder">*</span></label>
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
			                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Last Name <span class="text-danger fw-bolder">*</span></label>
			                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
			                            <input class="form-control form-control-sm" type="text" name="header[last_name]" maxlength="100"/>
			                        </div><!--./col-10-->
			                    </div><!--./form-group-->

			                    <div class="form-group row">
			                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Email</label>
			                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center desktop-aivwemail">
			                              <input readonly value="<?php echo $_SESSION['username'];?>" Placeholder="Email" name="header[email_add]" type="text" class="form-control form-control-sm" maxlength="100">
			                        </div><!--./col-->
			                    </div><!--./row-->
			                   


			                    <!--<div class="form-group row desktop-aivwmobilenumber">
			                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Mobile Number</label>
			                        <div class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 aivw-mobcode align-self-center">
			                            <input class="form-control form-control-sm d-none" type="text" name="placeholder[dial_code]"/>
			                            <select name="header[dial_code]">
			                            <?php
			                              /*echo '<option value="">Select</option>';
			                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

			                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
			                              }*/
			                            ?>
			                            </select>
			                        </div>
			                        <div class="col-4 col-sm-4 col-md-4 col-lg-6 col-xl-6 align-self-center">
			                            <input class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
			                        </div>
			                    </div>-->

			                    <div class="form-group row">
			                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right align-self-center">Location <span class="text-danger fw-bolder">*</span></label>
			                        <div class="col-8 col-sm-8 col-md-6 col-lg-8 col-xl-8 align-self-center">
			                            <div class="input-group input-group-sm aivw-withsel">
			                                <input class="form-control form-control-sm d-none" type="text" name="placeholder[location]"/>
			                                <select name="header[location]"></select>
			                            </div>
			                        </div><!--./col-10-->
			                    </div><!--./form-group-->


			                </div><!-- card-body -->
			            </div><!-- card -->

			            <!--<div class="card mb-3">
			            	<div class="card-header">
			                    <h4>Education</h4>
			                </div>
			            	<div class="card-body">
			            		<div id="education_content">
			                    </div>

			                    
			                    <div class="btn btn-group">
			                        <button name="btn_add_education" class="btn btn-sm btn-secondary" type="button">Add Education</button>
			                    </div>
			            	</div>
			            </div>

			            <div class="card mb-3">
			                <div class="card-header">
			                    <h4>Language</h4>
			                </div>

			                <div class="card-body">
			                    
			                    
			                    <div id="language_content">
			                        
			                    </div>

			                    
			                    <div class="btn btn-group">
			                        <button name="btn_add_language" class="btn btn-sm btn-secondary" type="button">Add Language</button>
			                    </div>


			                </div>
			            </div>-->


			            <!--<div class="card mb-3">
			                <div class="card-header">
			                    <h4>Job Preferences</h4>
			                </div>
			                <div class="card-body">
			                    <div class="row">
			                        <div class="col">
			                            Industry
			                        </div>
			                    </div>
			                    <div id="industry_content">
			                    </div>
			                    <div class="btn btn-group">
			                        <button name="btn_add_industry" class="btn btn-sm btn-secondary" type="button">Add Industry</button>
			                    </div>
			                    <hr/>
			                    <div class="row">
			                        <div class="col">
			                            Job Level
			                        </div>
			                    </div>

			                    <div id="job_level_content">
			                    </div>
			                    <div class="btn btn-group">
			                        <button name="btn_add_job_level" class="btn btn-sm btn-secondary" type="button">Add Job Level</button>
			                    </div>
			                    <hr/>

			                    <div class="row">
			                        <div class="col">
			                            Job Type
			                        </div>
			                    </div>
			                    <div id="job_type_content">
			                    </div>
			                    <div class="btn btn-group">
			                        <button name="btn_add_job_type" class="btn btn-sm btn-secondary" type="button">Add Job Type</button>
			                    </div>

			                    <hr/>

			                    <div class="row">
			                        <div class="col">
			                            Department
			                        </div>
			                    </div>

			                    <div id="department_content">
			                    </div>
			                    <div class="btn btn-group">
			                        <button name="btn_add_department" class="btn btn-sm btn-secondary" type="button">Add Department</button>
			                    </div>
			                </div>
			            </div>-->

			            <div id="error_cont">

        	
       					 </div>
	        		</form>
	        	</div>
	        </div>
        </div><!--./modal-body-->
        <div class="modal-footer">
        	<button class="btn btn-sm btn-primary btn_submit" type="button">Submit</button>
        </div><!--./modal-body-->
    </div>
  </div>
</div>
<!--Required Modal-->


<div class="modal fade" id="submitted_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
      <div class="modal-content">
        
        <div class="modal-body" id="submitted_modal_body">
        	<div class="row">
        		<div class="col text-center">
        			<h2 class="modal-title text-link">Would you like to...</h2>
        		</div>
        	</div>
        	<br/>
        	<div class="row">
        		<div class="col text-center">
        			<a href="job_search/private" class="btn btn-primary mr-5">Search for job</a> or <a href="applicant_info/edit/<?php echo $user_id?>" class="ml-5 btn btn-secondary">Update profile</a>
        		</div>
        	</div>
        </div>
      </div>
  </div>
</div>

<?php require_once('app/Views/libraries/footer-menu.php'); ?>

<?php require_once('app/Views/libraries/footer.php'); ?>
<!-- Footer Menu -->

<!-- multiselect dropdown -->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>


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



<script src="<?php echo base_url('assets/main/js/home.js?v='). date('Ymdi') ?>"></script>


