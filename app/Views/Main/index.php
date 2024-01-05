<?php require_once('app/Views/libraries/header.php'); ?>
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<!-- animate landing page -->
<link href="<?php echo base_url('assets/landingpage/style.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/landingpage/script.js') ?>"></script>
<script type="text/javascript">
    var usertype = <?php echo !isset($_SESSION['usertype'])? '""' : '"'.$_SESSION['usertype'].'"'; ?>;
</script>
<!-- animate landing page -->
<style>
      body {
        animation: fadeIn 2s;
      }
      
      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
</style>

<?php
        $upload_path        = base_url('files/uploads');
        $urlimgdef          = 'https://dummyimage.com/1650x780/dee2e6/6c757d.jpg';
        $banner_a           = "";
        $banner_a_title     = "";
        $banner_a_desc      = "";
        $banner_b           = "";
        $banner_b_title     = "";
        $banner_b_desc      = "";

        $banner_c           = "";
        $banner_c_title     = "";
        $banner_c_desc      = "";

        $banner_d           = "";
        $banner_d_title     = "";
        $banner_d_desc      = "";

        $banner_b_bg         = base_url('assets/img/main');
        $banner_b_bg          .= '/bg.png';
        if(count($home_page_banner)>0){
            $banner_a           = $upload_path.'/'.$home_page_banner[0]["doc_image_a"];
            $banner_a_title     = $home_page_banner[0]["title_a"];
            $banner_a_desc      = $home_page_banner[0]["description_a"];

            $banner_b           = $upload_path.'/'.$home_page_banner[0]["doc_image_b"];
            $banner_b_title     = $home_page_banner[0]["title_b"];
            $banner_b_desc      = $home_page_banner[0]["description_b"];

            $banner_c           = $upload_path.'/'.$home_page_banner[0]["doc_image_c"];
            $banner_c_title     = $home_page_banner[0]["title_c"];
            $banner_c_desc      = $home_page_banner[0]["description_c"];

            $banner_d           = $upload_path.'/'.$home_page_banner[0]["doc_image_d"];
            $banner_d_title     = $home_page_banner[0]["title_d"];
            $banner_d_desc      = $home_page_banner[0]["description_d"];
        }else{
            $banner_a = $urlimgdef;
            $banner_b = $urlimgdef;
            $banner_c = $urlimgdef;
            $banner_d = $urlimgdef;
        }//end if
        
        
    ?>

<style type="text/css">
    body {
        overflow-x: hidden;
    }

    div.banner_a_section {
      padding-top: 10rem;
      padding-bottom: calc(10rem - 4.5rem);
      /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
      */
      /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
     
      /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
      background-image: url("<?php echo $banner_a?>") !important;
      

      
      background-repeat: no-repeat;
      background-attachment: scroll;
      background-size: 70% 100%;
      background-position: right;
      border-radius: 56px 0px 0px 0px;
    }
    div.banner_b_section_bg {
            
          /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
          */
          /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
         
          /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
          
          

          
          background-repeat: no-repeat;
          background-attachment: scroll;
          background-size: 67% 100%;
          background-position: right;
    }

    @media screen and (max-width: 1920px) and (min-width: 700px), (min-width: 1920px){
      div.banner_b_section {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
        */
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
       
        /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
        background-image: url("<?php echo $banner_b?>") !important;
        

        
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: 53% 100%;
        background-position: right;
        margin-right: 15%;
      }
    }

    @media screen and (max-width: 700px){
      div.banner_b_section {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
        */
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
       
        /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
        background-image: url("<?php echo $banner_b?>") !important;
        

        
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: 100% 100%;
        background-position: right;
        margin-right: 15%;
      }
    }

    /*MID SECTION*/
    @media screen and (max-width: 1920px) and (min-width: 900px), (min-width: 1920px){
      div.mid_section {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
        */
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/

        /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
        background-image: url('<?php echo $banner_c?>') !important;

        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: 70% 100%;
        background-position: left;

      }
    }

    @media screen and (max-width: 900px){
      div.mid_section {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
        */
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/

        /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
        background-image: url('<?php echo $banner_c?>') !important;

        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        /* background-size: 100% 100%; */
        background-position: left;

      }
    }
    /*END MID SECTION*/

    /*JOB LIST SECTION*/
    div.job_list_section {
      /* padding-top: 10rem; */
      padding-bottom: calc(10rem - 4.5rem);
      /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
      */
      /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/

      /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
      background-image: url('<?php echo $banner_d?>') !important;

      background-position: left;
      background-repeat: no-repeat;
      background-attachment: scroll;
      background-size: 50% 70%;
    }

    @media screen and (max-width: 900px){
      div.job_list_section {
        /* padding-top: 10rem; */
        padding-bottom: calc(10rem - 4.5rem);
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../../../assets/img/news-bg.jpg");
        */
        /*background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/

        /*background-image: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);*/
        background-image: url('<?php echo $banner_d?>') !important;

        background-position: left;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
      }
    }
    /*END JOB LIST SECTION*/
