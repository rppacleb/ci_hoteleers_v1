<?php require_once('app/Views/libraries/header.php'); ?>


<script type="text/javascript">
  var redirect_type = <?php echo !isset($_GET['type'])? '""' : '"'.$_GET['type'].'"'; ?>;
  var redirect_id = <?php echo !isset($_GET['rdr_id'])? '""' : '"'.$_GET['rdr_id'].'"'; ?>
</script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 pt-3">
    <div class="container px-4 px-lg-5 navbarcontainer">

        
        
        <a class="navbar-brand fw-bolder text-link" href="<?php echo base_url(); ?>"><h2>Hoteleers</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                
            </div>

            <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" aria-current="page" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                
                <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm btn-primary text-white header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>
                <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="<?php echo base_url('signup/'); ?>">Sign up</a></li>
            </ul>
            
        </div>
    </div>
</nav>


<header class="py-5 header-login">   
<div class="container px-4 px-lg-5">
  <div class="row">
    <div class="col">
      
    </div>

    <div class="col-lg-4 col-md-8 align-self-center">
      <div class="card w-100 shadow">

        <div class="card-body">
          <h5 class="card-title text-link mb-5">Log In</h5>
          <form id = "frm_login">

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <input value="<?php echo $cookies_username;?>" Placeholder="Email" name="header[username]" type="text" class="form-control form-control-sm" maxlength="100">

                      <ul id="list">
                          
                      </ul>


                      


                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->



            <!--./row
            <div class="notifyjs-corner" style="top: 0px; left: 45%;">
                <div class="notifyjs-wrapper notifyjs-hidable">
                    <div class="notifyjs-arrow"></div>
                    <div class="notifyjs-container" style="">
                        <div class="notifyjs-bootstrap-base notifyjs-bootstrap-success">
                            <span data-notify-text="">User is already logged in!<br></span>
                        </div>
                    </div>
                </div>
            </div>
            -->



            <div class="row">
              <div class="col">
                  <div class="form-group">
                      
                      <div class="input-group">
                        <input value="<?php echo $cookies_password;?>" Placeholder="Password" name="header[password]" type="password" class="form-control form-control-sm" maxlength="100">
                        <div id="btn_show_pass" class="input-group-append input-group-addon">
                          <div class="input-group-text"><i class="fa fa-eye"></i></div>
                        </div>
                      </div>
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            


            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <input type="checkbox" class="mb-5" style="opacity:0.6;" name="header[remember]" <?php echo $cookies_remember_token;?> > <small class="text-muted">Remember Me</small>
                  </div><!--./form-group-->
              </div><!--./col-->
              <div class="col text-right">
                  <small><a href="<?php echo base_url('forgot_pass/'); ?>" class="mb-5">Forgot Password?</a></small>
              </div><!--./col-->
            </div><!--./row-->

            <div class="row">
                <div class="col text-center">
                    <button name="btn_login" class="btn btn-primary btn-pill mb-5 text-white login-btn" type="button">Login</button>
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <small><p class="text-muted mb-3">Don't have an account?</p></small>
                </div>
            </div>

            <div class="row">
                <div class="col text-center mb-3">
                    <small><a href="<?php echo base_url('signup/'); ?>" class="">Sign up Now</a></small>
                </div>
            </div>

            <!--
            <div class="row">
                <div class="col">
                    <small><a href="<?php echo base_url()?>"><i class="fas fa-arrow-left"></i> Go to Main</a></small>
                </div>
            </div>
            -->
            <!--./row-->
            
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

	

<?php require_once('app/Views/libraries/copyright.php'); ?>

<!-- Footer Menu -->

<!-- Footer Menu -->


<?php require_once('app/Views/libraries/footer.php'); ?>
<script src="<?php echo base_url('assets/main/js/login.js?v='). date('Ymdi') ?>"></script>
