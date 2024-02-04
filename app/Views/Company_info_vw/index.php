<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var employer_id                        = <?php echo !isset($_SESSION['employer'])? "" : $_SESSION['employer']; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
	<div class="col">
		
	</div><!--./col-->
	<div class="col">

		<div class="outside_button text-right">
            <?php if($type == 'edit'){?>
                <a href="<?php echo base_url('company_info/view/'.$_SESSION['employer'].'') ?>" class="text-primary mr-4">Cancel</a> 
                <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Submit</button>
                
            <?php }?>
			<?php if($type == 'view'){?>
                    <a href="<?php echo base_url('company_info/edit/'.$_SESSION['employer'].'') ?>" class="btn btn-sm mr-4 btn-pill-sm-no-brdr btn-primary btn_edit">Edit</a>
            <?php }?>
		</div><!--./text-right-->
	</div><!--./col-->
	
</div><!--./row-->


<div class="row">
	<div class="col-xl-3 col-lg-3">
		<div class="media">
          <div class="container2" >
                
                <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
                <!-- <label for="file-upload" class="custom-file-upload text-primary tooltip_icon" data-toggle="tooltip" data-placement="bottom" title="(MAX 5MB) GIF | PNG | JPG | JPEG"><i class="fas fa-upload"></i></label>
                <label class="custom-file-upload2 text-danger" ><i class="fas fa-times"></i></label> -->
               
          </div>
          
          <div class="media-body">
            <h6 id="header[company_name]" class="mt-0 civw-headers" style="word-break:break-word !important"></h6>
            <p id="header[location]" class="civw-headers"></p>
            <label for="file-upload"><p class="text-link mb-0 custom-file-upload"><i class="fa fa-pencil mr-2"></i> Display Company <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Photo</p></label>
            <p class="custom-file-upload2" style="color: #6c757d;"><i class="fa fa-trash mr-2"></i> Delete</p>
          </div>
        </div>
        <hr/>
        <p id="header[date_created]"></p>
	</div>
	<div class="col">

		<form id="frm_data_entry">
            <div class="card mb-3 pt-5 pb-5">
                <div class="card-body">
                    <?php $class = "";
                        if($_SESSION['usertype'] == 'admin'){
                            $class = "d-none";
                        }//end if

                    ?>
                    <div class="form-group row to_hide <?php echo $class;?>">
                          <label class="col-3 col-form-label text-right"></label>

                          

                          <div class="col d-none">
                            
                                <input id="file-upload" type='file' name='header[userfile][]' size='20' />
                            
                                <button name='btn_upload' type='button' class='btn btn-primary btn-sm'>Upload</button>
                                <button name='btn_remove' type='button' class='btn btn-danger btn-sm'>Remove</button>
                                
                          </div>
                    </div><!--./row-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Doc Content</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Doc Image</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Old Image</label>
                        <div class="col-7">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Id</label>
                        <div class="col-7">
                          <input readonly class="form-control form-control-md mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Company Name <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-7">
                            <input class="form-control form-control-md" type="text" name="header[company_name]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">About <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-7">
                            <textarea rows="6" class="form-control form-control-md civw-textarea" name="header[about]" maxlength="5000" /></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Website <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-7">
                              <input value="" name="header[website]" type="text" class="form-control form-control-md" maxlength="500">
                        </div><!--./col-->
                    </div><!--./row-->


                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Tel. no. <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-3 edit-tel-no">
                            <select class="custom-select custom-select-md" name="header[dial_code]">
                                <option disabled selected>Select</option>
                            <?php
                              for($key = 0;$key < count($country_dial_code["data"]);$key++){

                                echo '<option value="'.$country_dial_code["data"][$key]['dial_code'].'">'.$country_dial_code["data"][$key]['code'].' '.$country_dial_code["data"][$key]['dial_code'].'</option>';
                              }//end for
                            ?>
                            </select>
                        </div><!--./col-10-->
                        <div class="col-4 edit-tel-no">
                            <input class="form-control form-control-md" type="text" name="header[contact_number]" maxlength="20"/>
                        </div><!--./col-10-->
                        <div class="col-7 view-tel-no d-flex align-items-center"></div>
                    </div><!--./form-group-->

                    
                   
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Location <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[location]"/>
                                <select name="header[location]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Address</label>
                        <div class="col-7">
                            <textarea class="form-control form-control-md civw-textarea" name="header[address]" maxlength="5000" /></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row d-none">
                      <label class="col-3 col-form-label text-right">Country</label>
                      <div class="col-7">
                        <input readonly class="form-control form-control-md" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    

                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">Industry <span class="text-danger fw-bolder civw-asterisk">*</span></label>
                        <div class="col-7">
                            <div class="input-group input-group-md">
                                <input class="form-control form-control-md d-none" type="text" name="placeholder[industry]"/>
                                <select name="header[industry]"></select>
                            </div>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    


                </div><!--./card-body-->
            </div><!--./card-->

            



            <div class="form-group row to_hide <?php echo $class;?>">
                  <div class="col align-self-center text-right">
                         <!-- Upload Image
                        <div class="image-upload">
                          <label id="company_file_placeholder" for="company_file" class="custom-file-upload-no-hover text-primary" style="font-size:20pt;">
                            <i class="fa fa-upload"></i>
                          </label>
                        </div> -->
                        
                        <div class="image-upload mt-3">
                            <label id="company_file_placeholder" for="company_file" class='btn btn-pill-sm-primary text-primary btn-sm' style="font-size: 1rem; padding: 1px 1px; width: 1.5in; border: 2px solid rgba(var(--bs-primary-rgb));">Upload Image</label>
                            <p id="image_upload_limit_note" style="color:#6c757d"><em>Note: Maximum of 8 images only.</em></p>
                        </div>
                  </div>
                  <!-- <div class="col align-self-center text-center">
                        Clear Image
                        <div class="image-upload">
                           
                          <label class="custom-file-upload-no-hover text-danger btn_remove_multiple" style="font-size:20pt;">
                            <i class="fa fa-times"></i>
                          </label>
                          
                        </div>
                  </div> -->
                  <div class="col d-none">
                    <input type='file' id="company_file" name='header[company_file][]' multiple size="20" />
                        <button name='btn_upload_multiple' type='button' class='btn btn-primary btn-sm'>Upload</button>
                        <button name='btn_remove_multiple' type='button' class='btn btn-danger btn-sm'>Remove</button>
                  </div><!--./col-->
                  
            </div><!--./row-->

            <div class="form-group row to_hide <?php echo $class;?> d-none">
                <label class="col-3 col-form-label">Total Size(MB)</label>
                <div class="col">
                   <input readonly name="file[total_uploaded_file]" class="form-control-plaintext form-control-sm" />
                   <input readonly name="file[total_files]" class="form-control-plaintext form-control-sm d-none" />
                </div>
                
            </div>


            <div id="image_cont_form" class="row row-cols-1">
            </div>
        </form>

        
	</div><!--./col-->
	
</div><!--./row-->


<div class="<?php echo $class;?>">
    <h4 class="mb-5">Company Images</h4>

    <div id="image_cont" class="row row-cols-4">
        
    </div><!--./row--> 
</div><!--./image-cont--> 

<div class="row">
    <div class="col">
        <div class="outside_button text-right">
            <a href="<?php echo base_url('company_info/view/'.$_SESSION['employer'].'') ?>" class="text-primary mr-4 btn_cancel">Cancel</a> 
            <a href="<?php echo base_url('company_info/edit/'.$_SESSION['employer'].'') ?>" class="btn btn-sm mr-4 btn-pill-sm-no-brdr btn-primary btn_edit">Edit</a>
            <button class="btn-pill-sm-no-brdr btn-primary text-white btn_add btn-sm btn_submit" type="button" aria-type="Company">Submit</button>
        </div><!--./text-right-->
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

<!--multiselect dropdown-->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/company_info_vw.js?v='). date('Ymdi') ?>"></script>



