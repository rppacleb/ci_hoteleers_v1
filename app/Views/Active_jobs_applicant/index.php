<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var mod_type                   = <?php echo !isset($_GET['mod_type'])? '""' : '"'.$_GET['mod_type'].'"'; ?>;
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;
var view_type                   = <?php echo !isset($_GET['view_type'])? '""' : '"'.$_GET['view_type'].'"'; ?>;
var job_post_id                 = <?php echo !isset($_GET['job_post'])? 0 : $_GET['job_post']; ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var job_title                   = <?php echo !isset($employer_data[0]['job_title'])? '""' : '"'.$employer_data[0]['job_title'].'"'; ?>;

var filter_data                 = <?php echo !isset($employer_data)? '{}' : json_encode($employer_data[0]) ?>;


</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">


<?php
    
    $job_post_id    = !isset($_GET['job_post'])? 0 : $_GET['job_post'];
    $status         = !isset($_GET['status'])? '' : $_GET['status'];

    $view_type = !isset($_GET['view_type']) ? '' : $_GET['view_type'];

    $view_post_url = base_url('job_post/view/'.$job_post_id.'?isActive=1');

    $applicant_leads_ctr            = 0;
    $applicant_ctr                  = 0;
    $applicant_short_listed_ctr     = 0;
    $applicant_for_interview_ctr    = 0;
    $applicant_offered_ctr          = 0;
    $applicant_hired_ctr            = 0;


   
   

    if(isset($counter_data)){
        $applicant_ctr                  = $counter_data[0]['counter'];
        $applicant_short_listed_ctr     = $counter_data[1]['counter'];
        $applicant_for_interview_ctr    = $counter_data[2]['counter'];

        $applicant_offered_ctr          = $counter_data[3]['counter'];
        $applicant_hired_ctr            = $counter_data[4]['counter'];
        $applicant_leads_ctr            = $counter_data[5]['counter'];
        //echo $counter_data_qrystr;
    }

    
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
    <div class="col-xl-6 col-lg-6">
    <span class="text-muted mb-4"><a class="text-link text-decoration-none" href="#" onClick="history.back()">Back</a> / </span>
        <a href=<?php echo $view_post_url ?>
         style="color:rgb(0, 41, 170);text-decoration: none;"
        >
          <!-- <h4 class="d-inline"> -->
            <?php echo !isset($employer_data[0]['job_title'])? "" : $employer_data[0]['job_title'];?>
          <!-- </h4> -->
        </a>

        <p class="d-none"><?php //echo $employer_data[0]['job_description']?></p>
        <p class="d-none"><?php echo $employer_data[0]['education_text']?></p>
        <p class="d-none"><?php //echo $employer_data[0]['qualification']?></p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-9 col-lg-9">
        <div class="row mb-3">
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if($view_type == 'leads'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">LEADS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=leads') ?>" style="text-decoration:none;"><h3 id="applicant_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_leads_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">LEADS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=leads') ?>" style="text-decoration:none;"><h3 id="applicant_counter" class="card-text text-left text-primary"><?php echo $applicant_leads_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if(!$view_type){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">APPLICANTS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'') ?>" style="text-decoration:none;"><h3 id="applicant_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">APPLICANTS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'') ?>" style="text-decoration:none;"><h3 id="applicant_counter" class="card-text text-left text-primary"><?php echo $applicant_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if($view_type == 'short_listed'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">SHORTLISTED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=short_listed') ?>" style="text-decoration:none;"><h3 id="short_listed_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_short_listed_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">SHORTLISTED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=short_listed') ?>" style="text-decoration:none;"><h3 id="short_listed_counter" class="card-text text-left text-primary"><?php echo $applicant_short_listed_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if($view_type == 'interviews'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">INTERVIEWS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=interviews') ?>" style="text-decoration:none;"><h3 id="interviews_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_for_interview_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">INTERVIEWS</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=interviews') ?>" style="text-decoration:none;"><h3 id="interviews_counter" class="card-text text-left text-primary"><?php echo $applicant_for_interview_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if($view_type == 'offered'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">OFFERED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=offered') ?>" style="text-decoration:none;"><h3 id="offered_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_offered_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">OFFERED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=offered') ?>" style="text-decoration:none;"><h3 id="offered_counter" class="card-text text-left text-primary"><?php echo $applicant_offered_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <?php if($view_type == 'hired'){?>
                <div class="card mb-3" style="opacity:0.8;background-color:rgb(0, 41, 170);">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted" style="color:white !important;">HIRED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=hired') ?>" style="text-decoration:none;"><h3 id="offered_counter" class="card-text text-left text-primary" style="color:white !important;"><?php echo $applicant_hired_ctr?></h3></a>
                  </div>
                </div>
              <?php }else{?>
                <div class="card mb-3">
                  <div class="card-body aja-cbcounter">
                    <h6 class="card-title text-muted">HIRED</h6>
                    <a href="<?php echo base_url('active_jobs_applicant?job_post='.$job_post_id.'&view_type=hired') ?>" style="text-decoration:none;"><h3 id="offered_counter" class="card-text text-left text-primary"><?php echo $applicant_hired_ctr?></h3></a>
                  </div>
                </div>
              <?php }?>
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
                    <div class="col">
                      <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
                        <div class="card-body" style="padding: 0rem 1rem;">
                          <div class="row">
                            <div class="col-auto text-muted-header">
                              APPLICANT
                            </div><!--./col-->

                            <div class="col-auto" style="min-width:1.7in;">
                            </div><!--./col-->

                            <div class="col-auto text-left text-muted-header">
                            LOCATION
                            </div><!--./col-->

                            <div class="col-auto text-left text-muted-header">
                            CURRENT JOB
                            </div><!--./col-->
                            
                            <div class="col-auto text-left text-muted-header">
                            COMPANY
                            </div><!--./col-->

                            

                            <div class="text-center col-auto align-self-center" style="min-width:1.6in;">
                              
                            </div><!--./col-->
                          </div>
                        </div>
                      </div>
                    </div>
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
                    <input placeholder="enter job title" class="form-control form-control-md" type="text" name="header[job_title]"/>
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
                        <div class="input-group input-group-md">
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
                        <input placeholder="enter skills" class="form-control" type="text" name="header[skills]"/>
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
            
            

        </div><!--./row-->



    
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

<script src="<?php echo base_url('assets/main/js/active_jobs_applicant.js?v='). date('Ymdi') ?>"></script>


