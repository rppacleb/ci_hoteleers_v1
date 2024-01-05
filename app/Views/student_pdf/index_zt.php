<?php require_once('application/views/libraries/header.php'); ?>
<!-- Custom fonts for this template-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/sb-admin-2/fontawesome-free/css/all.min.css') ?>">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url('assets/css/sb-admin-2/sb-admin-2.min.css') ?>">

<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Side Menu -->
  <?php require_once('application/views/libraries/side-menu.php'); ?>
  <!-- Side Menu -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Top Bar -->
    <?php require_once('application/views/libraries/top-bar.php'); ?>
    <!-- Top Bar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">



        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 font-weight-bold mb-0 text-gray-800">PAYMENT</h1>
          
          <div class="btn-group">
            <button name="<?php if ($_GET['action']=="view"){ echo "btnEdit"; }else{ echo "btnSave"; } ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> <?php if ($_GET['action']=="view"){ echo "Edit"; }else{ echo "Save"; } ?> 
            </button>


            
            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-list-ol"></i>
            </button>
            <div class="dropdown-menu">
              <?php
                if ($_GET['action']=="edit"){ 
                  echo '<a class="dropdown-item" href="'.base_url("paymentvw/?action=view&id=".$_GET['id']).'"><i class="fas fa-eye"></i> View</a>'; 
                }//End if
              ?>
              <a class="dropdown-item" href="<?php echo base_url('payment/'); ?>"><i class="fas fa-list"></i> List</a>
              
              <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>-->
            </div>
          </div>
        </div>

        <!-- Content Row -->
        <div class="row">
          <div class="col-lg-12">

              <!--View Form-->
              <form id="viewForm" class="d-none">
                <div class="card mb-4 border-left-info">

                  <div class="card-header py-3">
                    <h6 class="m-0 p-2 h3 font-weight-bold text-gray-800 bg"><span id="tranidinfo"></span></h6>
                  </div>
                  
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">PRIMARY INFORMATION</h6>
                  </div>
                  <div class="card-body py-3">
                    <div class="row">
                      <!--1st Col-->
                      <div class="col">
                          <!--1st Row-->
                          <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm"><b>ID</b></label>
                                    <input name="id" readonly type="text" class="form-control-plaintext form-control-sm" value="<?php echo $_GET['id'] ?>">
                                 
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div>
                          <!--End 1st Row-->
                          <!--2nd Row-->
                          <div class="row">
                            

                            <div class="col">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm"><b>ENTITY</b> <b class="text-danger">*</b></label>
                                    <div>
                                      <a href="#" target="_blank" name="patient" class="text-primary"></a>
                                    </div>
                                    
                                    
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->

                            <div class="col">
                                <div class="form-group">
                                  <label class="col-form-label col-form-label-sm"><b>DATE</b> <b class="text-danger">*</b></label>
                                  <textarea readonly name="date" class="form-control-plaintext pcluppercase"></textarea>
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div><!--./row-->
                          <!--End 2nd Row-->

                          <!--3rd Row-->
                          <div class="row">


                            
                            <div class="col">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm"><b>PAYMENT METHOD</b> <b class="text-danger">*</b></label>
                                    <div>
                                      <a href="#" target="_blank" name="paymethod" class="text-primary"></a>
                                    </div>
                                 
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                           

                            <div class="col">
                                <div class="form-group">
                                  <label class="col-form-label col-form-label-sm"><b>REMARKS</b></label>
                                  <textarea readonly name="remarks" class="form-control-plaintext form-control-sm"></textarea>
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div>
                          <!--End 3rd Row-->


                      </div>
                      <!--End 1st Col-->

                      <!--2nd Col-->
                      <div class="col-md-3">

                        <!--1st Row-->
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <div class="card border-left-info shadow">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="row">
                                              <div class="col">
                                                <div class="h7 font-weight-bold text-warning text-uppercase mb-1">
                                                    SUMMARY
                                                </div>
                                              </div>

                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <hr/>
                                              </div>
                                            </div>
                                            <!--Start Row-->
                                            
                               

                                            <div class="row">
                                              <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL
                                                </div>
                                              </div>
                                              <div class="col">
                                                <input readonly name="total" class="form-control-plaintext form-control-sm text-right" value="0.00" />
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL
                                                </div>
                                              </div>
                                              <div class="col">
                                                <input readonly name="tot" class="form-control-plaintext form-control-sm text-right" value="0.00" />
                                              </div>
                                            </div>
                                            <!--End Row-->

                                            
                                            <!--<textarea name="amount" class="form-control-plaintext"></textarea>-->
                                        </div>
                                        <!--
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                        -->
                                    </div>
                                </div>
                              </div>
                            </div><!--./form-group-->
                          </div><!--./col-->
                        </div>
                        <!--End 1st Row-->

                        
                      </div>
                      <!--End 2nd Col-->
                    </div>
                    <!--End row-->
                  </div> <!--End card-body-->
                </div> <!--End card-->



                


                <div class="card mb-4 border-left-info shadow">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">LINES</h6>
                  </div>
                  <div class="card-body py-3">
                    <div class="row">
                      <div class="col">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#itemview">Item</a>
                          </li>
                          <!--
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                          </li>
                          -->
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="itemview">
                            <!--Item Tab-->
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="card">

                                  <div class="card-body">
                                    <div class="table-responsive" >
                                      <table id="tblItem" class="table table-bordered">
                                        <thead>
                                          <tr>
                                            
                                            <th>Line No</th>
                                            
                                            <th>Date</th>
                                            
                                            <th>Transaction</th>
                                            <th>Type</th>
                                            <th>Amount Due</th>
                                            <th>Payment</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <!--
                                          <tr>
                                            <td><input type="checkbox" name="action[]" class="form-control-sm" /></td>
                                            
                                          </tr>
                                          -->
                                        </tbody>
                                      </table>
                                    </div><!--./table-responsive-->
                                  </div><!--./card-body-->
                                  
                                </div><!--./card-->
                              </div><!--./col-lg-12-->
                            </div><!--./row-->
                            <!--End Item Tab-->
                          </div>
                          <div class="tab-pane container fade" id="menu1view">...</div>
                          <div class="tab-pane container fade" id="menu2view">...</div>
                        </div>
                      </div><!--./col-->
                    </div><!--./row-->
                  </div> <!--End card-body-->
                </div> <!--End card-->

               
              </form>
              <!--End View Form-->


              <!--Edit Form-->
              <form id="editForm" class="d-none">
                <div id="header" class="card mb-4 border-left-info shadow">
                  
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">PRIMARY INFORMATION</h6>
                  </div>
                  <div class="card-body py-3">

                    <div class="row">
                      <!--1st Col-->
                      <div class="col">
                          <!--1st Row-->
                          <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm">ID</label>
                                    <input name="id" readonly type="text" class="form-control form-control-sm" value="<?php echo $_GET['id'] ?>">
                                 
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div>
                          <!--End 1st Row-->
                          <!--2nd Row-->
                          <div class="row">
                            <div class="col d-none">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm">ENTITY ID</label>
                                    <input readonly name="patientid" type="text" class="form-control form-control-sm">
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->

                            <div class="col">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm">ENTITY <b class="text-danger">*</b></label>
                                    <div class="input-group">
                                      <input name="patient" type="text" class="form-control form-control-sm">
                                      <div class="input-group-append input-group-addon" data-toggle="modal" data-target="#LookupModal" data-title="Entity">
                                        <div class="input-group-text"><i class="fa fa-list"></i></div>
                                      </div>
                                    </div>
                                 
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->

                            <div class="col">
                                <div class="form-group">
                                  <label class="col-form-label col-form-label-sm">DATE <b class="text-danger">*</b></label>
                                  <div class="input-group date" id="datedtp">
                                    <input name="date" type="text" class="form-control form-control-sm datetimepicker-input pcluppercase" />
                                    <div class="input-group-append input-group-addon">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div><!--./row-->
                          <!--End 2nd Row-->

                          <!--3rd Row-->
                          <div class="row">

                            <div class="col d-none">
                                <div class="form-group">
                                    <label class="col-form-label col-form-label-sm">PAYMENT ID</label>
                                    <input readonly name="payid" type="text" class="form-control form-control-sm">
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                            
                            <div class="col">
                                <div class="form-group">
                                  
                                    <label class="col-form-label col-form-label-sm">PAYMENT METHOD <b class="text-danger">*</b></label>
                                    <div class="input-group">
                                      <input name="paymethod" type="text" class="form-control form-control-sm">
                                      <div class="input-group-append input-group-addon" data-toggle="modal" data-target="#LookupModal" data-title="Payment Method">
                                        <div class="input-group-text"><i class="fa fa-list"></i></div>
                                      </div>
                                    </div>
                                 
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->

                            <div class="col">
                                <div class="form-group">
                                  <label class="col-form-label col-form-label-sm">REMARKS</label>
                                  <textarea name="remarks" class="form-control form-control-sm"></textarea>
                                </div><!--./form-group-->
                            </div><!--./col-lg-4-->
                          </div>
                          <!--End 3rd Row-->


                      </div>
                      <!--End 1st Col-->

                      <!--2nd Col-->
                      <div class="col-md-3">

                        <!--1st Row-->
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <div class="card border-left-info shadow">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="row">
                                              <div class="col">
                                                <div class="h7 font-weight-bold text-warning text-uppercase mb-1">
                                                    SUMMARY
                                                </div>
                                              </div>

                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <hr/>
                                              </div>
                                            </div>
                                            <!--Start Row-->
                                            
                               

                                            <div class="row">
                                              <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL
                                                </div>
                                              </div>
                                              <div class="col">
                                                <input readonly name="total" class="form-control-plaintext form-control-sm text-right" value="0.00" />
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL
                                                </div>
                                              </div>
                                              <div class="col">
                                                <input readonly name="tot" class="form-control-plaintext form-control-sm text-right" value="0.00" />
                                              </div>
                                            </div>
                                            <!--End Row-->

                                            
                                            <!--<textarea name="amount" class="form-control-plaintext"></textarea>-->
                                        </div>
                                        <!--
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                        -->
                                    </div>
                                </div>
                              </div>
                            </div><!--./form-group-->
                          </div><!--./col-->
                        </div>
                        <!--End 1st Row-->

                        
                      </div>
                      <!--End 2nd Col-->
                    </div>
                    <!--End row-->
                  </div>
                </div> <!--End card-->



                


                <div class="card mb-4 border-left-info shadow">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">LINES</h6>
                  </div>
                  <div class="card-body py-3">
                    <div class="row">
                      <div class="col">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#item">Item</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="item">
                            <!--Item Tab-->
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="card">

                                  <div class="card-body">
                                    <div class="table-responsive" >
                                      <table id="tblItem" class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th></th>
                                            <th>Line No</th>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Entity</th>
                                            <th>Transaction</th>
                                            <th>Type</th>
                                            <th>Amount Due</th>
                                            <th>Payment</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <!--
                                          <tr>
                                            <td><input type="checkbox" name="action[]" class="form-control-sm" /></td>
                                            
                                          </tr>
                                          -->
                                        </tbody>
                                      </table>
                                    </div><!--./table-responsive-->
                                  </div><!--./card-body-->
                                  
                                </div><!--./card-->
                              </div><!--./col-lg-12-->
                            </div><!--./row-->
                            <!--End Item Tab-->
                          </div>
                          <div class="tab-pane container fade" id="menu1">...</div>
                          <div class="tab-pane container fade" id="menu2">...</div>
                        </div>
                      </div><!--./col-->
                    </div><!--./row-->


                  </div> <!--End card-body-->
                </div> <!--End card-->
                


                
                

              </form> <!--End form-->


          </div><!--./col-lg-12-->
         
        </div>
        <!-- Content Row -->

        <div class="row">

        </div>

        <!-- Content Row -->
        <div class="row">
        </div>
        <!-- Content Row -->

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


   

    <!-- Copyright -->
    <?php require_once('application/views/libraries/copyright.php'); ?>
    <!-- Copyright -->

  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->


  <!-- Footer Menu -->
  <?php require_once('application/views/libraries/footer-menu.php'); ?>
  <!-- Footer Menu -->




<?php require_once('application/views/libraries/footer.php'); ?>
<script src="<?php echo base_url('assets/js/viewjs/paymentvw.js?v='). date('Ymdi') ?>"></script>