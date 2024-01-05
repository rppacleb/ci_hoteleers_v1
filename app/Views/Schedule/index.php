<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                     = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;

var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>

<div class="row mb-5">
    <div class="col-xl-6 col-lg-6">
        <h4>Manage Scheduled Interviews</h4>
    </div>
</div>

<div class="row">
	
	<div class="col-xl-7 col-lg-7">
		
		<div class="input-group input-group-md mb-3 align-self-center">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Applicant Name" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find btn-md pr-4 pl-4 pt-3 pb-3" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->


	</div><!--./col-->
	<div class="col-xl-5 col-lg-5 offset-xl-0 offset-lg-0 align-self-center">
		<div class="form-group row">
            <label class="col-4 col-form-label fw-bolder text-muted text-right align-self-center" style="min-width: 1.3in;">Search by date</label>
            <div class="col align-self-center">
                <div class="input-group input-group-md">
                    <input class="form-control" type="text" name="header[date_filter]"/>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div><!--./input-group-append-->
                </div><!--./input-group input-group-sm-->
            </div><!--./col-->
        </div><!--./form-group-->
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
                            <div class="col-1 text-muted-header text-center" style="min-width:0.8in; padding-left:0; padding-right:0;">
                                APPLICANT
                            </div><!--./col-->

                            <div class="col text-left" style="min-width:1in;">
                                
                            </div><!--./col-->
                            <div class="col text-muted-header text-left"">
                                DATE OF INTERVIEW
                            </div><!--./col-->
                            <div class="col text-muted-header text-left"">
                                TIME
                            </div><!--./col-->
                            <div class="col text-muted-header text-left"">
                                APPLIED FOR
                            </div><!--./col-->
                            
                            <div class="col-xl-2 col-lg-2 text-muted" style="min-width:2in;">
                                
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

<script src="<?php echo base_url('assets/main/js/schedule.js?v='). date('Ymdi') ?>"></script>


