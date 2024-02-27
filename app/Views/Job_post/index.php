<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var employer_id 				= <?php echo $employer_id ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
	<div class="col">
		<h4>Drafts</h4>
		<span class="text-muted">Unpinned drafts will expire after 7 days</span>
	</div><!--./col-->
	<div class="col">
		<div class="text-right">
			<a href="<?php echo base_url('job_post/add/0?isActive=1') ?>" class="btn btn-sm btn-pill-sm-no-brdr btn-primary btn_add_append" aria-type="education"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create Job Post</a>	
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->



<div class="row">
	<div class="col-xl-8 col-lg-8">
		
		<div class="input-group input-group-md mb-3">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Job Title / Location" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn_find btn-md pr-4 pl-4 pt-3 pb-3" type="button">Find</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
</div><!--./row-->

<div class="row">
<!--
	<div class="col">
		<h5>Search Result(s)</h5>
	</div>./col
-->
	<div class="col-3 mb-2">
		<div class="input-group input-group-md">
			<select name="header[sort]" class="custom-select custom-select-md" placeholder="Search" aria-label="Search">
				<option value = "">Show All</option>
				<option value = "0">Show Published</option>
				<option value = "1">Show Unpublished</option>
				
			</select><!--./select-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->

<!--
<div class="row mb-3">
	<div class="col">
		<p><small class="text-muted pagination_result"></small></p>
	</div>
</div>
-->


<div id="main_loader" class="row row-cols-2">
</div>



<div class="row mb-2">
	<div class="col">
		<div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
			<div class="card-body" style="padding: 0rem 1rem;">
				<div class="row">
					<div class="col text-muted-header">
						TITLE
					</div><!--./col-->
					<div class="col text-muted-header">
						COMPANY
					</div><!--./col-->
					<div class="col text-muted-header">
						LOCATION
					</div><!--./col-->
					<!-- <div class="col text-muted-header">
						INDUSTRY
					</div> -->
					<div class="col text-left text-muted-header">
						DATE SAVED
					</div><!--./col-->
					<div class="col-xl-2 col-lg-2" style="min-width:2.2in;">
						
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

<script src="<?php echo base_url('assets/main/js/job_post.js?v='). date('Ymdi') ?>"></script>


