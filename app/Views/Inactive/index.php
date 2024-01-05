<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row">
	<div class="col-xl-7 col-lg-7"></div>
	<div class="col-xl-5 col-lg-5">
		<div class="input-group input-group-lg mb-3">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Company Name / Location / Industry" aria-label="Search" aria-describedby="basic-addon2">
		  
		</div><!--./input-group-->
	</div><!--./col-->
</div><!--./row-->


<div class="row mb-5">
	<div class="col-xl-6 col-lg-6">
		<h4>Inactive</h4>
	</div><!--./col-->
	
</div><!--./row-->

<div id="inactive_loader" class="row row-cols-2">
</div>





<div class="row mb-2">
	<div class="col">
		<div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
			<div class="card-body" style="padding: 0rem 1rem;">
				<div class="row">
					<div class="col-3 text-left text-muted-header">
						COMPANY
					</div><!--./col-->

					<div class="col text-left text-muted-header">
						LOCATION
					</div><!--./col-->

					<div class="col text-left text-muted-header">
						INDUSTRY
					</div><!--./col-->
					
					<div class="col text-left text-muted-header">
						START DATE
					</div><!--./col-->

					<div class="col text-left text-muted-header">
						END DATE
					</div><!--./col-->

					<div class="text-muted-header text-center col-xl-1 col-lg-1 col-md-12 col-sm-12 col-xs-12 align-self-center" style="min-width:1in;">
						ACTION
					</div><!--./col-->
				</div>
			</div>
		</div>
	</div>
</div><!--./row-->

<div id="inactive_container">
</div>


<div class="row">
    <!--pagination-->
    <div class="col">
        <nav>
            <ul class="pagination inactive_pagination justify-content-start" aria-type="inactive">

            </ul>
        </nav>
    </div><!--./col-->
    <!--pagination-->
    <div class="col-2">
	</div><!--./col-2-->
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

<script src="<?php echo base_url('assets/main/js/inactive.js?v='). date('Ymdi') ?>"></script>


