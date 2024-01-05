<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var search_str                  = <?php echo !isset($_GET['search_str'])? '""' : '"'.$_GET['search_str'].'"'; ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var type                        = <?php echo '"'.$type.'"' ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<style type="text/css">
    .card {
      flex-direction: row;
      align-items: center;
      height:100%;
    }
    .card-body {

    }
    .card-title {
      font-weight: bold;
    }
    .card img {
      width: 30%;
      height:100%;
      

      
      border-top-right-radius: 0;
      border-bottom-left-radius: calc(0.25rem - 1px);
    }

    @media only screen and (max-width: 480px) {
        a {
            display: inline-block !important;
        }
        .card {
            flex-direction: column !important;
            align-items: initial !important; 
            height:100%;
        }

        .card img {
            width: 100% !important;
            height:100%;            
            border-top-right-radius: 0;
            border-bottom-left-radius: calc(0.25rem - 1px);
        }
    }

    @media only screen and (max-width: 768px) {
      a {
        display: none;
      }
      .card-body {
        padding: 0.5em 1.2em;
      }
      .card-body .card-text {
        margin: 0;
      }
      .card img {
        width: 50%;

      }
    }
    @media only screen and (max-width: 1200px) {
      .card img {
        width: 40%;

      }
    }
</style>

<?php require_once('app/Views/libraries/top-bar.php'); ?>

<div class="row mb-5 mobile-jssearchrow">
	<div class="col-xl-3 col-lg-3 desktop-tjspacer">
	</div><!--./col-->

	<div class="col-xl-7 col-lg-7 col-md-11 col-xs-11 offset-xl-0 offset-lg-0 offset-md-1 offset-sm-1">
		
        <h6 class="display-6 text-center mb-4" style="font-size: 1.9rem;">Find a career you'll love</h6>
		<div class="input-group input-group-md mb-3">
		  <input name="header[keyword]" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <button class="btn btn-primary btn-md btn_find pr-4 pl-4 pt-3 pb-3" type="button">Find Jobs</button>
		  </div><!--./input-group-append-->
		</div><!--./input-group-->
	</div><!--./col-->
	
</div><!--./row-->



<!--jobs section-->
<div class="row mobile-jsjobsrow">
	<div class="col-xl-1 col-xl-1 desktop-tjspacer2">
		
	</div><!--./col-->
	<div class="col-xl-2 col-lg-2 col-md-11 col-xs-11 offset-xl-0 offset-lg-0 offset-md-1 offset-sm-1">
		
    <div class="row mb-2 desktop-refine">
        <div class="col">
            <h6>Refine Search</h6>
        </div>
           
    </div>

        <div class="row mb-2 d-flex mobile-refine">
            <div class="col-6 align-self-center">
                <a href="#" class="mobile-refinebtn" data-toggle="modal" data-target="#refineSearchModal" role="button"><h6>Refine Search</h6></a>
                <!-- <a href="#" class="mobile-refinebtn"><h6>Refine Search</h6></a> -->
            </div>
            <div class="col-6 mobile-jsSort">
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
            </div><!--./col-->
           
        </div>

        <hr/>
            

            <form id="frm_data_entry" class="desktop-form">
                
                <div class="form-group row">
                    
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <select id="header[location]" multiple="multiple">
                            </select>
                        </div>
                    </div><!--./col-10-->
                </div><!--./form-group-->

                    

                <div class="form-group row d-none">
                    
                    <div class="col">
                        <textarea readonly class="form-control form-control-sm" name="header[location]"></textarea>
                    </div><!--./col-10-->
                </div><!--./form-group-->

                <div id="location_cont" class="row row-cols-1 mb-3">
                </div>

                

                
                <div class="form-group row">
                    <div class="col-1 d-none">
                       
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            

                            <select id="header[job_level]" multiple="multiple" placeholder="text">
                                
                            </select>
                            
                        </div><!--./input-group input-group-sm-->
                    </div><!--./col-10-->
                </div><!--./form-group-->
                <div id="job_level_cont" class="row row-cols-1 mb-3">
                </div>


                
                <div class="form-group row">
                    <div class="col-1 d-none">
                        
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            

                            <select id="header[job_type]" multiple="multiple">
                                
                            </select>
                           
                        </div><!--./input-group input-group-sm-->
                    </div><!--./col-10-->
                </div><!--./form-group-->

                <div id="job_type_cont" class="row row-cols-1 mb-3">
                </div>

                

                <div class="form-group row">
                    <div class="col-1 d-none">
                        
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <select id="header[education]">
                                
                            </select>
                            
                        </div><!--./input-group input-group-sm-->
                    </div><!--./col-10-->
                </div><!--./form-group-->

                <div id="education_cont" class="row row-cols-1 mb-3">
                </div>

                

                <div class="form-group row">
                    <div class="col-1 d-none">
                        
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <select id="header[industry]" multiple="multiple">
                                
                            </select>
                            
                        </div><!--./input-group input-group-sm-->
                    </div><!--./col-10-->
                </div><!--./form-group-->

                <div id="industry_cont" class="row row-cols-1 mb-3">
                </div>

                
                <div class="form-group row">
                    <div class="col-1 d-none">
                        
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <select id="header[department]" multiple="multiple">
                                
                            </select>
                            
                        </div><!--./input-group input-group-sm-->
                    </div><!--./col-10-->
                </div><!--./form-group-->

                <div id="department_cont" class="row row-cols-1 mb-3">
                </div>
            </form>

            
            <hr/>

        <div class="row mb-2 desktop-form">
            
            <div class="col d-flex justify-content-between">
                <a name="btn_clear_filter" href="#?" class="btn btn-secondary btn-md header-navbtn" style="padding-left: 0;">Clear Filter</a>
                <button type="button" name="btn_filter" class="btn btn-primary btn-md filterbtn">Filter</button> 
            </div>
        
        </div>
            		
	</div><!--./col-->

	<div class="col-xl-9 col-lg-9 col-md-11 col-xs-11 offset-xl-0 offset-lg-0 offset-md-1 offset-sm-1">

		<div class="row">
			<div class="col">
				<p><small class="text-muted pagination_result"></small></p>
			</div><!--./col-->
			<div class="col-3">
                <div class="input-group mb-3 align-self-end desktop-jsSort">
                    <select name="header[sort]" class="custom-select" placeholder="Search" aria-label="Search">
                        
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
            </div><!--./col-->


		<div id="main_loader" class="row-cols-2">

		</div>

		

		<div id="main_container">
		</div>


		<div class="row mt-4 mobile-pagination">
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
       
        <br/>
	</div><!--./col-->

	
