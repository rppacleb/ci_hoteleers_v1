<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 pt-3">
    <div class="container px-4 px-lg-5 navbarcontainer">

        <a class="navbar-brand fw-bolder text-link" href="<?php echo base_url(); ?>"><h2>Hoteleers</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class=" me-auto ">

            </div>
           
            <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 mr-2">
                <!--<li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php //echo base_url('home'); ?>">Home</a></li>-->
                <?php if(isset($_SESSION['userid'])){?>
                    <?php if($_SESSION['usertype'] === 'applicant'){?>
                        <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn header-findjobbtn desktop-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a></li>
                    <?php }?>

                    <!-- <?php if($_SESSION['usertype'] === 'employer'){?>
                        <li class="nav-item"><a class="nav-link header-navbtn header-findapplicantbtn" href="<?php echo base_url('active_jobs/'); ?>">
                            <i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Employer Dashboard</a>
                        </li>
                    <?php }?> -->
                <?php }else{?>

                <?php }?>
            </ul>
        
            <?php

                function checkRemoteFile($url){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$url);
                    // don't download content
                    curl_setopt($ch, CURLOPT_NOBODY, 1);
                    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    $result = curl_exec($ch);
                    curl_close($ch);
                    if($result !== FALSE){
                        return true;
                    }else{
                        return false;
                    }//end if
                }

                if(isset($_SESSION['usertype'])){
                    if($_SESSION['usertype'] === 'employer'){
                        if(!isset($_SESSION['employer_doc_image']) || $_SESSION['employer_doc_image'] == ""){
                            $upload_path = base_url() .  '/files/images/default/image.png';
                        }else{
                            $upload_path = base_url() . '/files/uploads/' . $_SESSION['employer_doc_image']; 
                        }//end if
                    }else{
                        if(!isset($_SESSION['doc_image']) || $_SESSION['doc_image'] == ""){
                            $upload_path = base_url() . '/files/images/default/user.png';
                        }else{
                            $upload_path = base_url() . '/files/uploads/' . $_SESSION['doc_image']; 
                        }//end if
                    }//end if

                    if(isset($_SESSION['doc_image']) && $_SESSION['doc_image'] !== ""){
                        if(!checkRemoteFile($upload_path)){
                            $upload_path = base_url() . '/assets/img/main/image-not-found.svg'; 
                        }//end if
                    }//end if
                    
                }//end if
                

            ?>
            <?php if(isset($_SESSION['userid'])){?>
                <!-- show home button on selected pages -->
                <?php if($_SESSION['usertype'] == 'employer') {?>
                    <?php
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                        $protocol = 'https';
                    } else {
                        $protocol = 'http';
                    }
                
                    $currentURL = $protocol."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                    $URL1 = "/job_search/private";
                    $URL2 = "/company_info_public/view";
                    if (
                        (strpos($currentURL,base_url($URL1)) === 0||$currentURL === base_url($URL1)."*")||
                        (strpos($currentURL,base_url($URL2)) === 0||$currentURL === base_url($URL2)."*")
                       ) {
                    ?>
                        <a class="nav-link pr-0 header-navbtn topnav-homebtn" href="<?php echo base_url('active_jobs/'); ?>">
                        <i class="fa fa-home fa-sm fa-fw text-gray-400" aria-hidden="true" style="font-size: 25px;"></i>
                        </a>
                    <?php } ?>

                <?php }?>
                <!-- end show home button on selected pages -->
                <ul class="navbar-nav">
                    <?php if($_SESSION['usertype'] == 'applicant') {?>
                        
                        <li class="nav-item dropdown no-arrow align-self-center">
                            
                            <a class="nav-link notification2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <img style="width:0.2in;height:0.2in;" src="<?php echo base_url().'/assets/img/main/bell-svgrepo-com.svg' ?>" /> 
                                <span class="d-none notification-counter badge badge-pill badge-dark">0</span>
                            </a>

                            <div id="dropdown_notification" class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenuButton" style="min-width:3in;">
                                
                            </div>

                        </li>
                    <?php }?>
                    
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <small class="text-muted mr-2 align-middle" style="font-size: 15px !important;"><?php echo $_SESSION['name']?></small>
                            <img style="width:0.5in;height:0.5in;" src="<?php echo $upload_path;?>" class="rounded-circle align-middle" alt=""></span>
                      </a>

                     

                      
                      <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in header-dropdownbox desktop-tbdropdown" aria-labelledby="userDropdown">
                        <?php if($_SESSION['usertype'] == 'applicant') {?>
                            <a href="<?php echo base_url('applicant_info/view/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <a href="<?php echo base_url('change_pass'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-user fa-sm fa-lock mr-2 text-gray-400"></i> Change Password
                            </a>

                            <a href="<?php echo base_url('job_application/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-folder-open fa-sm fa-fw mr-2 text-gray-400"></i> Applications
                            </a>

                            <a href="<?php echo base_url('saved_jobs/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i> Saved Jobs
                            </a>

                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == 'employer') {?>
                            <a class="dropdown-item header-dropdown" href="<?php echo base_url('company_info/view/'.$_SESSION['employer'].''); ?>"><i class="fa fa-building fa-sm mr-2" aria-hidden="true"></i> Company Profile</a>
                            <a href="<?php echo base_url('change_pass'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sm fa-lock mr-2 text-gray-400"></i> Change Password
                            </a>
                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 w-auto"></i> Logout
                            </a>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == 'admin') {?>
                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        <?php }?>
                      </div>
                      
                      <div class="mobile-tbdropdown">
                        <?php if($_SESSION['usertype'] == 'applicant') {?>
                            <a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn header-findjobbtn mobile-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a>
                            <a href="<?php echo base_url('applicant_info/view/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <a href="<?php echo base_url('change_pass'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-user fa-sm fa-lock mr-2 text-gray-400"></i> Change Password
                            </a>

                            <a href="<?php echo base_url('job_application/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-folder-open fa-sm fa-fw mr-2 text-gray-400"></i> Applications
                            </a>

                            <a href="<?php echo base_url('saved_jobs/'.$_SESSION['userid'].''); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-heart fa-sm fa-fw mr-2 text-gray-400"></i> Saved Jobs
                            </a>

                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == 'employer') {?>
                            <a class="dropdown-item header-dropdown" href="<?php echo base_url('company_info/view/'.$_SESSION['employer'].''); ?>"><i class="fa fa-building fa-sm mr-2" aria-hidden="true"></i> Company Profile</a>
                            <a href="<?php echo base_url('change_pass'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sm fa-lock mr-2 text-gray-400"></i> Change Password
                            </a>
                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 w-auto"></i> Logout
                            </a>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == 'admin') {?>
                            <a href="<?php echo base_url('home/logout/'); ?>" class="dropdown-item header-dropdown">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        <?php }?>
                      </div>
                    </li>
                </ul>
            <?php }else{?>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                    <?php if(!isset($_SESSION['userid'])){?>
                        <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('job_search/private/'); ?>">Find Jobs</a></li>
                        
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" href="<?php echo base_url('login/'); ?>">Login</a></li>

                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-signupbtn" href="<?php echo base_url('signup'); ?>">Sign up</a></li>
                    <?php }else{?>
                        <?php if($_SESSION['usertype'] === 'applicant'){?>
                            <li id="job_search" class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn header-findjobbtn desktop-findjobbtn" href="<?php echo base_url('job_search/private/'); ?>"><i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Find Jobs</a></li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] === 'employer'){?>
                            <li class="nav-item"><a class="nav-link header-navbtn header-findapplicantbtn" href="<?php echo base_url('active_jobs/'); ?>">
                                <i class="fas fa-search fa-sm fa-fw text-gray-400"></i>Employer Dashboard</a>
                            </li>
                        <?php }?>

                        <?php if($_SESSION['usertype'] == 'admin') {?>
                        <li class="nav-item"><a class="btn btn-pill-sm-no-brdr btn-sm text-muted header-navbtn" aria-current="page" href="<?php echo base_url('home'); ?>">Admin Dashboard</a></li>
                        <?php }?>
                    <?php }?>
                </ul>
            <?php }?>
        </div>
    </div>
</nav>

<br/><br/><br/>
<div class="container-fluid" style="min-height:100%;">
    

    <div class="row">
        <!--<div class="collapse navbar-collapse" id="navbarSupportedContent2">-->
            <div id="side_menu" class="align-self-start mb-5 col-xl-2 col-lg-2 col-md-11 col-xs-11 pt-5 mt-4">
            <?php if(isset($_SESSION['userid'])){?>
                
                    <nav class="nav flex-column nav-pills">
                      <?php if($_SESSION['usertype'] !== 'applicant') {?>
                        
                      <?php }?>

                    <?php if($_SESSION['usertype'] == 'admin') {?>
                        <!--<a class="nav-link text-muted" href="<?php //echo base_url('home/'); ?>"><small><i class="fa fa-home" aria-hidden="true"></i> Home</small></a>-->

                        
                            <div class="row">
                                <div class="col-10 align-self-center">
                                    <a id="side_account_management" class="nav-link text-muted" href="<?php echo base_url('account_management/'); ?>" >
                                        <small><i class="fa fa-cubes" aria-hidden="true"></i> Account Management </small>
                                    </a>
                                </div>
                                <div class="col align-self-center">
                                    <a id="collapse_link" data-toggle="collapse" href="#side_account_management_collapse" role="button" aria-expanded="false" aria-controls="side_account_management_collapse">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                            </div>
                            
                            
                            
                        

                        <div  class="collapse" id="side_account_management_collapse">
                            <a id="side_account_management_prospect" class="nav-link text-muted pl-5" href="<?php echo base_url('prospect/'); ?>">
                                <small>
                                    Prospect 
                                    <span class="font-9 notification ml-2 badge badge-pill badge-secondary badge_prospect font-weight-normal">0</span>
                                </small>
                            </a>
                            <a id="side_account_management_active" class="nav-link text-muted pl-5" href="<?php echo base_url('active/'); ?>"><small>Active <span class="font-9 notification ml-2 badge badge-pill badge-secondary badge_active font-weight-normal">0</span></small></a>
                            <a id="side_account_management_inactive" class="nav-link text-muted pl-5" href="<?php echo base_url('inactive/'); ?>"><small>Inactive <span class="font-9 notification ml-2 badge badge-pill badge-secondary badge_inactive font-weight-normal">0</span></small></a>
                            <a id="side_account_management_paused" class="nav-link text-muted pl-5" href="<?php echo base_url('paused/'); ?>"><small>Paused <span class="font-9 notification ml-2 badge badge-pill badge-secondary badge_paused font-weight-normal">0</span></small></a>
                        </div>
                        
                        <a id="side_partner_application" class="nav-link text-muted d-none" href="<?php echo base_url('partner_application/'); ?>"><small><i class="fa fa-cubes" aria-hidden="true"></i> Partner Applications</small></a>
                        
                        
                        <a id="side_employers" class="nav-link text-muted d-none" href="<?php echo base_url('employer/'); ?>"><small><i class="fa fa-user-circle" aria-hidden="true"></i> Employers</small></a>
                        <a id="side_homepage_banner" class="nav-link text-muted" href="<?php echo base_url('homepage_banner/'); ?>"><small><i class="fa fa-image" aria-hidden="true"></i> Homepage Banner</small></a>

                        <a id="side_manage_dropdown" class="nav-link text-muted" href="<?php echo base_url('manage_dropdown/'); ?>"><small><i class="fa fa-list" aria-hidden="true"></i> Manage dropdown lists</small></a>
                        <!--<a class="nav-link text-muted" href="#" data-toggle="collapse" data-target="#collapseOne"><small><i class="fa fa-cogs" aria-hidden="true"></i> Administration</small></a>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="container">
                                <a href="<?php //echo base_url('manage_employer/'); ?>" class="nav-link text-muted"><small><i class="fa fa-user" aria-hidden="true"></i> Manage Employers</small></a>
                            </div>
                            <div class="container">
                                <a href="#" class="nav-link text-muted"><small>Test</small></a>
                            </div>
                        </div>-->
                    <?php }?>

                    <?php if($_SESSION['usertype'] == 'employer') {?>
                        <a id="side_active_jobs" class="nav-link text-muted fs15" href="<?php echo base_url('active_jobs'); ?>"><small class="sidemenu-links"><i class="fa fa-cubes" aria-hidden="true" style="font-size: 13px;"></i><span>Home</span></small></a>

                        <a id="side_schedule" class="nav-link text-muted fs15" href="<?php echo base_url('schedule'); ?>"><small class="sidemenu-links"><i class="fa fa-calendar-check" aria-hidden="true"></i><span>Interviews</span></small></a>

                        <a id="side_create_jp" class="nav-link text-muted fs15" href="<?php echo base_url('job_post/add/0?isActive=1'); ?>"><small class="sidemenu-links"><i class="fa fa-pencil" aria-hidden="true"></i><span>Create Job Post</span></small></a>

                        <a id="side_drafts_template" class="nav-link text-muted fs15" href="<?php echo base_url('job_post'); ?>"><small class="sidemenu-links"><i class="fa fa-sticky-note" aria-hidden="true"></i><span>Drafts and Templates</span></small></a>

                        <a id="side_talent_database" class="nav-link text-muted fs15" href="<?php echo base_url('applicant_search/private'); ?>"><small class="sidemenu-links"><i class="fa fa-database" aria-hidden="true"></i><span>Talent Database</span></small></a>

                        <a id="side_saved_profile" class="nav-link text-muted fs15" href="<?php echo base_url('saved_profile'); ?>"><small class="sidemenu-links"><i class="fa fa-address-book" aria-hidden="true"></i><span>Saved Profiles</span></small></a>

                        <a id="side_hired_jobs" class="d-none nav-link text-muted fs15" href="<?php echo base_url('closed_jobs'); ?>"><small class="sidemenu-links"><i class="fa fa-check-square" aria-hidden="true"></i><span>Hired Jobs</span></small></a>

                        <a id="side_deactivated" class="d-none nav-link text-muted fs15" href="<?php echo base_url('deactivated_jobs'); ?>"><small class="sidemenu-links"><i class="fa fa-times-circle" aria-hidden="true"></i><span>Deactivated</span></small></a>

                        <a id="side_insight" class="nav-link text-muted fs15" href="<?php echo base_url('Insights'); ?>"><small class="sidemenu-links"><i class="fa fa-copy" aria-hidden="true"></i><span>Insights</span></small></a>
                        
                        
                        
                        

                        

                        

                        

                    <?php }?>

                    <?php if($_SESSION['usertype'] == 'applicant') {?>
                        <!--<a class="nav-link text-muted" href="<?php //echo base_url('applicant_info/view/'.$_SESSION['userid'].''); ?>"><small><i class="fa fa-user" aria-hidden="true"></i> User Profile</small></a>-->
                        

                    <?php }?>
                    </nav>
                
            <?php }?>
            </div><!--./col-->
        <!--</div>-->
        <div id="right-menu" class="align-self-start col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <!--Start of Content-->