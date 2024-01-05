<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                     = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;

var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">

<style type="text/css">
    .dot {
      height: 12px;
      width: 12px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
    }
</style>

<?php require_once('app/Views/libraries/top-bar.php'); ?>



<?php //require_once('app/Views/libraries/dashboard.php'); ?>

<?php
/*
<div class="row">
	<div class="col-8">	
		<div class="input-group mb-3">
		  <input name="header[keyword_active]" aria-type="active" type="text" class="form-control form-control-lg" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find" aria-type="active" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	<div class="col-2">
	</div><!--./col-->
</div><!--./row-->
*/
?>

<?php
 

    //active jobs
    $active_applicant_ctr                  = 0;
    $active_applicant_job_post_ctr         = 0;
    $active_applicant_short_listed_ctr     = 0;
    $active_applicant_for_interview_ctr    = 0;
    $active_applicant_offered_ctr          = 0;

    $active_hiring_speed_ctr                = 0;
    $hired_hiring_speed_ctr                 = 0;
    $deactivated_hiring_speed_ctr           = 0;

    $active_total_vacancies                 = 0;
    $hired_total_vacancies                  = 0;
    $deactivated_total_vacancies            = 0;

    $active_total_job_post_views            = 0;
    $hired_total_job_post_views             = 0;
    $deactivated_job_post_views             = 0;
    $deactivated_total_job_post_views       = 0;

    //get origin counter
    $active_origin_ctr                      = 0;
    $hired_origin_ctr                      = 0;

    if(isset($counter_origin_active)){
      foreach ($counter_origin_active as $key => $value) {
        $active_origin_ctr = $value['count'];
      }//end foreach
      // if ($active_origin_ctr == 0) {
      //   $active_origin_ctr = 0;
      // }
    }//end if

    if(isset($counter_origin_hired)){
      foreach ($counter_origin_hired as $key => $value) {
        $hired_origin_ctr = $value['count'];
      }//end foreach
      // if ($hired_origin_ctr == 0) {
      //   $hired_origin_ctr = 0;
      // }
    }//end if
    //end get origin counter

    if(isset($counter_data_active)){
        

        foreach ($counter_data_active as $key => $value) {
            if($value['counter_type'] == 'applicant'){
                $active_applicant_ctr                  = $value['counter'];
            }else if($value['counter_type'] == 'job_post'){
                $active_applicant_job_post_ctr         = $value['counter'];
            }else if($value['counter_type'] == 'short_listed'){
                $active_applicant_short_listed_ctr     = $value['counter'];

            }else if($value['counter_type'] == 'for_interview'){
                $active_applicant_for_interview_ctr     = $value['counter'];
            }else if($value['counter_type'] == 'offered'){
                $active_applicant_offered_ctr          = $value['counter'];
            }//end if
        }//end foreach

        foreach ($counter_hiring_speed as $key => $value) {
          if($value['counter_type'] == 'active'){
            if($value['total_hiring_speed'] !== null && $value['total_applicant_count'] !== null){
              $active_hiring_speed_ctr = ($value['total_hiring_speed']) / ($value['total_applicant_count']);
              $active_hiring_speed_ctr = round($active_hiring_speed_ctr);

              
            }//end if

            $active_total_vacancies = ($value['total_applicant_count'] == null? 0 : $value['total_applicant_count'])  . ' / ' .$value['total_vacancies'];
            // if ($active_total_vacancies = 0){
            //   $active_total_vacancies = "0";
            // }
            if($value['total_job_post_views'] !== null){
              $active_total_job_post_views = $value['total_job_post_views'];
            }//end if

          }//end if

          if($value['counter_type'] == 'hired'){
            if($value['total_hiring_speed'] !== null && $value['total_applicant_count'] !== null){
              
              $hired_hiring_speed_ctr = ($value['total_hiring_speed']) / ($value['total_applicant_count']);
              $hired_hiring_speed_ctr = round($hired_hiring_speed_ctr);


            }//end if
            $hired_total_vacancies = ($value['total_applicant_count'] == null? 0 : $value['total_applicant_count'])  . ' / ' .$value['total_vacancies'];
          
            if($value['total_job_post_views'] !== null){
              $hired_total_job_post_views = $value['total_job_post_views'];
            }//end if
          }//end if

          if($value['counter_type'] == 'deactivated'){
            if($value['total_hiring_speed'] !== null && $value['total_applicant_count'] !== null){
              
              $deactivated_hiring_speed_ctr = ($value['total_hiring_speed']) / ($value['total_applicant_count']);
              $deactivated_hiring_speed_ctr = round($deactivated_hiring_speed_ctr);
            }//end if
            $deactivated_total_vacancies = ($value['total_applicant_count'] == null? 0 : $value['total_applicant_count'])  . ' / ' .$value['total_vacancies'];
          
            if($value['total_job_post_views'] !== null){
              $deactivated_total_job_post_views = $value['total_job_post_views'];
            }//end if
          }//end if
        }//end foreach
       
    }//end if

    //closed jobs
    $closed_applicant_ctr                  = 0;
    $closed_applicant_job_post_ctr         = 0;
    $closed_applicant_short_listed_ctr     = 0;
    $closed_applicant_for_interview_ctr    = 0;
    $closed_applicant_offered_ctr          = 0;
    if(isset($counter_data_closed)){
        

        foreach ($counter_data_closed as $key => $value) {
            if($value['counter_type'] == 'applicant'){
                $closed_applicant_ctr                  = $value['counter'];
            }else if($value['counter_type'] == 'job_post'){
                $closed_applicant_job_post_ctr         = $value['counter'];
            }else if($value['counter_type'] == 'short_listed'){
                $closed_applicant_short_listed_ctr     = $value['counter'];

            }else if($value['counter_type'] == 'for_interview'){
                $closed_applicant_for_interview_ctr     = $value['counter'];
            }else if($value['counter_type'] == 'offered'){
                $closed_applicant_offered_ctr          = $value['counter'];
            }//end if
        }//end foreach
       
    }//end if


    //deactivated jobs
    $deactivated_applicant_ctr                  = 0;
    $deactivated_applicant_job_post_ctr         = 0;
    $deactivated_applicant_short_listed_ctr     = 0;
    $deactivated_applicant_for_interview_ctr    = 0;
    $deactivated_applicant_offered_ctr          = 0;
    if(isset($counter_data_deactivated)){
       
       
       foreach ($counter_data_deactivated as $key => $value) {
            if($value['counter_type'] == 'applicant'){
                $deactivated_applicant_ctr                  = $value['counter'];
            }else if($value['counter_type'] == 'job_post'){
                $deactivated_applicant_job_post_ctr         = $value['counter'];
            }else if($value['counter_type'] == 'short_listed'){
                $deactivated_applicant_short_listed_ctr     = $value['counter'];

            }else if($value['counter_type'] == 'for_interview'){
                $deactivated_applicant_for_interview_ctr     = $value['counter'];
            }else if($value['counter_type'] == 'offered'){
                $deactivated_applicant_offered_ctr          = $value['counter'];
            }//end if
        }//end foreach
    }//end if

    
