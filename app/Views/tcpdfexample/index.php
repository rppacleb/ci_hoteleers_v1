<?php require_once('app/views/libraries/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">

<?php require_once('app/views/libraries/top-bar.php'); ?>



<!--content-->
<div class="container-fluid">
    <br/>
    <div class="row">
      <div class="col">
        <div class="card border-info bg-light">
            <div class="card-header border-info bg-transparent">
                <h2>ORDER</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive" ng-app="myDtApp">
                <table id="tblMain" class="table table-bordered dataTable">
                  <thead class="thead-light">
                  <tr>
                    <th style="width:0.5in;">Action</th>
                    <th style="width:0.5in;">ID</th>
                    <th style="width:1in;">ORDER #</th>
                    <th>CUSTOMER</th>
                    <th style="width:1.5in;">DATE CREATED</th>
                    <th style="width:1.3in;">TOTAL</th>
                    <th style="width:1.3in;">STATUS</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div><!--./table-responsive-->
            </div><!--./card-body-->
            <div class="card-footer border-info bg-transparent">
              <a target="_blank" href="<?php echo base_url('order/add/0') ?>" class="btn btn-sm btn-primary">Add</a>
            </div><!--./card-footer-->
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







<script src="<?php echo base_url('assets/main/js/order.js?v='). date('Ymdi') ?>"></script>