</style>

<style type="text/css">
    

    /* display 3 */
    @media screen and (max-width: 1440px) and (min-width: 1290px), (min-width: 1440px), (max-width: 480px){
    

    /*@media (min-width: 900px) {*/

        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
          transform: translateX(100%);
        }

        .carousel-inner .carousel-item-left.active, 
        .carousel-inner .carousel-item-prev {
          transform: translateX(-100%);
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left{ 
            transform: translateX(0);
        }
    }

    


</style>

<!-- template -->
    
	<!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3">
        <div class="container px-4 px-lg-5 navbarcontainer">

            
            <a class="navbar-brand fw-bolder text-link" href="<?php echo base_url(); ?>"><h2>Hoteleers</h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    
                </div>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 desktop-navbar-nav">
                    <?php if(!isset($_SESSION['userid'])){?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted active header-navbtn" aria-current="page" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                        
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>

                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="<?php echo base_url('signup'); ?>">Sign up</a></li>
                    <?php }else{?>
                        <?php if($_SESSION['usertype'] === 'applicant'){?>
                            <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted pr-0 header-navbtn header-findjobbtn desktop-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a></li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] === 'employer'){?>
                            <li class="nav-item"><a class="nav-link pr-0 header-navbtn header-findapplicantbtn" href="<?php echo base_url('active_jobs/'); ?>">
                                <i class="fas fa-search fa-sm fa-fw text-gray-400"></i><i class="fa fa-home" aria-hidden="true" style="font-size: 25px;padding-right: 20px;"></i></a>
                            </li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] == 'admin') {?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted pr-0 header-navbtn" aria-current="page" href="<?php echo base_url('home'); ?>">Admin Dashboard</a></li>
                        <?php }?>
                    <?php }?>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 mobile-navbar-nav">
                    <?php if(!isset($_SESSION['userid'])){?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted active header-navbtn" aria-current="page" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                        
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>

                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="<?php echo base_url('signup'); ?>">Sign up</a></li>
                    <?php }else{?>
                        <?php if($_SESSION['usertype'] === 'applicant'){?>
                            <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted pr-0 header-navbtn header-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a></li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] === 'employer'){?>
                            <li class="nav-item"><a class="nav-link pr-0 header-navbtn header-findapplicantbtn" href="<?php echo base_url('active_jobs/'); ?>">
                                <i class="fas fa-search fa-sm fa-fw text-gray-400"></i><i class="fa fa-home" aria-hidden="true" style="font-size: 25px;"></i></a>
                            </li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] == 'admin') {?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted pr-0 header-navbtn" aria-current="page" href="<?php echo base_url('home'); ?>">Admin Dashboard</a></li>
                        <?php }?>
                    <?php }?>
                </ul>
                
            </div>
        </div>
    </nav>



	<!-- Header-->
    <header class="desktop-lock">        
        
            <div class="text-left mb-4">
                <div class="row">
                    <div class="col-12 banner_a_section home-row1banner">
                        <div class="mobile-overlay"></div>
                        <div class="mobile-homerow1">
                            <div class="row">
                                <div class="col-1 desktop-homespacer1"></div>
                                <div class="col-xl-10 col-lg-12 col-md-12 col-sm-11 col-xs-11 align-self-center">
                                    <h5 class="display-5 text-link mb-0 home-rowhead">Explore Careers</h5>
                                    <h5 class="display-5 fw-bolder text-link mb-3 home-rowbold"><?php echo $banner_a_title?></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1 desktop-homespacer1"></div>
                                <div class="col-xl-3 col-lg-12 col-md-12 col-xs-11 col-sm-11 align-self-center">
                                    
                                    <p class="lead fw-normal mb-0 home-row1desc" style="max-width:480px;font-size:11pt;"><?php echo $banner_a_desc?></p>
                                </div><!--/div.col-->
                            </div>
                    
                            <div class="row">
                                    <div class="col-1 mobile-homerow1spacer desktop-homespacer1"></div>
                                    <div class="col-xl-3 col-lg-3 col-md-5 col-xs-11 col-sm-11 align-self-center findjob-col">
                                        <div class="input-group input-group-md my-3 findjob-bar">
                                        <input name="header[find_job_search]" type="text" class="form-control findjob-input" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button name="header[btn_find_job]" class="btn btn-primary btn-md pl-4 pr-4 findjob-btn" type="button">Find Jobs</button>
                                        </div><!--/div.input-group-->
                                        </div><!--/div.input-group--> 
                                    </div>
                            </div>
                       </div>
                    
                    </div>
                   
                </div> <!--/div.row-->
            </div><!--/div-->
        
    </header><!--/header-->

    <div class="py-5 mb-4 mobile-rowmid desktop-lock">
        <div class="row mid_section home-rowmid reveal ani-bgx">
            <div class="mobile-overlayrow2"></div>

            <div class="col-xl-7 col-lg-7 col-md-7 home-row2firstcol">

            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 home-row2col">
                

                    <div class="pb-5 home-row2div reveal fade-in-right">
                        <h5 class="display-5 text-link mb-0 reveal fade-in-right">Curated only for</h5>
                        <h5 class="display-5 text-link text-break fw-bolder mb-3 home-row2divtitle reveal fade-in-right"><?php echo $banner_c_title?></h5>
                        <p class="lead fw-normal mb-0 home-row2desc reveal fade-in-bottom" style="max-width:450px;font-size:11pt;"><?php echo $banner_c_desc?></p>
                    </div>
                
                
            </div>
        </div>
    </div>
    



    <div class="py-5 mb-4 home-jobsdivrow desktop-lock">        
            <div class="text-left">
                <div class="mobile-overlayjobs"></div>
                <div class="row job_list_section home-rowjobs reveal ani-bgx">
                    
                    <div class="col-xl-2 align-self-start">
                        
                    </div><!--/div.col style="left:-0.5in;position:absolute;" -->  

                    <div class="col-xl-10">
                        <a href="<?php echo base_url('trending_jobs')?>" style="text-decoration:none;"><h4 class="text-center text-link text-break mobile-homejobsheader reveal fade-in-top">Trending Jobs</h4></a>
                        <div class="container my-3 home-jobscontainer reveal fade-in-fwd">

                            <div class="row mx-auto my-auto">
                                <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                                    <div id="trending_jobs_container" class="carousel-inner mb-3" role="listbox">
                                    </div>

                                    <div class="col-xl-12 col-lg-12 text-center mobile-hometrending">
                                        <a class="btn btn-pill-2x btn-pill-sm-outline-light text-primary mr-2 home-carouselbtns" href="#recipeCarousel" role="button" data-slide="prev">
                                            <i class="fa fa-chevron-left "></i>
                                        </a>
                                        <a class="btn btn-pill-2x btn-pill-sm-outline-light text-primary home-carouselbtns" href="#recipeCarousel" role="button" data-slide="next">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </div><!--/div.col-->
                </div> <!--/div.row-->
            </div><!--/div-->

       
    </div><!--/header-->


    <!-- Header-->
    <header class="py-5 home-row3 desktop-lock reveal ani-bgx">        
        
            <div class="text-left banner_b_section_bg home-row3bannerbg">
                <div class="row">

                    <div class="col-12 col-xl-12 col-lg-12 banner_b_section home-row3bannerimg">
                        <div class="home-row3div">
                            <div class="row mobile-row3-1">
                                <div class="col-1 desktop-homespacer"></div>
                                <div class="col-xl-5 col-lg-5 col-md-11 col-sm-11  col-xs-11 align-self-center mobile-homerow3 reveal fade-in-left">
                                    <h4 class="display-4 text-link mb-0">Looking for</h4>
                                    <h4 class="display-4 fw-bolder text-link text-break mb-3"><?php echo $banner_b_title?></h4>

                                </div>
                            </div>
                            <div class="row mobile-row3-2">
                                <div class="col-1 desktop-homespacer"></div>
                                <div class="col-xl-4 col-lg-4 col-md-11 col-xs-11 col-sm-11 align-self-center mobile-homerow3 reveal fade-in-bottom">
                                    
                                    <p class="lead fw-normal mb-0 home-row3desc" style="max-width:520px;font-size:11pt;"><?php echo $banner_b_desc?></p>

                                </div><!--/div.col-->
                            </div>
                        </div>
                     
                    
                    </div>


                    

                    
                    
                </div> <!--/div.row-->

            </div><!--/div-->
        
    </header><!--/header-->


   


    

    <!-- Copyright -->
    <?php require_once('app/Views/libraries/copyright.php'); ?>
    <!-- Copyright -->


  <!-- Footer Menu -->
  <?php require_once('app/Views/libraries/footer-menu.php'); ?>
  <!-- Footer Menu -->




<?php require_once('app/Views/libraries/footer.php'); ?>



<script type="text/javascript">
    var user_id = <?php echo isset($_SESSION['userid'])?$_SESSION['userid']:0; ?>;

    
    $('#recipeCarousel').on('slide.bs.carousel', function (e) {

      var $e = $(e.relatedTarget);
      
      var idx = $e.index();
      console.log("IDX :  " + idx);
      
      var itemsPerSlide = 3;
      var totalItems = $('.carousel-item').length;
      
      
      if (idx >= totalItems-(itemsPerSlide-1)) {
          var it = itemsPerSlide - (totalItems - idx);
          for (var i=0; i<it; i++) {
              // append slides to end
              if (e.direction=="left") {
                  $('.carousel-item').eq(i).appendTo('.carousel-inner');
              }
              else {
                  $('.carousel-item').eq(0).appendTo('.carousel-inner');
              }
          }
      }
  });


</script>


<script src="<?php echo base_url('assets/main/js/main.js?v='). date('Ymdi') ?>"></script>

