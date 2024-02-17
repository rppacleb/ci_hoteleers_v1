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
          <h3 class="card-title text-link mb-4">Forgot Password</h3>
          <h6 class="mb-4">Enter your email address below and we will send you a link to reset your password.</h6>
          <form id = "frm_forgot_password">
            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <input Placeholder="Email" name="header[username]" type="text" class="form-control form-control-sm" maxlength="100">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->
            <div class="row">
              <div class="col text-left mb-5">
                  <small><a href="<?php echo base_url('login/'); ?>">Go to Login</a></small>
              </div><!--./col-->
            </div><!--./row-->

            <div class="row">
                <div class="col text-center">
                    <button name="btn_login" class="btn btn-primary btn-pill mb-5 text-white" type="button">Submit</button>
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
<script src="<?php echo base_url('assets/main/js/forgot_pass.js?v='). date('Ymdi') ?>"></script>
