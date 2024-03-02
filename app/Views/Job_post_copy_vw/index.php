<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
//get employer details
var employer_default        = {};
    employer_default        = <?php echo json_encode($employer_default[0]); ?>;
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer'] ?>;
var user_id                 = <?php echo !isset($_SESSION['userid'])? "" : $_SESSION['userid'] ?>;
var employer                    = <?php echo json_encode($employer); ?>;
var isActive                = <?php echo !isset($_GET['isActive'])? 0 : $_GET['isActive'] ?>;
var perks_and_benefits          = <?php echo json_encode($perks_and_benefits); ?>;
var isActive                = <?php echo !isset($_GET['isActive'])? 0 : $_GET['isActive'] ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>

<?php

$isActive = !isset($_GET['isActive'])? 0 : $_GET['isActive'];
?>



<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5 to_hide">
    <div class="col-1"></div>
	<div class="col">


		<h4>Create A Job Post
		</h4>
	</div><!--./col-->
	<div class="col">

		<div class="outside_button text-right">
           
			<a href="<?php echo base_url('job_post/') ?>" class="text-primary mr-4 d-none">See List</a>
            <?php if($type == 'view'){?>
                <a href="<?php echo base_url('job_post_copy/edit/'.$id.'') ?>" class="btn mr-4 btn-pill-sm btn-pill-sm-outline-light text-primary btn_edit">Edit</a>
            <?php } ?>
            <?php if($type == 'add'){?>
                <button class="btn mr-4 btn-pill-sm btn-pill-sm-outline-light text-primary btn_draft">Save as Draft</button>
            <?php } ?>
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Publish</button>
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->


