<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]) ?>;
</script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/multi_select/dist/css/bootstrap-multiselect.css') ?>" type="text/css">

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 pt-3">
    <div class="container px-4 px-lg-5 navbarcontainer">

        <a class="navbar-brand fw-bolder text-link" href="<?php echo base_url(); ?>"><h2>Hoteleers</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                
            </div>

            <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                
                  <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" aria-current="page" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                  
                  <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>
                  <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm btn-primary text-white ml-3 header-signupbtn" href="<?php echo base_url('signup/'); ?>">Sign up</a></li>
                
            </ul>
            
        </div>
    </div>
</nav>

<header class="py-5 header-signup">   
<div class="container px-4 px-lg-5">
  <div class="row">
    <div class="col-xl-3 col-lg-3 signup-spacer">
      
    </div>

    <div class="col-xl-4 col-lg-4 col-md-8 align-self-center mx-auto signup-company">
      <div class="card w-100 shadow">

        <div class="card-body">
          <h5 class="card-title text-link mb-5">Sign up as Jobseeker</h5>
            <form id = "frm_signup">
                <div id="signup_init">
                    <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input value="" Placeholder="Email" name="header[username]" type="text" class="form-control form-control-sm" maxlength="100">
                          </div><!--./form-group-->
                      </div><!--./col-->
                    </div><!--./row-->

                    


                    <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <div class="input-group">
                                <input value="" Placeholder="Password" name="header[password]" type="password" class="form-control form-control-sm" maxlength="50">
                                <div class="input-group-append input-group-addon btn_show_pass" aria-type="password">
                                  <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                </div>

                              </div>

                          </div><!--./form-group-->
                      </div><!--./col-->
                    </div><!--./row-->

                    <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <div class="input-group">
                                <input value="" Placeholder="Confirm Password" name="header[confirm_password]" type="password" class="form-control form-control-sm" maxlength="50">
                                <div class="input-group-append input-group-addon btn_show_pass" aria-type="confirm_password">
                                  <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                </div>
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-->
                    </div><!--./row-->

                    <div class="row mb-3">
                        <div class="col text-primary">
                            <span class="fa fa-info-circle"></span> <small>Password must be minimum of 8 characters with upper case, lower case and number</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-center">
                            <button class="btn btn-primary btn-pill-sm-primary mb-2 btn_signup" aria-type="Applicant" type="button">Submit</button>
                        </div>
                    </div><!--./row-->


                    <div class="row">
                      <div class="col text-center mb-3">
                              <small>
                                <small class="text-muted mb-0">By signing up, you agree to Hoteleers
                                </small>
                              </small><br/>
                              
                              <small>
                                <small class="text-muted"><span class="text-primary"><a href="<?php echo base_url('term_of_use/')?>" target="_blank" class="signup-links">Terms of Service</a></span> and <span class="text-primary"><a href="<?php echo base_url('privacy_policy/')?>" target="_blank" class="signup-links">Privacy Policy</a></span>
                                </small>
                              </small>
                      </div><!--./col-->
                      
                    </div><!--./row-->

                    <div class="row">
                        <div class="col text-center text-muted pe-none mb-3">
                            Or
                        </div>
                    </div><!--./row-->

                    <div class="row">
                        <div class="col text-center">
                            <button class="btn btn-primary btn-pill-sm-primary mb-3 btn_signup_company" aria-type="Company" type="button">Sign up as an Employer</button>
                        </div>
                    </div><!--./row-->

                    <div class="row">
                        <div class="col text-center">
                            <small><small class="text-muted pe-none mb-3">Already signed up?</small></small>
                        </div>
                        <div class="col justify-content-center text-center">
                            <small><small><a href="<?php echo base_url('login/'); ?>" class="text-primary">Login now</a></small></small>
                        </div>
                    </div><!--./row-->
                </div><!--./signup_init-->

                <div class="signup_final">
                    
                </div><!--./div.signup_final-->
                
            </form><!--./form-->
        </div><!--./card-body-->
      </div><!--./card-->
        

    </div><!--./col-->

    <div class="col-xl-3 col-lg-3">
      
    </div><!--./col-->
    
  </div><!--./row-->
    <div class="signup_final_button d-none">
        <br/>
        <div class="row">
            <div class="col"></div><!--./col-->
            <div class="col-12 col-xl-5 col-lg-5 col-md-8 text-right">
                <button class="btn btn-pill btn-primary mb-2 text-white btn_submit btn_submit_company" aria-type="Company" type="button">Submit</button>
            </div><!--./col-->
            <div class="col"></div><!--./col-->
        </div><!--./row-->
    </div>
  
</div>

</header>




	
<?php require_once('app/Views/libraries/copyright.php'); ?>


<!-- Footer Menu -->

<!-- Footer Menu -->

<!-- Company Modal -->
<div class="modal fade" id="signup_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button> -->
        </div>
        <div class="modal-body align-self-center mb-5">
            <h6 class="modal-title mb-3 text-break" id="edit_modal_title">Great! We'll be in touch soon!</h6>
            <div class="text-center"><a href="<?php echo base_url()?>" class="btn-pill btn-primary text-white">OK</a></div>
        </div>
    </div>
  </div>
</div>

<!-- Applicant Modal  -->
<div class="modal fade" id="signup_modal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button> -->
        </div>
        <div class="modal-body align-self-center mb-5">
            <h6 class="modal-title mb-3 text-break text-center" id="edit_modal_title">We sent a verification link to your email to activate your account.</h6>
            <div class="text-center"><a href="<?php echo base_url().'/login'?>" class="btn-pill btn-primary text-white">OK</a></div>
        </div>
    </div>
  </div>
</div>

<?php require_once('app/Views/libraries/footer.php'); ?>


<!--Autocomplete-->
<script src="<?php echo base_url('assets/autocomplete/js/jquery.mockjax.js') ?>"></script>
<script src="<?php echo base_url('assets/autocomplete/js/jquery.autocomplete.js') ?>"></script>
<!--Autocomplete-->

<!--multiselect dropdown-->
<script src="<?php echo base_url('assets/multi_select/dist/js/bootstrap-multiselect.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/signup.js?v='). date('Ymdi') ?>"></script>