?>



<div class="row mb-5">
    <div class="col">
        <h4>Active Job Posted</h4>
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-link"><?php echo $active_applicant_job_post_ctr; ?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">HIRED</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-link"><?php echo $active_total_vacancies?></h3>
          </div>
        </div>
    </div>



    

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">HIRING SPEED</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-link"><?php echo $active_hiring_speed_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST VIEWS</h6>
            <h3 id="insight_short_listed_counter" class="card-text text-left text-link"><?php echo $active_total_job_post_views?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">INTERVIEWS</h6>
            <h3 id="insight_interviews_counter" class="card-text text-left text-link"><?php echo $active_applicant_for_interview_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">OFFERED</h6>
            <h3 id="insight_offered_counter" class="card-text text-left text-link"><?php echo $active_applicant_offered_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">ORIGIN</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-link"><?php echo $active_origin_ctr?></h3>
          </div>
        </div>
    </div>



    <!-- <div class="col"></div> -->
</div>

<!--jobs section-->
<div class="row">
	<div class="col">
		<div class="row mb-3">
			<div class="col">
				<p><small class="text-muted pagination_result"></small></p>
			</div><!--./col-->
		</div><!--./row-->

		<div id="active_loader" class="row row-cols-2">
		</div>

    <div class="row mb-2">
      <div class="col">
        <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
          <div class="card-body" style="padding: 0rem 1rem;">
            <div class="row">
              <div class="col-1 text-center text-muted-header" style="max-width: 7.3%;">
                ID
              </div><!--./col-->
              <div class="col text-left text-muted-header" style="min-width:1in;">
                TITLE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                EXP. DATE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRED
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRING SPEED
              </div><!--./col-->

              <div class="col text-left text-muted-header">
                JOB POST VIEWS
              </div><!--./col-->
              
              <div class="col-xl-1 col-lg-1 text-center text-muted-header d-none" style="min-width:1.5in;">
                ORIGIN
              </div><!--./col-->
            </div>
          </div>
        </div>
      </div>
    </div><!--./row-->
		

		<div id="active_container">
		</div>


		<div class="row">
		    <!--pagination-->
		    <div class="col">
		        <nav>
		            <ul class="pagination active_pagination justify-content-start" aria-type="active">

		            </ul>
		        </nav>
		    </div><!--./col-->
		    <!--pagination-->
		    <div class="col-2">
                
			</div><!--./col-2-->
		</div><!--./row-->
    <div class="row">
      <div class="col">
        <p class="text-right"><a href="<?php echo base_url('insight_all?view_type=active') ?>" class="text-link">View All Active Job Post</a></p>
      </div><!--./col-->
    </div>

	</div><!--./col-->
