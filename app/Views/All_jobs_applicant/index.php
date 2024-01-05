<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;
var view_type                   = <?php echo !isset($_GET['view_type'])? '""' : '"'.$_GET['view_type'].'"'; ?>;
var job_post_id                 = <?php echo !isset($_GET['job_post'])? 0 : $_GET['job_post']; ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var status                      = <?php echo !isset($_GET['status'])? '""' : '"'.$_GET['status'].'"'; ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">


<?php
    $job_post_id    = !isset($_GET['job_post'])? 0 : $_GET['job_post'];
    $status         = !isset($_GET['status'])? '' : $_GET['status'];
    
    $view_type = !isset($_GET['view_type']) ? '' : $_GET['view_type'];

    $applicant_ctr                  = 0;
    $applicant_job_post_ctr            = 0;

    $applicant_short_listed_ctr     = 0;
    $applicant_for_interview_ctr    = 0;
    $applicant_offered_ctr          = 0;
    $applicant_hired_ctr            = 0;



    if(isset($counter_data)){
        foreach ($counter_data as $key => $value) {
            if($value['counter_type'] == 'applicant'){
                $applicant_ctr                  = $value['counter'];
            }else if($value['counter_type'] == 'job_post'){
                $applicant_job_post_ctr         = $value['counter'];
            }else if($value['counter_type'] == 'short_listed'){
                $applicant_short_listed_ctr     = $value['counter'];

            }else if($value['counter_type'] == 'for_interview'){
                $applicant_for_interview_ctr     = $value['counter'];
            }else if($value['counter_type'] == 'offered'){
                $applicant_offered_ctr          = $value['counter'];
            }//end if
        }//end foreach
       
    }

    
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<!-- <div class="row mb-4">
    <div class="col">
        <h4 class="ajj-title">Active Jobs - Applicants</h4>
    </div>
</div> -->

<!-- <div class="row mb-3">
    <div class="col">
        <h5 class="card-title"><?php echo !isset($employer_data[0]['job_title'])? "" : $employer_data[0]['job_title'];?></h5>
    </div>
</div> -->

