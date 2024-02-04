<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var side_menu                   = <?php echo !isset($_GET['side_menu'])? '""' : '"'.$_GET['side_menu'].'"'; ?>;
var employer                   = <?php echo !isset($_GET['employer'])? '""' : '"'.$_GET['employer'].'"'; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;

var is_archived                  = <?php echo !isset($_GET['is_archived'])? '""' : '"'.$_GET['is_archived'].'"'; ?>;
</script>

<?php
$employer_id    = !isset($_GET['employer'])? "" : $_GET['employer'];
$employer_data  = $employer[0];

$title_type = !isset($_GET['type'])? "" : $_GET['type'];
$side_menu = !isset($_GET['side_menu'])? "" : $_GET['side_menu'];
?>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row">
	<div class="col">


		<h4 class="mb-5">
		    <h4 class="mb-5"><?php echo $employer_data["company_name"]?> - User / <?php echo $type;?></h4>
		</h4>
	</div><!--./col-->
</div><!--./row-->


<div class="row">
	
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3">
                <div class="card-body mt-5 mb-5">
                    <div class="row">

                        <div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2 offset-md-2">
                    
                    
                            <div class="form-group row d-none">
                                <label class="col-3 col-form-label text-link text-right">Id</label>
                                <div class="col">
                                  <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                                </div>
                            </div>

                            <div class="form-group row d-none">
                                <label class="col-3 col-form-label text-link text-right">Employer</label>
                                <div class="col">
                                  <input readonly class="form-control form-control-md mb-2" type="text" name="header[employer]" value="<?php echo $employer_id;?>" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Prefix <span class="text-danger fw-bolder">*</span></label>
                                <div class="col">
                                    <select class="custom-select custom-select-md" name="header[honorifics]">
                                        <option disabled selected>Select</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                    </select>
                                </div><!--./col-10-->
                            </div><!--./form-group-->
                            
                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">First Name <span class="text-danger fw-bolder">*</span></label>
                                <div class="col">
                                    <input class="form-control form-control-md" type="text" name="header[first_name]" maxlength="100"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Last Name <span class="text-danger fw-bolder">*</span></label>
                                <div class="col">
                                    <input class="form-control form-control-md" type="text" name="header[last_name]" maxlength="100"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Email Address <span class="text-danger fw-bolder">*</span></label>
                                <div class="col">
                                    <input class="form-control form-control-md" type="text" name="header[email_add]" maxlength="100"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Title/Designation <span class="text-danger fw-bolder">*</span></label>
                                <div class="col">
                                      <input value="" name="header[designation]" type="text" class="form-control form-control-sm" maxlength="500">
                                </div><!--./col-->
                            </div><!--./row-->


                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Contact Number <span class="text-danger fw-bolder">*</span></label>
                                <div class="col-3">
                                    <select class="custom-select custom-select-md" name="header[dial_code]">
                                        <option disabled selected>Select</option>
                                    <?php
                                      for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                        echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                                      }//end for
                                    ?>
                                    </select>
                                </div><!--./col-10-->
                                <div class="col">
                                    <input class="form-control form-control-md" type="text" name="header[contact_number]" maxlength="20"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-3 col-form-label text-right">Default Password</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input readonly Placeholder="Auto Generated" name="header[password]" type="password" class="form-control form-control-md" maxlength="50">
                                        <div class="input-group-append input-group-addon btn_show_pass" aria-type="password" data-toggle="tooltip" data-placement="bottom" title="Minimum 8 characters with upper case, lower case and number">
                                          <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                        </div><!--./input-group-append-->
                                    </div><!--./input-group-->
                                </div><!--./col-->
                            </div><!--./row-->
                        </div>
                    </div>
                    

                </div><!--./card-body-->
            </div><!--./card-->

           
        </form><!--./form-->

        <div class="row">
            <div class="col">
                <div class="outside_button text-right">
                    

                    <a href="<?php echo base_url('user?employer='.$employer_id.'') ?>" class="text-primary mr-4 uvw-cancelbtn">Cancel</a> 
                    <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit">Save</button>
                </div><!--./text-right-->
            </div>
        </div>
	</div><!--./col-->
	
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

<script src="<?php echo base_url('assets/main/js/user_vw.js?v='). date('Ymdi') ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAGyohoEluWcR09ZROWb0cSHKa-QoqZmwM&libraries=places&callback=initMap"></script>


