<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row">
	<div class="col">
		<h4 class="mb-5"><a style="text-decoration:none;" class="text-muted" href="<?php echo base_url('partner_application/') ?>">Manage Applicant Applications</a></h4>
	</div><!--./col-->
	<div class="col">
		<div class="text-right">
			<a href="<?php echo base_url('signup/') ?>" class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="education"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Applicant</a>	
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->

<div class="row">
	<div class="col">
		<div class="input-group mb-3">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Search (Company/Location/Industry)" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->

<div class="row">
	<div class="col">
		<h5>Search Result(s)</h5>
	</div><!--./col-->
	<div class="col-3">
		<div class="input-group mb-3">
			<select name="header[sort]" class="custom-select custom-select-sm" placeholder="Search" aria-label="Search">
				<option value = "">Sort By</option>
				<?php
				for ($i=0; $i <= count($status) -1; $i++) {
					if($status[$i]['id'] == 2){continue;}
					echo '<option value="'.$status[$i]['id'].'">'.$status[$i]['name'].'</option>';
				}//end for
				?>
			</select><!--./select-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->

<div class="row">
	<div class="col">
		<p><small class="text-muted pagination_result"></small></p>
	</div><!--./col-->
	
</div><!--./row-->


<div id="main_loader" class="row row-cols-2">
</div>



<div class="row mb-2">
	<div class="col">
		<small><b>APPLICATION DATE</b></small>
	</div><!--./col-->
	<div class="col">
		<small><b>EMAIL</b></small>
	</div><!--./col-->
	<div class="col">
		
	</div><!--./col-->
	
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

<script src="<?php echo base_url('assets/main/js/applicant_application.js?v='). date('Ymdi') ?>"></script>


