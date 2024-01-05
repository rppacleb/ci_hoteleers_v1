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


		<h4 class="mb-5">
			<a style="text-decoration:none;" class="text-muted" href="<?php echo base_url('partner_application/') ?>">Manage Partner Applications</a>
			<a style="text-decoration:none;" class="text-muted" href="<?php echo base_url('partner_application/'.$type.'/'.$id.'') ?>">/ <?php echo $type;?></a>
		
		</h4>
	</div><!--./col-->
	<div class="col">
		<div class="text-right">
			
			<!--<button class="btn btn-pill-sm btn-pill-sm-outline-light mb-2 text-primary btn_submit" type="button" aria-type="Company">Submit</button>-->
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->


<div class="row">
	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
		
		
        <div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[company_name]" class="mt-0"></h6>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
	</div>
	<div class="col">

		<form id="frm_data_entry">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Id</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-sm mb-2" type="text" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Company Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[company_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Email</label>
                        <div class="col-7">
                              <input value="" Placeholder="Email" name="header[username]" type="text" class="form-control form-control-md" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Password</label>
                        <div class="col-7">
                            <div class="input-group">
                                <input value="" Placeholder="Password" name="header[password]" type="password" class="form-control form-control-md" maxlength="50">
                                <div class="input-group-append input-group-addon btn_show_pass" aria-type="password" data-toggle="tooltip" data-placement="bottom" title="Minimum 8 characters with upper case, lower case and number">
                                    <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                </div>
                            </div>
                        </div><!--./col-->
                    </div><!--./row-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Honorifics <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <select class="custom-select custom-select-md" name="header[honorifics]">
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">First Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Last Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Work Email <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input placeholder="email@email.com" class="form-control form-control-sm" type="text" name="header[work_email]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Contact Number <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-3">
                            <select class="custom-select custom-select-md" name="header[dial_code]">
                                <?php
                                    for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                        echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                                    }//end for
                                ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4">
                            <input placeholder="917XXXXXXX" class="form-control form-control-md" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Location <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[location]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    
                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label text-link text-right">Country</label>
                      <div class="col-7">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->


                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Designation <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[designation]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-link text-right">Industry <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-2 d-none">
                            <input readonly class="form-control form-control-md" type="text" name="header[industry]"/>
                        </div>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" id="header[industry_text]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                </div><!--./card-->
            </div><!--./card-body-->
            
        </form>
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

<script src="<?php echo base_url('assets/main/js/partner_application_vw.js?v='). date('Ymdi') ?>"></script>



