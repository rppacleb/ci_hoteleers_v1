<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var employer 					= <?php echo !isset($_GET['employer'])? "":$_GET['employer'] ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<?php
$employer_id 					= !isset($_GET['employer'])? "":$_GET['employer'];
?>

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
	<div class="col-xl-6 col-lg-6">
		<h4> 
			<a class=" text-link mr-3 h4" href="<?php echo base_url('employer/view/'.$_GET['employer'].'?side_menu=side_account_management_active&type=active') ?>">Back</a>
			<?php echo $employer[0]["company_name"] ?> / List of Users
		</h4>
	</div><!--./col-->
	<div class="col-xl-6 col-lg-6">
		<div class="text-right">
			<a href="<?php echo base_url('user/add/0?employer='.$_GET['employer'].'') ?>" class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add User</a>	
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->

<div class="row d-none">
	<div class="col">
		<div class="input-group input-group-md mb-3">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Search (Company/Location/Industry)" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn-md btn_find pr-4 pl-4 pt-3 pb-3" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->

<div class="row d-none">
	<div class="col">
		<h5>Search Result(s)</h5>
	</div><!--./col-->
	
	
</div><!--./row-->

<div class="row mb-3 d-none">
	<div class="col">
		<p><small class="text-muted pagination_result"></small></p>
	</div><!--./col-->
	
</div><!--./row-->


<div id="main_loader" class="row row-cols-2">
</div>



<div class="row mb-2 text-muted">
	<div class="col">
		<div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
			<div class="card-body" style="padding: 0rem 1rem;">
				<div class="row">
					<div class="col text-left text-muted-header">NAME
					</div><!--./col-->


					<div class="col text-left text-muted-header">DESIGNATION
					</div><!--./col-->


					<div class="col text-left text-muted-header" style="width:3.2in;">EMAIL
					</div><!--./col-->
					
					
					<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12" style="min-width:2in;">
						
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

<script src="<?php echo base_url('assets/main/js/user.js?v='). date('Ymdi') ?>"></script>


