<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var side_menu                   = <?php echo !isset($_GET['side_menu'])? '""' : '"'.$_GET['side_menu'].'"'; ?>;
var title_type                   = <?php echo !isset($_GET['type'])? '""' : '"'.$_GET['type'].'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
	<div class="col">


		<h6 class="text-muted fw-bolder">
            <?php 
                $side_menu = !isset($_GET['side_menu'])? "" : $_GET['side_menu'];
                if($side_menu == "side_account_management" || $side_menu == ""){
            ?>
                    <a class="text-link mr-3" href="<?php echo base_url('account_management/') ?>">Back</a>
            <?php
                }else if($side_menu == "side_account_management_prospect"){
            
                    echo '<a class="text-link mr-3" href="'.base_url('prospect/').'">Back</a>';
    
                
                }else if($side_menu == "side_account_management_active"){
                    echo '<a class="text-link mr-3" href="'.base_url('active/').'">Back</a>';
                }else if($side_menu == "side_account_management_inactive"){
                    echo '<a class="text-link mr-3" href="'.base_url('inactive/').'">Back</a>';
                }else if($side_menu == "side_account_management_paused"){
                    echo '<a class="text-link mr-3" href="'.base_url('paused/').'">Back</a>';
                }
            ?>

            <?php
                $title_type = !isset($_GET['type'])? '' : $_GET['type'];
                $title_type = ucwords($title_type);
            ?>
			
            <span class="mr-3">/</span> <?php echo $title_type?>: <span class="company_name_breadcrumbs"></span>
		
		</h6>
	</div><!--./col-->
	<div class="col">
		<div class="text-right">
			
			<!--<button class="btn btn-pill-sm btn-pill-sm-outline-light mb-2 text-primary btn_submit" type="button" aria-type="Company">Submit</button>-->
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->


<div class="row mb-3">
    <div class="col-xl-6 col-lg-6">
        <h4><?php echo $title_type?></h4>
    </div><!--./col-->
</div><!--./row-->

<div class="row">
	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
		
		
        <div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[company_name]" class="mt-0 text-break"></h6>
            <p id="header[location]"></p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
	</div>
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3">
                
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-8 col-lg-8">
                            <h6>Contract Dates</h6>
                        </div><!--./col-->
                        <div class="col-xl-4 col-lg-4 text-right">
                            
                            <button aria-id="<?php echo $id;?>" aria-type="2" type="button" class="btn btn-pill-sm-no-brdr btn-primary text-white btn_submit">Activate</button>
                        </div>
                    </div><!--./row-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Start Date</label>
                        <div class="col-4">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[start_date]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-->

                        <div class="col-3">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[start_time]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-->

                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">End Date</label>
                        <div class="col-4">
                            <div class="input-group input-group-md date">
                                <input class="form-control form-control-md" type="text" name="header[end_date]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-10-->

                        <div class="col-3">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md" type="text" name="header[end_time]"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                </div><!--./input-group-append-->
                            </div><!--./input-group input-group-sm-->
                        </div><!--./col-->
                    </div><!--./form-group-->


                </div><!--./card-body-->
            </div><!--./card-->

            <div id="edit_view" class="card pt-3 pb-3 pl-3 pr-3 mb-3">
                <div class="card-body">
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label">Id</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-sm mb-2" type="text" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Prefix <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-1" style="width: 9.333333%;">
                            <select class="custom-select custom-select-md" name="header[honorifics]">
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">First Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Last Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Designation <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[designation]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Work Email <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input placeholder="email@email.com" class="form-control form-control-sm" type="text" name="header[work_email]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Contact Number <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-2">
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
                        <label class="col-3 col-form-label text-right">Company Name <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[company_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Email</label>
                        <div class="col-7">
                              <input value="" Placeholder="Email" name="header[username]" type="text" class="form-control form-control-md" maxlength="100">
                        </div><!--./col-->
                    </div><!--./row-->
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Password</label>
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
                        <label class="col-3 col-form-label text-right">Location <span class="text-danger fw-bolder">*</span></label>
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
                      <label class="col-3 col-form-label text-right">Country</label>
                      <div class="col-7">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->


                    

                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Industry <span class="text-danger fw-bolder">*</span></label>
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


            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Internal Notes</label>
                        <div class="col-9">
                            <textarea class="form-control form-control-md amvw-textarea" name="header[other_notes]" maxlength="500"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                </div><!--./card-body-->
            </div><!--./card-->

            
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

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/account_management_vw.js?v='). date('Ymdi') ?>"></script>