<div class="row">
    <div class="col-1"></div>
	<div class="col-xl-3 col-lg-3">
		<div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[company_name]" class="mt-0" style="word-break:break-word !important;"></h6>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
	</div>
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3 pt-5 pb-5">
                <div class="card-body">
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Type</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-md mb-2" type="text" aria-type="<?php echo $type;?>" name="placeholder[type]" value="<?php echo $type;?>" />
                          <input readonly class="form-control form-control-md mb-2" type="text" name="placeholder[isActive]" value="<?php echo $isActive;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Id</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-md mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Inactive</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-md mb-2" type="text" name="header[inactive]" value="0" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Job Title <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <input class="form-control form-control-md" type="text" name="header[job_title]" maxlength="200"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Department <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[department]"/>
                                <select name="header[department]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Industry <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[industry]"/>
                                <select name="header[industry]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Job Level <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[job_level]"/>
                                <select name="header[job_level]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Job Type <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[job_type]"/>
                                <select name="header[job_type]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Education <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[education]"/>
                                <select name="header[education]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    
                    <div class="form-group row d-none">
                      <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Country</label>
                      <div class="col-xl-9 col-lg-9 col-md-9 col">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->

                   <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Location <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[location]"/>
                                <select name="header[location]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Job Description <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col jd-textarea" name="placeholder[job_description]">
                            <textarea rows="5" class="form-control form-control-md texteditor" name="header[job_description]" maxlength="100000" /></textarea>
                            
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Qualifications <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col qualification-textarea" name="placeholder[qualification]">
                            <textarea rows="5" class="form-control form-control-md texteditor" name="header[qualification]" maxlength="100000" /></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    

                    <div class="form-group row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-5 align-self-start text-right">
                            <label class="col-form-label">Salary </label>
                        </div>

                        <div class="col-xl-9 col-lg-9 col-md-9 col align-self-center text-right">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-12 mb-3">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-md d-none" type="text" name="placeholder[salary_type]"/>
                                        <select name="header[salary_type]" class="custom-select form-control-sm">
                                            <option value="">-- Select Salary Type --</option>
                                            <option value="monthly">Per month</option>
                                            <option value="annually">Annual</option>
                                        </select>
                                    </div>
                                </div><!--./col-10-->

                                <div class="col-xl-3 col-lg-3 col-md-3 col-12 mb-3">
                                    
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-md d-none" type="text" name="placeholder[salary_currency]"/>
                                        <select name="header[salary_currency]" class="jpvw-select"></select>
                                    </div>
                                    
                                </div><!--./col-10-->

                                <div class="col-xl-3 col-lg-3 col-md-3 col-12 mb-3">
                                    <input placeholder="From" class="form-control form-control-sm" type="text" name="header[salary_from]" maxlength="20"/>
                                </div><!--./col-10-->

                                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                                    <input placeholder="To" class="form-control form-control-sm" type="text" name="header[salary_to]" maxlength="20"/>
                                </div><!--./col-10-->
                            </div>
                        </div>

                        
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Perks & Benefits</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col">
                           <div class="row" name="perks_and_benefits">
                           </div><!--./row-->
                        </div><!--./col-10-->
                        
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right"></div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col align-self-center">
                            <button data-toggle="modal" data-target="#add_new_modal" data-title="Perks & Benefits" data-id="0" data-type="perks_and_benefits" type="button" title="Add Perks & Benefits" class="btn btn-pill-sm btn-pill-sm-outline-light">
                                <i class="fa fa-plus-circle"></i> Add New Perks & Benefits
                            </button>
                        </div>
                    </div>


                    


                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right align-self-start">Job Expiration</label>
                        <!-- <div class="col-xl-9 col-lg-9 col-md-9 col">
                            <div class="custom-control custom-radio">
                              <input type="radio" id="customRadio1" name="placeholder[customRadio]" class="custom-control-input" value="30">
                              <label class="custom-control-label" for="customRadio1">30 days</label>
                            </div>

                            <div class="custom-control custom-radio">
                              <input type="radio" id="customRadio2" name="placeholder[customRadio]" class="custom-control-input" value="60">
                              <label class="custom-control-label" for="customRadio2">60 days</label>
                            </div>

                            <div class="custom-control custom-radio">
                              <input type="radio" id="customRadio3" name="placeholder[customRadio]" class="custom-control-input" value="90">
                              <label class="custom-control-label" for="customRadio3">90 days</label>
                            </div>

                            <div class="custom-control custom-radio">
                              <input type="radio" id="customRadio4" name="placeholder[customRadio]" class="custom-control-input" value="120">
                              <label class="custom-control-label" for="customRadio4">120 days</label>
                            </div>
                        </div> -->
                        
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right align-self-center">Start Date<span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-5 align-self-center pr-0" style="min-width: 10rem; max-width: 10rem">
                            <div class="input-group input-group-md date">
                                <input class="form-control form-control-md pr-1" type="text" name="header[job_start_date]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right align-self-center">End Date<span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-5 pr-0" style="min-width: 10rem; max-width: 10rem">
                            <div class="input-group input-group-md date">
                                <input class="form-control form-control-md pr-1" value="3/3/2023" type="text" name="header[job_expiration_date]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-5 col-form-label text-right">Vacancies <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-5 pr-0" style="min-width: 10rem; max-width: 10rem">
                            <input class="form-control form-control-md" type="text" name="header[vacancies]" maxlength="3"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                </div><!--./card-body-->
            </div><!--./card-->

            



            
        </form>

        
	</div><!--./col-->
	
</div><!--./row-->



<div class="row mb-2 to_hide">
    <div class="col">
        <div class="outside_button text-right">
            <a href="<?php echo base_url('company_info/view/'.$_SESSION['employer'].'') ?>" class="text-primary mr-4 d-none">See List</a> 
           
            <?php if($type == 'view'){?>
                <a href="<?php echo base_url('job_post_copy/edit/'.$id.'') ?>" class="btn mr-4 btn-pill-sm btn-pill-sm-outline-light text-primary btn_edit">Edit</a>
            <?php } ?>
            <?php if($type == 'add'){?>
                <button class="btn mr-4 btn-pill-sm btn-pill-sm-outline-light text-primary btn_draft" type="button">Save as Draft</button>
            <?php } ?>
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

<!--multiselect dropdown-->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/job_post_copy_vw.js?v='). date('Ymdi') ?>"></script>