</div><br/><!--./row-->
<!--jobs section-->
<?php
/*<div class="row">
	<div class="col-8">	
		<div class="input-group mb-3">
		  <input name="header[keyword_hired]" aria-type="hired" type="text" class="form-control form-control-lg" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find" aria-type="hired" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	<div class="col-2">
	</div><!--./col-->
</div><!--./row-->*/
?>

<div class="row mb-5">
    <div class="col">
        <h4>Hired Jobs</h4>
    </div>
</div>


<div class="row mb-3">
    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-primary"><?php echo $closed_applicant_job_post_ctr; ?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">HIRED</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-primary"><?php echo $hired_total_vacancies?></h3>
          </div>
        </div>
    </div>

   

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">HIRING SPEED</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-primary"><?php echo $hired_hiring_speed_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST VIEWS</h6>
            <h3 id="insight_short_listed_counter" class="card-text text-left text-primary"><?php echo $hired_total_job_post_views?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">INTERVIEWS</h6>
            <h3 id="insight_interviews_counter" class="card-text text-left text-primary"><?php echo $closed_applicant_for_interview_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">OFFERED</h6>
            <h3 id="insight_offered_counter" class="card-text text-left text-primary"><?php echo $closed_applicant_offered_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">ORIGIN</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-link"><?php echo $hired_origin_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col"></div>
</div>

<!--jobs section-->
<div class="row">
	<div class="col">
		<div class="row mb-3">
			<div class="col">
				<p><small class="text-muted pagination_result"></small></p>
			</div><!--./col-->
		</div><!--./row-->

		<div id="hired_loader" class="row row-cols-2">
		</div>

    <div class="row mb-2">
      <div class="col">
        <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
          <div class="card-body" style="padding: 0rem 1rem;">
            <div class="row">
              <div class="col-1 text-center text-muted-header" style="max-width: 7.3%;">
                ID
              </div><!--./col-->
              <div class="col text-left text-muted-header" style="min-width:1in;">
                TITLE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                EXP. DATE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRED
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRING SPEED
              </div><!--./col-->

              <div class="col text-left text-muted-header">
                JOB POST VIEWS
              </div><!--./col-->
              
              <div class="col-xl-1 col-lg-1 text-center text-muted-header d-none" style="min-width:1.5in;">
                ORIGIN
              </div><!--./col-->
            </div>
          </div>
        </div>
      </div>
    </div><!--./row-->


		

		<div id="hired_container">
		</div>


		<div class="row">
		    <!--pagination-->
		    <div class="col">
		        <nav>
		            <ul class="pagination hired_pagination justify-content-start" aria-type="hired">

		            </ul>
		        </nav>
		    </div><!--./col-->
		    <!--pagination-->
		    <div class="col-2">
                
			</div><!--./col-2-->
		</div><!--./row-->

    <div class="row">
      <div class="col">
        <p class="text-right"><a href="<?php echo base_url('insight_all?view_type=hired') ?>" class="text-link">View All Hired Jobs</a></p>
      </div><!--./col-->
    </div>


	</div><!--./col-->
</div><br/><!--./row-->
<!--jobs section-->


<?php
/*
<div class="row">
    <div class="col-8"> 
        <div class="input-group mb-3">
          <input name="header[keyword_deactivated]" aria-type="deactivated" type="text" class="form-control form-control-lg" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary btn_find" aria-type="deactivated" type="button">Find</button>
          </div><!--./input-group-append-->
        </div><!--./input-group-->
    </div><!--./col-->
    <div class="col-2">
    </div><!--./col-->
</div><!--./row-->
*/
?>



