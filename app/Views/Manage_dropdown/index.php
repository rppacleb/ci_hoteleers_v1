<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/datatables.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
	

	<div class="row mb-5">
		<div class="col-xl-6 col-lg-6">
			<h4 class="">Manage Drop Down List</h4>
		</div>
	</div>

	<div class="container-fluid mb-5">

		<!--EDUCATION-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				<h6 class="card-title mt-5 text-right ">Education</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->

					
						<div id="education_loader" class="row row-cols-2">
						</div>

						<div id="education_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm education_pagination justify-content-end" aria-type="education">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->


					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						
						<form id="frm_education">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[education_name]"/>
						
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="education"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Education</button>	
						</div><!--./div-->
						
					</div>

				</div><!--./card-->
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="education">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END EDUCATION-->

		<!--JOB TYPE-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Job Type</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="job_type_loader" class="row row-cols-2">
						</div>

						<div id="job_type_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm job_type_pagination justify-content-end" aria-type="job_type">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_job_type">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[job_type_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="job_type"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Job Type</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="job_type">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END JOB TYPE-->

		<!--INDUSTRY-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Industry</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="industry_loader" class="row row-cols-2">
						</div>

						<div id="industry_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm industry_pagination justify-content-end" aria-type="industry">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_industry">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[industry_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="industry"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Industry</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="industry">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END INDUSTRY-->

		<!--DEPARTMENT-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Department</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="department_loader" class="row row-cols-2">
						</div>

						<div id="department_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm department_pagination justify-content-end" aria-type="department">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_department">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[department_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="department"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Department</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="department">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END DEPARTMENT-->


		<!--JOB LEVEL-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Job Level</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="job_level_loader" class="row row-cols-2">
						</div>

						<div id="job_level_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm job_level_pagination justify-content-end" aria-type="job_level">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_job_level">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[job_level_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="job_level"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Job Level</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="job_level">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END JOB LEVEL-->

		<!--LOCATION-->
		<div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Location</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="location_loader" class="row row-cols-2">
						</div>

						<div id="location_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm location_pagination justify-content-end" aria-type="location">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_location">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[location_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="location"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Location</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="location">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END LOCATION-->

		<!--PERKS AND BENEFITS-->
		<div class="row mb-5 ">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Perks & Benefits</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
						<div id="perks_and_benefits_loader" class="row row-cols-2">
						</div>

						<div id="perks_and_benefits_container" class="row row-cols-2 mb-5">
							
						</div><!--./row-->

						<div class="row">
			                <!--pagination-->
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm perks_and_benefits_pagination justify-content-end" aria-type="perks_and_benefits">

			                        </ul>
			                    </nav>
			                </div><!--./col-->
			                <!--pagination-->
			            </div><!--./row-->
					</div><!--./card-body-->
					<div class="card-footer bg-transparent">
						<form id="frm_perks_and_benefits">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form><!--./form-->
						<input maxlength="200"  placeholder="Name" class=" form-control form-control-md mb-2" type="text" name="header[perks_and_benefits_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="perks_and_benefits"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Perks & Benefits</button>	
						</div><!--./div-->
					</div><!--./card-footer-->
				</div><!--./card-->
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="perks_and_benefits">Save</button>	
				</div><!--./div-->
			</div><!--./col-->
		</div><!--./row-->
		<!--END PERKS AND BENEFITS-->

		<!--EMPLOYER POSITION-->
		<!-- <div class="row mb-5">
			<div class="col-xl-3 col-lg-3">
				
				<h6 class="card-title mt-5 text-right ">Employer Position</h6>
			</div>
			<div class="col">
				<div class="card shadow mb-2">
					<div class="card-body">
						<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
						<div id="employer_position_loader" class="row row-cols-2">
						</div>

						<div id="employer_position_container" class="row row-cols-2 mb-5">
							
						</div>./row

						<div class="row">
			                pagination
			                <div class="col">
			                    <nav aria-label="Page navigation example">
			                        <ul class="pagination pagination-sm employer_position_pagination justify-content-end" aria-type="employer_position">

			                        </ul>
			                    </nav>
			                </div>./col
			                pagination
			            </div>./row
					</div>./card-body
					<div class="card-footer bg-transparent">
						<form id="frm_employer_position">
				            <div class="row row-cols-2 mb-3">
							</div>
						</form>./form
						<input maxlength="200" placeholder="Name" class="form-control form-control-md mb-2" type="text" name="header[employer_position_name]"/>
						<div class="text-right">
							<button class="btn btn-pill-sm btn-pill-sm-outline-light text-primary btn_add_append" aria-type="employer_position"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employer Position</button>	
						</div>./div
					</div>./card-footer
				</div>./card
				
				<div class="text-right">
					<button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm" aria-type="employer_position">Save</button>	
				</div>./div
			</div>./col
		</div>./row
		END EMPLOYER POSITION -->

	</div><!--./mb-5-->
	
			


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







<script src="<?php echo base_url('assets/main/js/manage_dropdown.js?v='). date('Ymdi') ?>"></script>


