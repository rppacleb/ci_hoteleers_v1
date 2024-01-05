<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>
<div class="row mb-5">
	<div class="col-xl-6 col-lg-6">
		<h4>Banner Setup</h4>
	</div><!--./col-->
</div>
<!--./row-->




<div class="row">
	<div class="col">
		<small class="text-muted"><b>BANNER A</b></small>
	</div><!--./col-->
	<div class="col">
		<small class="text-muted"><b>BANNER B</b></small>
	</div><!--./col-->
</div><!--./row-->

<div class="row">
	<div class="col">
		<img id="header[banner_a]" style="width:100%;height:400px;" class="img-fluid img-thumbnail rounded" src="files/images/default/banner_image.png" />

		<p class="text-muted"><small>Max size 1650x768 JPG and PNG format only</small></p>

	</div><!--./col-->
	<div class="col">
		<img id="header[banner_c]" style="width:100%;height:400px;" class="img-fluid img-thumbnail rounded" src="files/images/default/banner_image.png" />
		<p class="text-muted"><small>Max size 1650x768 JPG and PNG format only</small></p>
	</div><!--./col-->
</div><!--./row-->

<br/>
<form id="frm_data_entry">
	<div class="row">
			<div class="col">
				<div class="form-group row d-none">
                    <label class="col-3 col-form-label">Id</label>
                    <div class="col">
                      <input aria-type="<?php echo $type?>" readonly class="form-control form-control-sm mb-2" type="text" name="header[id]" value="<?php echo !isset($banner_id)? 0 :  $banner_id;?>" />
                    </div>
                </div>

				<div class="form-group row to_hide">
		             
		              <div class="col">
		                <input type='file' name='header[userfile_a][]' size='20' style="display:inline;" />
		                
		                    <button name='btn_upload_a' type='button' class='btn btn-primary btn-sm'>Upload</button>
		                    <button name='btn_remove_a' type='button' class='btn btn-danger btn-sm'>Remove</button>
		                    
		              </div>
		        </div><!--./row-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Doc Content</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="file[doc_content_a]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Doc Image</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="header[doc_image_a]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Old Image</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="file[old_doc_image_a]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group">
		            <label class="col-form-label">Title</label>
		            <input class="form-control form-control-md" type="text" name="header[title_a]"/>
		        </div><!--./form-group-->	

		        <div class="form-group">
		            <label class="col-form-label">Description</label>
		            <textarea rows="5" class="form-control form-control-md" name="header[description_a]"></textarea>
		        </div><!--./form-group-->

			</div><!--./col-->

			<div class="col">
				<div class="form-group row to_hide">
		             
		              <div class="col">
		                <input type='file' name='header[userfile_c][]' size='20' style="display:inline;" />
		                
		                    <button name='btn_upload_c' type='button' class='btn btn-primary btn-sm'>Upload</button>
		                    <button name='btn_remove_c' type='button' class='btn btn-danger btn-sm'>Remove</button>
		                    
		              </div>
		        </div><!--./row-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Doc Content</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="file[doc_content_c]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Doc Image</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="header[doc_image_c]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group row d-none">
		            <label class="col-3 col-form-label">Old Image</label>
		            <div class="col">
		                <input readonly class="form-control form-control-md" type="text" name="file[old_doc_image_c]"/>
		            </div><!--./col-10-->
		        </div><!--./form-group-->

		        <div class="form-group">
		            <label class="col-form-label">Title</label>
		            <input class="form-control form-control-md" type="text" name="header[title_c]"/>
		        </div><!--./form-group-->
		        <div class="form-group">
		            <label class="col-form-label">Description</label>
		            <textarea rows="5" class="form-control form-control-md" name="header[description_c]"></textarea>
		        </div><!--./form-group-->

			</div><!--./col-->
	</div><!--./row-->
	<hr/>
	<div class="row">
		<div class="col">
			<div class="row">
				<div class="col">
					<small class="text-muted"><b>BANNER C</b></small>

					<img id="header[banner_d]" style="width:100%;height:400px;" class="img-fluid img-thumbnail rounded" src="files/images/default/banner_image.png" />

					<p class="text-muted"><small>Max size 1650x768 JPG and PNG format only</small></p>

					<div class="form-group row to_hide">
			             
			              <div class="col">
			                <input type='file' name='header[userfile_d][]' size='20' style="display:inline;" />
			                
			                    <button name='btn_upload_d' type='button' class='btn btn-primary btn-sm'>Upload</button>
			                    <button name='btn_remove_d' type='button' class='btn btn-danger btn-sm'>Remove</button>
			                    
			              </div>
			        </div><!--./row-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Doc Content</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="file[doc_content_d]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Doc Image</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="header[doc_image_d]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Old Image</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="file[old_doc_image_d]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group">
			            <label class="col-form-label text-link">Title</label>
			            <input class="form-control form-control-md" type="text" name="header[title_d]"/>
			        </div><!--./form-group-->	

			        <div class="form-group">
			            <label class="col-form-label text-link">Description</label>
			            <textarea rows="5" class="form-control form-control-md" name="header[description_d]"></textarea>
			        </div><!--./form-group-->

				</div>
			</div>
			
		</div><!--./col-->
		<div class="col">
			<div class="row">
				<div class="col">
					<small class="text-muted"><b>BANNER D</b></small>

					<img id="header[banner_b]" style="width:100%;height:400px;" class="img-fluid img-thumbnail rounded" src="files/images/default/banner_image.png" />

					<p class="text-muted"><small>Max size 1650x768 JPG and PNG format only</small></p>


					<div class="form-group row to_hide">
			             
			              <div class="col">
			                <input type='file' name='header[userfile_b][]' size='20' style="display:inline;" />
			                
			                    <button name='btn_upload_b' type='button' class='btn btn-primary btn-sm'>Upload</button>
			                    <button name='btn_remove_b' type='button' class='btn btn-danger btn-sm'>Remove</button>
			                    
			              </div>
			        </div><!--./row-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Doc Content</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="file[doc_content_b]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Doc Image</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="header[doc_image_b]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group row d-none">
			            <label class="col-3 col-form-label">Old Image</label>
			            <div class="col">
			                <input readonly class="form-control form-control-md" type="text" name="file[old_doc_image_b]"/>
			            </div><!--./col-10-->
			        </div><!--./form-group-->

			        <div class="form-group">
			            <label class="col-form-label text-link">Title</label>
			            <input class="form-control form-control-md" type="text" name="header[title_b]"/>
			        </div><!--./form-group-->	

			        <div class="form-group">
			            <label class="col-form-label text-link">Description</label>
			            <textarea rows="5" class="form-control form-control-md" name="header[description_b]"></textarea>
			        </div><!--./form-group-->
					

				</div>
			</div>
		</div><!--./col-->
	</div><!--./row-->

	<div class="row mt-5 mb-5">
		<div class="col-xl-6 col-lg-6 col-auto">
			<h4>About Us</h4>
		</div><!--./col-->
	</div>

	
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-auto">
			<textarea class="form-control form-control-md jp-textarea texteditor" name="header[about_us_desc]" maxlength="15000"></textarea>
		</div>
	</div><!--./form-group-->


	<div class="row mt-5 mb-5">
		<div class="col-xl-6 col-lg-6 col-auto">
			<h4>Terms of Use</h4>
		</div><!--./col-->
	</div>

	
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-auto">
			<textarea class="form-control form-control-md jp-textarea texteditor" name="header[terms_of_use]" maxlength="15000"></textarea>
		</div>
	</div><!--./form-group-->

	<div class="row mt-5 mb-5">
		<div class="col-xl-6 col-lg-6 col-auto">
			<h4>Privacy Policy</h4>
		</div><!--./col-->
	</div>

	
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-auto">
			<textarea class="form-control form-control-md jp-textarea texteditor" name="header[privacy_policy]" maxlength="15000"></textarea>
		</div>
	</div><!--./form-group-->
	

	
	<div class="row mt-5 mb-5">
		<div class="col-xl-6 col-lg-6">
			<h4>Contact Us</h4>
		</div><!--./col-->
	</div>

	<div class="row">
		<div class="col">
			<div class="form-group">
				<label class="col-form-label text-link">Content 1</label>
				
				<textarea class="form-control form-control-md jp-textarea texteditor" name="header[contact_us_content_1]" maxlength="1000"></textarea>
			</div><!--./form-group-->
			

			<div class="form-group">
				<label class="col-form-label text-link">Content 2</label>
				<textarea class="form-control form-control-md jp-textarea texteditor" name="header[contact_us_content_2]" maxlength="1000"></textarea>
			</div><!--./form-group-->	
			
			<div class="form-group">
				<label class="col-form-label text-link">Content 3</label>
				<textarea class="form-control form-control-md jp-textarea texteditor" name="header[contact_us_content_3]" maxlength="1000"></textarea>
			</div><!--./form-group-->
		
			<div class="form-group">
				<label class="col-form-label text-link">Content 4</label>
				<textarea class="form-control form-control-md jp-textarea texteditor" name="header[contact_us_content_4]" maxlength="1000"></textarea>
			</div><!--./form-group-->
		
			<div class="form-group">
				<label class="col-form-label text-link">Content 5</label>
				<textarea class="form-control form-control-md jp-textarea texteditor" name="header[contact_us_content_5]" maxlength="1000"></textarea>
			</div><!--./form-group-->
		
		</div>
	</div>

	<div class="row">
        <div class="col">
			<div class="outside_button text-right">

				<?php if ($type == 'edit') { ?>
					<a href="<?php echo base_url('homepage_banner') ?>" class="text-danger mr-4">Cancel</a>
				<?php } ?>

				<?php if ($type != 'edit') { ?>
					<a href="<?php echo base_url('homepage_banner?edit=T') ?>" class="btn-pill-sm-no-brdr btn-primary text-white btn-sm">Edit</a>
				<?php } ?>
				<button class="btn-pill-sm-no-brdr btn-primary text-white btn-sm btn_submit">Save</button>
			</div>
			<!--./text-right-->
		</div>
    </div>
	
	
</form><!--./form-->

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

<script src="<?php echo base_url('assets/main/js/homepage_banner.js?v='). date('Ymdi') ?>"></script>