<div class="row mb-5">
    <div class="col">
        <h4>Deactivated Jobs</h4>
    </div>
</div>


<div class="row mb-3">
    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-primary"><?php echo $deactivated_applicant_job_post_ctr; ?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">HIRED</h6>
            <h3 id="insight_applicant_counter" class="card-text text-left text-primary"><?php echo $deactivated_total_vacancies?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">JOB POST VIEWS</h6>
            <h3 id="insight_short_listed_counter" class="card-text text-left text-primary"><?php echo $deactivated_total_job_post_views?></h3>
          </div>
        </div>
    </div>


   

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">INTERVIEWS</h6>
            <h3 id="insight_interviews_counter" class="card-text text-left text-primary"><?php echo $deactivated_applicant_for_interview_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-12 aj-countercol d-none" style="min-width:2in;">
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-title text-muted">OFFERED</h6>
            <h3 id="insight_offered_counter" class="card-text text-left text-primary"><?php echo $deactivated_applicant_offered_ctr?></h3>
          </div>
        </div>
    </div>

    <div class="col-1"></div>
</div>

<!--jobs section-->
<div class="row">
	<div class="col">
		<div class="row mb-3">
			<div class="col">
				<p><small class="text-muted pagination_result"></small></p>
			</div><!--./col-->
		</div><!--./row-->

		<div id="hired_loader" class="row row-cols-2">
		</div>

    <div class="row mb-2">
      <div class="col">
        <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
          <div class="card-body" style="padding: 0rem 1rem;">
            <div class="row">
              <div class="col-1 text-center text-muted-header" style="max-width: 7.3%;">
                ID
              </div><!--./col-->
              <div class="col text-left text-muted-header" style="min-width:1in;">
                TITLE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                EXP. DATE
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRED
              </div><!--./col-->
              <div class="col text-left text-muted-header">
                HIRING SPEED
              </div><!--./col-->

              <div class="col text-left text-muted-header">
                JOB POST VIEWS
              </div><!--./col-->
              
              <div class="col-xl-1 col-lg-1 text-center text-muted-header d-none" style="min-width:1.5in;">
                ORIGIN
              </div><!--./col-->
            </div>
          </div>
        </div>
      </div>
    </div><!--./row-->
		

		<div id="deactivated_container">
		</div>


		<div class="row">
		    <!--pagination-->
		    <div class="col">
		        <nav>
		            <ul class="pagination deactivated_pagination justify-content-start" aria-type="deactivated">

		            </ul>
		        </nav>
		    </div><!--./col-->
		    <!--pagination-->
		    <div class="col-2">
                
			</div><!--./col-2-->
		</div><!--./row-->

    <div class="row">
      <div class="col">
        <p class="text-right"><a href="<?php echo base_url('insight_all?view_type=deactivated ') ?>" class="text-link">View All Deactivated Jobs</a></p>
      </div><!--./col-->
    </div>
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

<div class="modal fade" id="pie_chart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pie_chart_modal_title">Origin</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="pie_chart_modal_body">
            <div class="row">
                <div class="col align-self-start">
                    <div id="myPlot" style="width:100%;height:100%;"></div>
                </div>
                <div class="col" id="myplot_legend">
                    <div class="row mb-2">
                      <div class="col">
                        <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
                          <div class="card-body" style="padding: 0rem 1rem;">
                            <div class="row">
                              <div class="col-1">
                            
                              </div><!--./col-->
      
                              <div class="col text-muted text-left">
                                  <small><b>Location</b></small>
                              </div><!--./col-->
      
                              <div class="col-3 text-muted text-center">
                                  <small><b>%</b></small>
                              </div><!--./col-->
                              <div class="col-3 text-muted text-center">
                                  <small><b>Count</b></small>
                              </div><!--./col--></div>
                          </div>
                        </div>
                      </div>
                        
                        
                    </div><!--./row-->
                    <div id="legend_container">
                    </div>

                    <div id="table_sort_div">
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </div>
</div>

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

<!--
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.load('current', { 'packages': ['table'] });
     google.charts.load('current', { 'packages': ['annotationchart'] });
</script>
<script src="<?php echo base_url('assets/main/js/insight.js?v='). date('Ymdi') ?>"></script>


