<?php require_once('app/views/libraries/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">

<?php require_once('app/views/libraries/top-bar.php'); ?>



<!--content-->
<div class="container-fluid">
    <br/>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h2 class="h2 mb-0 text-gray-800">USER MANAGEMENT</h2>
      <div class="btn-group">
        <button name="<?php if ($_GET['action']=="view"){ echo "btnEdit"; }else{ echo "btnSave"; } ?>" type="button" class="d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> <?php if ($_GET['action']=="view"){ echo "Edit"; }else{ echo "Save"; } ?> 
        </button>
        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-list-ol"></i>
        </button>
        <div class="dropdown-menu">
          <?php
            if ($_GET['action']=="edit"){ 
              echo '<a class="dropdown-item" href="'.base_url("uservw/?action=view&id=".$_GET['id']).'"><i class="fas fa-eye"></i> View</a>'; 
            }//End if
          ?>
          <a class="dropdown-item" href="<?php echo base_url('user/'); ?>"><i class="fas fa-list"></i> List</a>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>-->
        </div><!--./dropdown-menu-->
      </div><!--./btn-group-->
    </div><!--./d-sm-flex-->

    <div class="row">
      <div class="col">
        <div class="card border-info bg-light">
            <div class="card-header border-info bg-transparent">
                <h6 class="font-weight-bold text-info">PRIMARY INFORMATION</h6>
            </div>
            <div class="card-body">

              <!--Edit Form-->
              <form id="editForm" class="d-none">
                <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="col-form-label col-form-label-sm">ID</label>
                          <input name="id" readonly type="text" class="form-control form-control-sm" value="<?php echo $_GET['id'] ?>">
                      </div><!--./form-group-->
                  </div><!--./col-->
                </div><!--./row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          
                            <label class="col-form-label col-form-label-sm">USERNAME <b class="text-danger">*</b></label>
                            <input name="username" type="text" class="form-control form-control-sm" maxlength="50">
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">PASSWORD <b class="text-danger">*</b></label>
                            <input name="password" type="password" class="form-control form-control-sm" maxlength="20">
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">TYPE</label>
                            <select name="type"  class="form-control form-control-sm">
                              <option value="ADMIN">Admin</option>
                              <option value="USER">User</option>
                            </select>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                  </div><!--./row-->

                  <!--2nd row-->
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                          
                            <label class="col-form-label col-form-label-sm">FULL NAME <b class="text-danger">*</b></label>
                            <input name="fullname" type="text" class="form-control form-control-sm" maxlength="200">
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                  </div><!--./row-->
                  <!--End 2nd row-->

              </form><!--./form-->
              <!--Edit Form-->

            </div><!--./card-body-->
            
          </div><!--./card-->
      </div><!--./col-->
    </div><!--./row-->
</div><!--./container-fluid-->

        


<?php require_once('app/views/libraries/copyright.php'); ?>
  



<!-- Footer Menu -->
<?php require_once('app/views/libraries/footer.php'); ?>
<!-- Footer Menu -->



<!-- datatables -->
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.buttons.min.js') ?>"></script>
<!-- datatables -->

<script type="text/javascript">
  

  $(document).ready(function() {
      $('table.display').DataTable();
  } );
</script>





<script src="<?php echo base_url('assets/main/js/user_vw.js?v='). date('Ymdi') ?>"></script>


