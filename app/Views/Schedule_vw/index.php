<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var id                          = <?php echo $id; ?>;
var user_id                     = <?php echo !isset($_GET['user_id'])? '""' : $_GET['user_id']; ?>;
var job_post_id                 = <?php echo !isset($_GET['job_post'])? '""' : $_GET['job_post']; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php
$user_id    = !isset($_GET['user_id'])? "" : $_GET['user_id'];
$job_post_id    = !isset($_GET['job_post'])? "" : $_GET['job_post'];
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row">
	<div class="col mb-5">
		<h4 class="schedvw-header">
			Schedule Interview
		</h4>
	</div><!--./col-->
	<div class="col">
        <div class="outside_button text-right">
            <a href="<?php echo base_url('applicant_search/view/applied/'.$user_id.'?job_post='.$job_post_id.'&mod_type=') ?>" class="text-primary mr-4 sched-backbtn">Cancel</a>  
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" aria-type="Company">Save</button>
        </div><!--./text-right-->
	</div><!--./col-->
</div><!--./row-->


<div class="row">
	
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3">
                <div class="card-header bg-transparent border-0" >
                    <div class="row justify-content-end">
                        <div class="col-auto" id="status">
                            <!--Status DOM-->
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-5">
                    
                    

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right align-self-center">Type</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" name="placeholder[type]" value="<?php echo $type;?>" />
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right align-self-center">Id</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" aria-applicant="<?php echo $id;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right align-self-center">Job Post ID</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" value="<?php echo $job_post_id;?>" name="header[job_post_id]"/>
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right align-self-center">User ID</label>
                        <div class="col align-self-center">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[user_id]" value="<?php echo $user_id;?>" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Interview Date <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <div class="input-group input-group-md">
                                <input class="form-control d-none" type="text" name="placeholder[interview_date]"/>

                                <input class="form-control" type="text" name="header[interview_date]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Start Time <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[interview_start_time]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">End Time <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[interview_end_time]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Applicant Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <input readonly class="form-control-md form-control-plaintext" type="text" name="placeholder[applicant_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label text-right align-self-center">Applicant Email <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <input readonly class="form-control-md form-control-plaintext" type="text" name="placeholder[applicant_email]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-4 col-form-label text-right align-self-center">Company <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <input readonly class="form-control-md form-control-plaintext" type="text" name="placeholder[company_name]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Recruiter Email Address <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                              <input value="<?php echo $_SESSION['username'];?>" readonly name="placeholder[rec_email_add]" type="text" class="form-control-plaintext form-control-md" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Applying for <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                              <input readonly name="placeholder[job_title]" type="text" class="form-control-plaintext form-control-md" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->


                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Interviewer Name / Position</label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                              <input name="header[interviewer_name_position]" type="text" class="form-control form-control-sm" maxlength="500">
                        </div><!--./col-->
                    </div><!--./row-->


                    

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Interview Type <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <select class="custom-select custom-select-md" name="header[interview_type]">
                                <option value="face_to_face">In Person</option>
                                <option value="virtual">Virtual</option>
                                <option value="phone">Phone</option>
                            </select>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row virtual d-none">
                        <label class="col-4 col-form-label text-right align-self-center">Virtual Interviewer Link <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                              <input name="header[virtual_interview_link]" type="text" class="form-control form-control-md" maxlength="500">
                        </div><!--./col-->
                    </div><!--./row-->


                    <div class="form-group row face_to_face">
                        <label class="col-4 col-form-labe text-right align-self-center">Location</label>
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <div class="input-group input-group-md">
                                
                                <input name="header[location]" class="form-control form-control-md" >
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->



                    
                    
                    <div class="form-group row d-none">
                      <label class="col-4 col-form-label text-right align-self-center">Country</label>
                      <div class="col-xl-6 col-lg-6 align-self-center">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->






                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right">Message to candidate</label>
                        <div class="col-xl-6 col-lg-6">
                              <textarea name="header[notes_to_interviewee]" type="text" class="form-control form-control-md schedvw-textarea" maxlength="5000"></textarea>
                        </div><!--./col-->
                    </div><!--./row-->

                    <div class="form-group row">
                        <label class="col-4 col-form-label text-right align-self-center">Applicant Response</label>
                        <div class="col align-self-center">
                            <h4 name="placeholder[notif_status]"></h4>
                        </div>
                        <div class="col-auto btn-group">
                            <button type="button" class="d-none show_on_view btn btn-sm btn-success btn_accept_dec2" aria-status="accept">Accept</button>
                            <button type="button" class="d-none show_on_view btn btn-sm btn-danger btn_accept_dec2" aria-status="decline">Decline</button>
              
                        </div>
                    </div>
                    
                   
                </div><!--./card-body-->
            </div><!--./card-->

            



            
        </form>

        <div class="row">
            <div class="col">
                <div class="outside_button text-right">
                    <a href="<?php echo base_url('applicant_search/view/applied/'.$user_id.'?job_post='.$job_post_id.'&mod_type=') ?>" class="text-primary mr-4 sched-backbtn">Cancel</a>  
                    <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit">Save</button>
                </div><!--./text-right-->
            </div>
        </div>
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

<script src="<?php echo base_url('assets/main/js/schedule_vw.js?v='). date('Ymdi') ?>"></script>