</div><!--./row-->
<!--jobs section-->

<div class="modal fade" id="refineSearchModal" tabindex="-1" role="dialog" aria-labelledby="refineSearchModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title align-self-start" id="refineSearchModalTitle">Refine Search</h5>
        <button type="button" class="close align-self-start" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 24px;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_data_entry">
                
            <div class="form-group row">
                
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[location]" multiple="multiple">
                        </select>
                    </div>
                </div><!--./col-10-->
            </div><!--./form-group-->

                

            <div class="form-group row d-none">
                
                <div class="col">
                    <textarea readonly class="form-control form-control-sm" name="header[location]"></textarea>
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="location_cont" class="row row-cols-1 mb-3">
            </div>

            

            
            <div class="form-group row">
                <div class="col-1 d-none">
                    
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        

                        <select id="header[job_level]" multiple="multiple" placeholder="text">
                            
                        </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->
            <div id="job_level_cont" class="row row-cols-1 mb-3">
            </div>


            
            <div class="form-group row">
                <div class="col-1 d-none">
                    
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        

                        <select id="header[job_type]" multiple="multiple">
                            
                        </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="job_type_cont" class="row row-cols-1 mb-3">
            </div>

            

            <div class="form-group row">
                <div class="col-1 d-none">
                    
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[education]" multiple="multiple">
                            
                        </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="education_cont" class="row row-cols-1 mb-3">
            </div>

            

            <div class="form-group row">
                <div class="col-1 d-none">
                    
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[industry]" multiple="multiple">
                            
                        </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="industry_cont" class="row row-cols-1 mb-3">
            </div>

            
            <div class="form-group row">
                <div class="col-1 d-none">
                    
                </div>
                <div class="col">
                    <div class="input-group input-group-sm">
                        <select id="header[department]" multiple="multiple">
                            
                        </select>
                        
                    </div><!--./input-group input-group-sm-->
                </div><!--./col-10-->
            </div><!--./form-group-->

            <div id="department_cont" class="row row-cols-1">
            </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" name="btn_filter" class="btn btn-primary btn-md filterbtn" data-dismiss="modal">Filter</button> 
      </div>
    </div>
  </div>
</div>


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


<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/more_related_jobs.js?v='). date('Ymdi') ?>"></script>


