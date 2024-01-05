<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var title_type                   = <?php echo !isset($_GET['type'])? '""' : '"'.$_GET['type'].'"'; ?>;
var side_menu                   = <?php echo !isset($_GET['side_menu'])? '""' : '"'.$_GET['side_menu'].'"'; ?>;
var action                      = <?php echo !isset($_GET['action'])? '""' : '"'.$_GET['action'].'"'; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
var employer                    = <?php echo '"'.$id.'"'; ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

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
		<!--<div class="text-right">
			
			<button class="btn btn-pill-sm btn-pill-sm-outline-light mb-2 text-primary btn_submit" type="button" aria-type="Company">Submit</button>
		</div>-->

        

	</div><!--./col-->
	
</div><!--./row-->

<div class="row mb-3">
    <div class="col-xl-6 col-lg-6">
        <h4><?php echo $title_type?></h4>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="text-right outside_button">
            <a href="<?php echo base_url('user/add/0?employer='.$id.'&side_menu='.$side_menu.'') ?>" class="text-link mr-5 fw-bolder evw-adduser">Add User</a>   

            <?php if($type == 'view'){?>

                <a href="<?php echo base_url('employer/edit/'.$id.'?side_menu='.$side_menu.'&type='.$title_type.'') ?>" class="text-link mr-5 fw-bolder">Edit</a>
            <?php }else if($type == 'edit'){?>
                    <a href="#" class="text-link btn_submit fw-bolder" aria-type="Company">Save</a>
            <?php }//end if?>
           
            <?php if($type == 'view'){?>
                <a href="#" data-toggle="modal" data-target="#archived_modal" class="text-link fw-bolder" data-type="archive">Archived Users</a>
            <?php }//end if?>
            

        </div><!--./text-right-->
    </div><!--./col-->

