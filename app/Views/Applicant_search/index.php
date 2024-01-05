<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var type                        = <?php echo !isset($type)? '""' : '"'.$type.'"' ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;


</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php require_once('app/Views/libraries/top-bar.php'); ?>


<div class="row mb-5">
    <div class="col-xl-6 col-lg-6">
        <h4>Talent Database</h4>
    </div>
</div>

<div class="row mb-3">
	
	<div class="col-xl-9 col-lg-9">

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                
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
                            <div class="col-1 text-muted-header" style="min-width:1in;">
                            APPLICANT
                            </div><!--./col-->

                            <div class="col-1 as-namespacer">

                            </div><!--./col-->

                            <div class="col text-left text-muted-header">
                              LOCATION
                            </div><!--./col-->

                            <div class="col text-left text-muted-header">
                              CURRENT JOB
                            </div><!--./col-->
                            
                            <div class="col text-left text-muted-header">
                              COMPANY
                            </div><!--./col-->

                            <div class="text-center col-xl-2 col-lg-2 align-self-center" style="min-width:1.6in;">
                              
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
                <input placeholder="Enter job title" class="form-control form-control-md" type="text" name="header[job_title]"/>
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="job_title_cont" class="row row-cols-1 mb-3">
            </div>

            
            <div class="form-group row">
              <div class="col">
                <div class="input-group input-group-md">
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
                <div class="input-group input-group-md">
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
                    <input placeholder="Enter skills" class="form-control form-control-md" type="text" name="header[skills]"/>
                </div>
              </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="skills_cont" class="row row-cols-1 mb-3">
            </div>

            
            <div class="form-group row">
                
                <div class="col">
                    <div class="input-group input-group-md">
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

        <div class="row mb-3">
            <div class="col d-flex justify-content-between">
                <a name="btn_clear_filter" href="#?" class="btn btn-secondary btn-md header-navbtn" style="padding-left: 0;">Clear Filter</a> 
                <button type="button" name="btn_filter" class="btn btn-primary btn-md filterbtn">Filter</button>
            </div>
        </div>

    </div><!--./col-3-->


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

<!--multiselect dropdown-->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>



<script src="<?php echo base_url('assets/main/js/applicant_search.js?v='). date('Ymdi') ?>"></script>


