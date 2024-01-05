<?php require_once('app/Views/libraries/header.php'); ?>
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


    <?php
        $about_us_desc = '';
        if(count($home_page_banner)>0){
            $about_us_desc     = $home_page_banner[0]["about_us_desc"];
        
        }//end if
    
    ?>


    
	<!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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



	


        
            
        
            <div class="row mt-5 justify-content-center">
                
                <div class="col-xl-6 col-lg-6 col-auto">
                    
                    <div class="card">

                        <div class="card-body">
                            
                        
                            <div class="py-5 px-5">
                                <?php echo $about_us_desc; ?>
                            
                                <div class="row my-5">
                                    <div class="col text-center">
                                        <a href="<?php echo base_url('signup')?>" class="">Sign up Now</a>
                                    </div>
                                    <div class="col text-center">
                                        <a href="<?php echo base_url('login')?>" class="">Sign in</a>
                                    </div>
                                </div>
                              
                                <p class=" fw-normal text-center mb-5">Hoteleers by Butteredfly Inc.
                                </p>
                                    
                                    
                            </div>
                        </div>
                     </div><!--./card--> 
                    
                </div>
               
            </div><!--./row-->




    


   


    

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


<script src="<?php echo base_url('assets/main/js/about_us.js?v='). date('Ymdi') ?>"></script>