<div class="row mb-3">
    <div class="col-xl-9 col-lg-9">
        <div class="row mb-3">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aja-analytics" style="min-width:1.75in;">
                <div class="card mb-3">
                  <div class="card-body">
                    <h6 class="card-title text-muted">TOTAL</h6>
                    <h6 class="card-title text-muted">JOB POSTS</h6>
                    <?php if($status == 'closed'){?>
                        <a href="<?php echo base_url('closed_jobs') ?>" style="text-decoration:none;">
                    <?php }else if($status == 'deactivated'){?>
                        <a href="<?php echo base_url('deactivated_jobs') ?>" style="text-decoration:none;">
                    <?php }else{?>
                        <a href="<?php echo base_url('active_jobs') ?>" style="text-decoration:none;">
                    <?php }?>
                    
                        <h3 id="applicant_counter" class="card-text text-left text-primary">
                            <?php echo $applicant_job_post_ctr; ?>
                            
                        </h3>
                    </a>
                  </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aja-analytics" style="min-width:1.75in;">
            <?php if(!$view_type){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body">
                    <h6 class="card-title text-muted" style="color:white !important;">TOTAL</h6>
                    <h6 class="card-title text-muted" style="color:white !important;">APPLICANTS</h6>
            <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body">
                    <h6 class="card-title text-muted">TOTAL</h6>
                    <h6 class="card-title text-muted">APPLICANTS</h6>
            <?php }?>
                    <?php if($status == 'closed'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?status=closed') ?>" style="text-decoration:none;">
                    <?php }else if($status == 'deactivated'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?status=deactivated') ?>" style="text-decoration:none;">
                    <?php }else{?>
                        <a href="<?php echo base_url('all_jobs_applicant') ?>" style="text-decoration:none;">
                    <?php }?>
                    <?php if(!$view_type){?>
                        <h3 id="applicant_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_ctr?></h3>
                    <?php }else{?>
                        <h3 id="applicant_counter" class="card-text text-left text-primary"><?php echo $applicant_ctr?></h3>
                    <?php }?>
                    </a>
                  </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aja-analytics" style="min-width:1.75in;">
            <?php if($view_type == 'short_listed'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body">
                    <h6 class="card-title text-muted" style="color:white !important;">TOTAL</h6>
                    <h6 class="card-title text-muted" style="color:white !important;">SHORTLISTED</h6>
            <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body">
                    <h6 class="card-title text-muted">TOTAL</h6>
                    <h6 class="card-title text-muted">SHORTLISTED</h6>
            <?php }?>
                    <?php if($status == 'closed'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=short_listed&status=closed') ?>" style="text-decoration:none;">
                    <?php }else if($status == 'deactivated'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=short_listed&status=deactivated') ?>" style="text-decoration:none;">
                    <?php }else{?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=short_listed') ?>" style="text-decoration:none;">
                    <?php }?>
                    <?php if($view_type == 'short_listed'){?>
                        <h3 id="short_listed_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_short_listed_ctr?></h3>
                    <?php }else{?>
                        <h3 id="short_listed_counter" class="card-text text-left text-primary"><?php echo $applicant_short_listed_ctr?></h3>
                    <?php }?>
                    </a>
                  </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aja-analytics" style="min-width:1.75in;">
            <?php if($view_type == 'interviews'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body">
                    <h6 class="card-title text-muted" style="color:white !important;">TOTAL</h6>
                    <h6 class="card-title text-muted" style="color:white !important;">INTERVIEWS</h6>
            <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body">
                    <h6 class="card-title text-muted">TOTAL</h6>
                    <h6 class="card-title text-muted">INTERVIEWS</h6>
            <?php }?>
                    <?php if($status == 'closed'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=interviews&status=closed') ?>" style="text-decoration:none;">
                    <?php }else if($status == 'deactivated'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=interviews&status=deactivated') ?>" style="text-decoration:none;">
                    <?php }else{?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=interviews') ?>" style="text-decoration:none;">
                    <?php }?>

                        <?php if($view_type == 'interviews'){?>
                            <h3 id="interviews_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_for_interview_ctr?></h3>
                        <?php }else{?>
                            <h3 id="interviews_counter" class="card-text text-left text-primary"><?php echo $applicant_for_interview_ctr?></h3>
                        <?php }?>
                    </a>
                  </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aja-analytics" style="min-width:1.75in;">
            <?php if($view_type == 'offered'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body">
                    <h6 class="card-title text-muted" style="color:white !important;">TOTAL</h6>
                    <h6 class="card-title text-muted" style="color:white !important;">OFFERED</h6>
            <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body">
                    <h6 class="card-title text-muted">TOTAL</h6>
                    <h6 class="card-title text-muted">OFFERED</h6>
            <?php }?>
                    <?php if($status == 'closed'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=offered&status=closed') ?>" style="text-decoration:none;">
                    <?php }else if($status == 'deactivated'){?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=offered&status=deactivated') ?>" style="text-decoration:none;">
                    <?php }else{?>
                        <a href="<?php echo base_url('all_jobs_applicant?view_type=offered') ?>" style="text-decoration:none;">
                    <?php }?>
                    <?php if($view_type == 'offered'){?>
                        <h3 id="offered_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_offered_ctr?></h3>
                    <?php }else{?>
                        <h3 id="offered_counter" class="card-text text-left text-primary"><?php echo $applicant_offered_ctr?></h3>
                    <?php }?>
                    </a>
                  </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-9 col-lg-9">
                
                <div class="input-group input-group-md mb-3">
                  <input name="header[keyword]" type="text" class="form-control" placeholder="Applicant Name / Current Job / Company Name" aria-label="Search" aria-describedby="basic-addon2">
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
                    <div class="col-1 text-muted-header" style="min-width:0.8in; padding-left: 1.7rem;">
                    APPLICANT
                    </div><!--./col-->
                    <div class="col" style="min-width:1in;">

                    </div><!--./col-->
                    <div class="col text-muted-header" style="padding-left: 1rem;">
                    LOCATION
                    </div><!--./col-->
                    <div class="col text-muted-header" style="padding-left: 0.1rem;">
                    CURRENT JOB
                    </div><!--./col-->
                    <div class="col text-muted-header" style="padding-left: 0rem;">
                    COMPANY
                    </div><!--./col-->
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 text-muted" style="min-width:1.6in;">
                    </div><!--./col-->
                </div><!--./row-->
                

                <div id="main_container">
                </div>


                <div class="row mt-4">
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

    </div><!--./col-9-->
    <div class="col-lg-3 col-xl-3">
        <div class="row mb-2">
            <div class="col">
                <h6>Filter Search</h6>
            </div>
           
        </div>


        <hr/>


        

        <form id="frm_data_entry">
            <div class="form-group row">
              <div class="col">
                <input placeholder="Enter job title" class="form-control form-control-md" type="text" name="header[job_title]"/>
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="job_title_cont" class="row row-cols-1 mb-3">
            </div>

            
            <div class="form-group row">
              <div class="col">
                <div class="input-group input-group-sm">
                    <select id="header[years]" multiple="multiple">
                    </select>
                </div>
                    
                    
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="years_cont" class="row row-cols-1 mb-3">
            </div>

           
            <div class="form-group row">
                <div class="col-1 d-none">
                   
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[education]" multiple="multiple">
                         </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="education_cont" class="row row-cols-1 mb-3">
            </div>

           
            <div class="form-group row">
              <div class="col">
                <div class="input-group input-group-sm">
                    <select id="header[language]" multiple="multiple">
                    </select>
                </div>
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="language_cont" class="row row-cols-1 mb-3">
            </div>

           
            <div class="form-group row">
              <div class="col">
                <div class="input-group input-group-md">
                    <input placeholder="Enter skills" class="form-control" type="text" name="header[skills]"/>
                </div>
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="skills_cont" class="row row-cols-1 mb-3">
            </div>

            
            <div class="form-group row">
                
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[location]" multiple="multiple">
                        </select>
                    </div>
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="location_cont" class="row row-cols-1 mb-3">
            </div>

            <div class="form-group row justify-content-center">
                <div class="col">
                    <label for="filter_intern">Internship</label>
                </div>
                <div class="col">
                    <input id="filter_intern" name="filter_intern" type="checkbox">
                </div>
                <div class="col">
                    <label for="filter_invited">Invited</label>
                </div>

                <div class="col">
                    <input id="filter_invited" name="filter_invited" type="checkbox">
                </div>
            </div>

            
        </form>

        <hr/>

            <div class="row mb-2">
            
              <div class="col d-flex justify-content-between">
                <a name="btn_clear_filter" href="#?" class="btn btn-secondary header-navbtn" style="padding-left: 0;">Clear Filter</a>
                <button type="button" name="btn_filter" class="btn btn-primary filterbtn">Filter</button>
              </div>

             </div>

    </div><!--./col-3-->





</div>













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

<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/all_jobs_applicant.js?v='). date('Ymdi') ?>"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAGyohoEluWcR09ZROWb0cSHKa-QoqZmwM&libraries=places&callback=initMap"></script>-->