</div>


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
            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3 edit_view">
                
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 align-self-center">
                            <h6>Contract Dates</h6>
                        </div><!--./col-->
                        <div class="col-xl-6 col-lg-6 text-right align-self-center">
                            <a href="#" class="text-primary mr-5 fw-bolder btn_pause" aria-type="pause">Pause</a>
                            <button aria-id="<?php echo $id;?>" aria-type="deactivate" type="button" class="btn btn-pill-sm-no-brdr btn-primary text-white btn_deactivate">Deactivate</button>
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

            <div class="card mb-3 disable_view">
                <div class="card-body">
                    <?php $class = "";
                        if($_SESSION['usertype'] == 'admin'){
                            $class = "d-none";
                        }//end if

                    ?>
                    <div class="form-group row to_hide <?php echo $class;?>">
                          <label class="col-3 col-form-label"><i data-toggle="tooltip" data-placement="top" title="(MAX 5MB) GIF | PNG | JPG | JPEG" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i></label>
                          <div class="col">
                            <input type='file' name='header[userfile][]' size='20' />
                            
                                <button name='btn_upload' type='button' class='btn btn-primary btn-sm'>Upload</button>
                                <button name='btn_remove' type='button' class='btn btn-danger btn-sm'>Remove</button>
                                
                          </div>
                    </div><!--./row-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Doc Content</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-md" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Doc Image</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-md" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Old Image</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-md" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Id</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-md mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Company Name <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[company_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">About </label>
                        <div class="col-7">
                            <textarea class="form-control form-control-md evw-textarea" name="header[about]" maxlength="5000" /></textarea>

                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Website </label>
                        <div class="col-7">
                              <input value="" name="header[website]" type="text" class="form-control form-control-md" maxlength="500">
                        </div><!--./col-->
                    </div><!--./row-->


                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Tel. no. </label>
                        <div class="col-2">
                            <select class="custom-select custom-select-md" name="header[dial_code]">
                                <option disabled selected>Select</option>
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4">
                            <input class="form-control form-control-md" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Location</label>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-sm d-none" type="text" name="placeholder[location]"/>
                                <select name="header[location]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    
                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label text-link text-right">Country</label>
                      <div class="col-7">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    
                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Industry</label>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[industry]"/>
                                <select name="header[industry]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3 edit_view">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6">
                            <h6>Contact Person</h6>
                        </div><!--./col-->
                        
                    </div><!--./row-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-link text-right">Signup ID <span class="text-danger fw-bolder">*</span></label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-md" type="text" name="signup[id]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Prefix <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-1 evw-prefixcol">
                            <select class="custom-select custom-select-md" name="signup[honorifics]">
                                <option disabled selected>Select</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">First Name <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="signup[first_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Last Name <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="signup[last_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Designation <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="signup[designation]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Work Email <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-7">
                            <input placeholder="email@email.com" class="form-control form-control-sm" type="text" name="signup[work_email]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Contact Number <span class="text-danger fw-bolder evw-asterisk">*</span></label>
                        <div class="col-2">
                            <select class="custom-select custom-select-md" name="signup[dial_code]">
                                <option disabled selected>Select</option>
                                <?php
                                    for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                        echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                                    }//end for
                                ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-5">
                            <input placeholder="917XXXXXXX" class="form-control form-control-md" type="text" name="signup[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                


                </div><!--./card-body-->
            </div><!--./card-->

            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3 edit_view">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Internal Notes</label>
                        <div class="col-9">
                            <textarea class="form-control form-control-md evw-textarea" name="header[other_notes]" maxlength="500" /></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                </div><!--./card-body-->
            </div><!--./card-->


            <div class="card mb-3 pt-3 pb-3 pl-3 pr-3 edit_view">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h6>Contract History</h6>
                        </div><!--./col-->
                    </div><!--./row-->

                    <div class="row">
                        <div class="col">
                            <div id="history_loader" class="row row-cols-2">
                            </div><!--./main_loader-->



                            <div class="row mb-2 text-muted">
                                <div class="col">
                                    <div class="row">
                                
                                        <div class="col text-left text-muted-header">
                                            START DATE
                                        </div><!--./col-->

                                        <div class="col text-left text-muted-header">
                                            END DATE
                                        </div><!--./col-->

                                        <div class="col text-left text-muted-header">
                                            STATUS
                                        </div><!--./col-->

                                        <div class="col text-left text-muted-header">
                                            DATE
                                        </div><!--./col-->
                                    </div>
                                </div>
                                    
                                
                                <!--.<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12" style="min-width:1in;">
                                    
                                </div>-->
                            </div><!--./row-->

                            <div id="history_container">
                            </div><!--./main_container-->

                            <div class="row">
                                <!--pagination-->
                                <div class="col">
                                    <nav>
                                        <ul class="pagination history_pagination justify-content-start" aria-type="history">

                                        </ul>
                                    </nav>
                                </div><!--./col-->
                                <!--pagination-->
                                <div class="col-2">
                                </div><!--./col-2-->
                            </div><!--./row-->
                        </div>
                    </div>

                </div><!--./card-body-->
            </div><!--./card-->


            
            



            <div class="form-group row to_hide <?php echo $class;?>">
                  <label class="col-3 col-form-label">
                    <i data-toggle="tooltip" data-placement="top" title="(MAX 40MB) GIF | PNG | JPG | JPEG" class="tooltip_icon fa fa-info-circle text-warning" aria-hidden="true"></i>
                     

                  </label>
                  <div class="col">
                    <input type='file' name='header[company_file][]' multiple size="20" />
                        <button name='btn_upload_multiple' type='button' class='btn btn-primary btn-sm'>Upload</button>
                        <button name='btn_remove_multiple' type='button' class='btn btn-danger btn-sm'>Remove</button>
                  </div><!--./col-->
                  
            </div><!--./row-->
            <div class="form-group row to_hide <?php echo $class;?>">
                <label class="col-3 col-form-label">Total Size(MB)</label>
                <div class="col">
                   <input readonly name="file[total_uploaded_file]" class="form-control-plaintext form-control-sm" />
                   <input readonly name="file[total_files]" class="form-control-plaintext form-control-sm d-none" />
                </div>
                
            </div>


            <div id="image_cont_form" class="row row-cols-1">
            </div>
        </form>

        <div class="row mb-5">
            <div class="col">
                <div class="text-right outside_button">
                    
                    <a href="<?php echo base_url('user/add/0?employer='.$id.'&side_menu='.$side_menu.'') ?>" class="text-link mr-5 fw-bolder evw-adduser">Add User</a>

                    <?php if($type == 'view'){?>

                        <a href="<?php echo base_url('employer/edit/'.$id.'?side_menu='.$side_menu.'') ?>" class="text-link mr-5 fw-bolder">Edit</a>
                    <?php }else if($type == 'edit'){?>
                            <a href="#" class="text-link btn_submit fw-bolder" aria-type="Company">Save</a>
                            
                        
                    <?php }//end if?>

                    
                    <?php if($type == 'view'){?>
                        <a href="#" data-toggle="modal" data-target="#archived_modal" class="text-link fw-bolder" data-type="archive">Archived Users</a>
                    <?php }//end if?>
                    
                </div><!--./text-right-->
            </div><!--./col-->
        </div>


        <?php //if($type == 'view' && $title_type !== 'Inactive'){?>
            <div class="row mb-5">
                <div class="col-xl-6 col-lg-6">
                    <h4>List of User(s)</h4>
                </div><!--./col-->
                

            </div>



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
            </div><!--./main_loader-->



            <div class="row mb-2">
                <div class="col">
                    <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
                        <div class="card-body" style="padding: 0rem 1rem;">
                            <div class="row">
                                <div class="col text-left text-muted-header align-self-center">
                                    NAME
                                </div><!--./col-->

                                <div class="col text-left text-muted-header align-self-center">
                                    DESIGNATION
                                </div><!--./col-->

                                <div class="col text-left text-muted-header align-self-center" style="min-width:3.14in;">
                                    EMAIL
                                </div><!--./col-->

                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 align-self-center" style="min-width:2in;">
                                </div><!--./col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--./row-->

            <div id="main_container">
            </div><!--./main_container-->

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
        <?php //}?>


        <?php if($type == 'view' && $title_type == 'Inactive'){?>
            
        <?php }?>

        
	</div><!--./col-->
	
</div><!--./row-->


<div class="<?php echo $class;?>">
    <h4 class="text-muted mb-3">Company Images</h4>

    <div id="image_cont" class="row row-cols-4">
        
    </div><!--./row--> 
</div><!--./image-cont--> 


<!--CONTENT END TAG-->			
		</div><!--./col content-->
	</div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->	

<?php require_once('app/Views/libraries/copyright.php'); ?>
  

<!-- Footer Menu -->
<?php require_once('app/Views/libraries/footer-menu.php'); ?>




<div class="modal fade" id="archived_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="archived_modal_title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="archived_modal_body">
            

            <div id="archived_loader" class="row row-cols-2">
            </div><!--./main_loader-->

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

            <div id="archived_container">
            </div><!--./main_container-->

            <div class="row">
                <!--pagination-->
                <div class="col">
                    <nav>
                        <ul class="pagination archived_pagination justify-content-start" aria-type="main">

                        </ul>
                    </nav>
                </div><!--./col-->
                <!--pagination-->
                <div class="col-2">
                </div><!--./col-2-->
            </div><!--./row-->
        
        </div><!--./modal-body-->
    </div><!--./modal-content-->
  </div><!--./modal-dialog-->
</div><!--./modal-->





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

<script src="<?php echo base_url('assets/main/js/employer_vw.js?v='). date('Ymdi') ?>"></script>



