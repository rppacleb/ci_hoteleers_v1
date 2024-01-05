<?php require_once('app/Views/libraries/header.php'); ?>
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php
    $contact_us_content_1   = '';
    $contact_us_content_2   = '';
    $contact_us_content_3   = '';
    $contact_us_content_4   = '';
    $contact_us_content_5   = '';
    $html                   = '';
    if(count($home_page_banner)>0){
        $contact_us_content_1     = $home_page_banner[0]["contact_us_content_1"];
        $contact_us_content_2     = $home_page_banner[0]["contact_us_content_2"];
        $contact_us_content_3     = $home_page_banner[0]["contact_us_content_3"];
        $contact_us_content_4     = $home_page_banner[0]["contact_us_content_4"];
        $contact_us_content_5     = $home_page_banner[0]["contact_us_content_5"];

        if($contact_us_content_1 !== ''){
            $html .= '<p class="py-3">
                            '.$contact_us_content_1.'
                      </p>
                      ';
        }//end if

        if($contact_us_content_2 !== ''){
            $html .= '<p class="py-3">
                            '.$contact_us_content_2.'
                      </p>
                      ';
        }//end if

        if($contact_us_content_3 !== ''){
            $html .= '<p class="py-3">
                            '.$contact_us_content_3.'
                      </p>
                      ';
        }//end if

        if($contact_us_content_4 !== ''){
            $html .= '<p class="py-3">
                            '.$contact_us_content_4.'
                      </p>
                      ';
        }//end if

        if($contact_us_content_5 !== ''){
            $html .= '<p class="py-3">
                            '.$contact_us_content_5.'
                      </p>
                      ';
        }//end if

    }//end if

?>


    
	<!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3">
        <div class="container px-4 px-lg-5 navbarcontainer">

            <a class="navbar-brand fw-bolder text-link" href="<?php echo base_url(); ?>"><h2>Hoteleers</h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    
                </div>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                    <?php if(!isset($_SESSION['userid'])){?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted active header-navbtn" aria-current="page" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                        
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>

                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="<?php echo base_url('signup'); ?>">Sign up</a></li>
                    <?php }else{?>
                        <?php if($_SESSION['usertype'] === 'applicant'){?>
                            <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn header-findjobbtn desktop-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a></li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] === 'employer'){?>
                            <li class="nav-item"><a class="nav-link header-navbtn header-findapplicantbtn" href="<?php echo base_url('applicant_search/private/'); ?>">
                                <i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Applicant</a>
                            </li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] == 'admin') {?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" aria-current="page" href="<?php echo base_url('home'); ?>">Admin Dashboard</a></li>
                        <?php }?>
                    <?php }?>
                </ul>
                
            </div>
        </div>
    </nav>

    <br/>
    <br/>
    <div class="row justify-content-center" style="min-height:60vh;">
        <div class="col-xl-6 col-lg-6 col-auto">
            <b class="mb-5 pb-5" style="font-size: 28pt; resize: none;">Contact</b>
            <br/>
            <br/>
            <br/>
            <br/>
            <h5 class="py-3">General Information</h5>
            <?php echo $html;?>
        </div>
    </div>


    <!-- Copyright -->
    <?php require_once('app/Views/libraries/copyright.php'); ?>
    <!-- Copyright -->


  <!-- Footer Menu -->
  <?php require_once('app/Views/libraries/footer-menu.php'); ?>
  <!-- Footer Menu -->




<?php require_once('app/Views/libraries/footer.php'); ?>



<script type="text/javascript">
    var user_id = <?php echo isset($_SESSION['userid'])?$_SESSION['userid']:0; ?>;

  


</script>


<script src="<?php echo base_url('assets/main/js/privacy_policy.js?v='). date('Ymdi') ?>"></script>

