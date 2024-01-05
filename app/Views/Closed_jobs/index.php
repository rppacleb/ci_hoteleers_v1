<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                     = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;

var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<?php
   

    
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



<?php //require_once('app/Views/libraries/dashboard.php'); ?>

<div class="row mb-5">
    <div class="col">
        <h4>Hired Jobs Posts</h4>
    </div>
</div>


<div class="row mb-3">
    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST</h6>
            <a href="<?php echo base_url('closed_jobs') ?>" style="text-decoration:none;">
                <h3 id="applicant_counter" class="card-text text-left text-primary"><?php echo $applicant_job_post_ctr; ?></h3>
            </a>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">APPLICANTS</h6>
            <a href="<?php echo base_url('all_jobs_applicant?status=closed') ?>" style="text-decoration:none;">
                <h3 id="applicant_counter" class="card-text text-left text-primary"><?php echo $applicant_ctr?></h3>
            </a>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">SHORTLISTED</h6>
            <a href="<?php echo base_url('all_jobs_applicant?view_type=short_listed&status=closed') ?>" style="text-decoration:none;">
                <h3 id="short_listed_counter" class="card-text text-left text-primary"><?php echo $applicant_short_listed_ctr?></h3>
            </a>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">INTERVIEWS</h6>
            <a href="<?php echo base_url('all_jobs_applicant?view_type=interviews&status=closed') ?>" style="text-decoration:none;">
                <h3 id="interviews_counter" class="card-text text-left text-primary"><?php echo $applicant_for_interview_ctr?></h3>
            </a>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">OFFERED</h6>
            <a href="<?php echo base_url('all_jobs_applicant?view_type=offered&status=closed') ?>" style="text-decoration:none;">
                <h3 id="offered_counter" class="card-text text-left text-primary"><?php echo $applicant_offered_ctr?></h3>
            </a>
          </div>
        </div>
    </div>

    <div class="col"></div>

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
              <div class="card-body" style="padding: 0rem 1rem;">
                <div class="row">
                  <div class="col-1 text-left text-muted-header" style="min-width:0.5in;">
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
                  <div class="col-xl-2 col-lg-2" style="min-width:1.5in;">
                      
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

<script src="<?php echo base_url('assets/main/js/closed_jobs.js?v='). date('Ymdi') ?>"></script>


