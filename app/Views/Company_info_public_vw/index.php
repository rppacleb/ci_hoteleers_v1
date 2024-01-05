<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var id                          = <?php echo !isset($id)? 0 : $id ?>;
var user_id                     = <?php echo !isset($_SESSION['userid'])? 0 : $_SESSION['userid']; ?>;
var employer_id                        = <?php echo !isset($_SESSION['employer'])? '""' : $_SESSION['employer']; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row">
	<div class="col">


    <p class="text-muted mb-5"><a class="text-link" href="#" onClick="history.back()">Back</a> / View Employer</p>
	</div><!--./col-->
	
	
</div><!--./row-->


<div class="row">
    
	<div class="col-xl-3 col-lg-3 col-md-3 col-auto">
		<div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:8rem;height:8rem;">
          <div class="media-body align-self-center">
            <h6 id="header[company_name]" class="mt-0" style="color: #545454;word-break:normal !important;"></h6>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <!-- <p id="header[date_created]"></p> -->
        <div>
            <!-- <h5 class="mt-4 mb-4 cipw-companyimglabel">Company Images</h5> -->

            <div id="image_cont" class="row row-cols-1"></div><!--./row--> 
        </div><!--./image-cont--> 
	</div>
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3" style="border-radius: 8px; padding-top: 1.5rem; padding-bottom: 1.5rem;">
                <div class="card-body">
                   

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Doc Content</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Doc Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Old Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Id</label>
                        <div class="col">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Company Name</span></label>
                        <div class="col-7 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[company_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">About</span></label>
                        <div class="col-7">
                            <textarea class="form-control form-control-sm cipvw-textarea" name="header[about]" maxlength="5000" /></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Website</span></label>
                        <div class="col-7 align-self-center">
                            <input value="" name="header[website]" type="text" class="form-control form-control-sm d-none" maxlength="500">
                            <div class="cipw-website"></div>
                        </div><!--./col-->
                    </div><!--./row-->


                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Tel. no.</span></label>
                        <div class="col-2 align-self-center">
                            <select class="custom-select custom-select-sm" name="header[dial_code]">
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4 align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                   
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Location</span></label>
                        <div class="col-7 align-self-center">
                            <div class="input-group input-group-sm cipvw-withsel">
                                <input class="form-control form-control-sm d-none" type="text" name="placeholder[location]"/>
                                <select name="header[location]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label text-right">Country</label>
                      <div class="col-7">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right align-self-center">Industry</span></label>
                        <div class="col-7 align-self-center">
                            <div class="input-group input-group-sm cipvw-withsel">
                                <input class="form-control form-control-sm d-none" type="text" name="placeholder[industry]"/>
                                <select name="header[industry]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    


                </div><!--./card-body-->
            </div><!--./card-->

            



            
            


            <div id="image_cont_form" class="row row-cols-1">
            </div>
        </form>

        <!-- Available Jobs Start-->
        <div>
            <h4 class="mt-4 mb-4">Available Jobs</h4>

            <div id="main_loader" class="row-cols-2"></div>
            <div id="main_container" class="row"></div>

            <div class="row mt-4">
                <!--pagination-->
                <div class="col">
                    <nav>
                        <ul class="pagination main_pagination justify-content-start" aria-type="main">
                        </ul>
                    </nav>
                </div><!--./col-->
                <!--pagination-->
                <div class="col-2"></div><!--./col-2-->
            </div><!--./row-->

        </div>
        <!-- Available Jobs End-->
        
	</div><!--./col-->
	
</div><!--./row-->


<!-- <div> -->
    <!-- <h4 class="mt-4 mb-4 cipw-companyimglabel">Company Images</h4> -->

    <!-- <div id="image_cont" class="row row-cols-4"></div> --><!--./row--> 
<!-- </div> --><!--./image-cont--> 




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

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/company_info_public_vw.js?v='). date('Ymdi') ?>"></script>



