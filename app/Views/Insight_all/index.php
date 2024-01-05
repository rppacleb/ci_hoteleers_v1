<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                 = <?php echo !isset($_SESSION['employer'])? 0 : $_SESSION['employer']; ?>;

var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
var view_type                   =<?php echo !isset($_GET['view_type'])? "''" : '"'.$_GET['view_type'].'"' ?>;
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

<?php require_once('app/Views/libraries/top-bar.php'); 
$view_type  = !isset($_GET['view_type'])? "" : $_GET['view_type'];
?>



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
 

 

    
?>



<div class="row mb-5">
  <p class="text-muted mb-4"><a class="text-link" href="#" onClick="history.back()">Back</a> / Insights</span></p>
  <div class="col">
      <h4><?php echo ucwords($view_type)?> Job Posted</h4>
  </div>
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

	</div><!--./col-->
</div><br/><!--./row-->
<!--jobs section-->


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
<script src="<?php echo base_url('assets/main/js/insight_all.js?v='). date('Ymdi') ?>"></script>


