<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>

<div class="row mb-4">
	<div class="col-xl-3 col-lg-3 desktop-tjspacer">
	</div><!--./col-->
	<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-xs-12">
		
		 <h6 class="display-6 text-center" style="font-size: 1.9rem;">Trending Jobs</h6>

		
	</div><!--./col-->
	
</div><!--./row-->

<!--filter section-->
<div class="row mb-5">
	<div class="col-xl-1 col-lg-1">
	</div><!--./col-->
	<div class="col-xl-9 col-lg-9">
	</div><!--./col-->
	<div class="col text-right align-self-start">
		<!-- <a href="job_search/private">View all jobs</a> -->
	</div><!--./col-2-->
	
</div><!--./row-->
<!--end filter section-->

<!--jobs section-->
<div class="row">
	<div class="col-lg-1 desktop-tjspacer2">
		
	</div><!--./col-->
	

	<div class="col-lg-11">
		<div class="col text-right align-self-start mb-5 p-0">
            <a href="job_search/private">View all jobs</a>
		</div><!--./col-->

		<div class="row d-none">
			<div class="col">
				<p><small class="text-muted pagination_result"></small></p>
			</div><!--./col-->
			<div class="col-3">
				<div class="input-group mb-3">
					<select name="header[sort]" class="custom-select" placeholder="Search" aria-label="Search">
						<option value = "">All</option>
                        <?php
                            if(isset($_SESSION['usertype'])){
                                $user_type = $_SESSION['usertype'];
                            } else {
                                $user_type = '';
                            }
                            if($user_type != 'employer'&&$user_type != ''){
                        ?>
		                    <option value = "best_match">Best Match</option>
		                <?php }?>
						<option value = "ending_soonest">Ending Soonest</option>
		                <option value = "newly_listed">Newly Listed</option>
					</select><!--./select-->
				</div><!--./input-group-->
			</div>
		</div><!--./row-->


		<div id="main_loader" class="row row-cols-2">
		</div>

		

		<div id="main_container" class="row row-cols-xl-4 row-cols-lg-4">
		</div>


		<div class="row mt-4 mobile-pagination">
		    <!--pagination-->
		    <div class="col">
		        <nav class="d-none">
		            <ul class="pagination main_pagination justify-content-start" aria-type="main">

		            </ul>
		        </nav>
		    </div><!--./col-->
		    <!--pagination-->
		    <div class="col text-right align-self-start">
                <a href="job_search/private">View all jobs</a>
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

<script src="<?php echo base_url('assets/main/js/trending_jobs.js?v='). date('Ymdi') ?>"></script>


