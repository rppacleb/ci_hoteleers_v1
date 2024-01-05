<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">

<header class="py-5">   
<div class="container px-4 px-lg-5">
  <div class="row">
    <div class="col">
      
    </div>

    <div class="col-lg-4 col-md-6 align-self-center">
      <div class="card w-100 shadow">

        <div class="card-body">
          <h5 class="card-title text-link mb-5">New Password</h5>
          <form id = "frm_forgot_password">

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <input readonly Placeholder="Email" name="header[username]" type="text" class="form-control form-control-sm" maxlength="100" value="<?php echo $email?>">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      
                      <div class="input-group">
                        <input Placeholder="Enter new password" name="header[new_password]" type="password" class="form-control form-control-sm" maxlength="100">
                        <div id="btn_show_pass2" class="input-group-append input-group-addon">
                          <div class="input-group-text"><i class="fa fa-eye"></i></div>
                        </div>
                      </div>
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            

            <div class="row">
                <div class="col text-center">
                    <button name="btn_login" class="btn btn-primary btn-pill mb-5 text-white" type="button">Save</button>
                </div>
            </div>
            
          </form><!--./form-->
        </div>
      </div>
    </div>

    <div class="col">
      
    </div>
    
  </div>
  
</div>
</header>


<div class="main">
  <div class="container">
    <center>
      <div class="middle">
        <div id="login">

          

          
          
        </div><!--./login-->
       


      </div><!--./middle-->
    </center><!--./center-->
  </div><!--./container-->
</div><!--./main-->

	


<!-- Footer Menu -->

<!-- Footer Menu -->


<?php require_once('app/Views/libraries/footer.php'); ?>
<script src="<?php echo base_url('assets/main/js/new_pass.js?v='). date('Ymdi') ?>"></script>
