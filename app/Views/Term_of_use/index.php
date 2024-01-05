<?php require_once('app/Views/libraries/header.php'); ?>
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php
    $about_us_desc = '';
    if(count($home_page_banner)>0){
        $about_us_desc     = $home_page_banner[0]["terms_of_use"];
    
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

    
    <div class="row mt-5 justify-content-center" style="min-height:60vh;">
        <div class="col-xl-6 col-lg-6 col-auto">
            <?php echo $about_us_desc; ?>
        </div>
    </div>

	

    <div class="pb-5 d-none">

        <!-- <div class="row mb-5 privacybanner"> -->
        <div class="row mb-5 ">
            <div class="row desktop-lock">
            <div class="col-2 mobile-privspacer"></div>

            <div class="col text-left privacycol">
                <!-- <h3 class="privacyhead">Terms of Use</h3> -->
                <h3 style="padding-top: 2rem;">Terms of Use</h3>
            </div>

            <div class="col-2 mobile-privspacer"></div>
            </div>
        </div>
        
            
        
            <div class="row desktop-lock">
                <div class="col-2 mobile-privspacer"></div>
                <div class="col">
                    
                    <div class="card privacycard">

                        <div class="card-body">
                            
                        
                            <div class="pb-5 text-justify">
                                
                                
                                <p class="fw-normal mb-3">Our Terms of Use were last updated on September 4, 2022.</p>
                                <p class="fw-normal mb-3">Please read these Terms of Use carefully before using Our Service.</p>


                                <h3>Interpretation and Definitions</h3>
                                <h3>Interpretation</h3>
                                <p class="fw-normal mb-3">The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in the singular or in the plural.
                                </p>
                                <h3>Definitions</h3>
                                <p class="fw-normal mb-3">For the purposes of these Terms of Use:</p>
                                <p class="fw-normal mb-3">
                                    <ul>
                                        <li>“Affiliate” means an entity that controls, is controlled by, or is under common control with a party, whereas "control" means ownership of 50% or more of the shares, equity interest, or other securities entitled to vote for the election of directors or other managing authority.</li>
                                        <li>“Account” means a unique account created for You to access our Service or parts of our Service.</li>
                                        <li>“Company” (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Butteredfly Inc, 122 Valero Street Salcedo Village Ber-Air Makati City, NCR 1227</li>
                                        <li>“Country” refers to the Republic of the Philippines.</li>
                                        <li>“Content” refers to content such as text, images, or other information that can be posted, uploaded, linked to, or otherwise made available by You, regardless of the form of that content.</li>
                                        <li>“Device” means any device that can access the Service such as a computer, a cellphone, or a digital tablet.</li>
                                        <li>“Feedback” means feedback, innovations, or suggestions sent by You regarding the attributes, performance, or features of our Service.</li>
                                        <li>“Service” refers to the Website.</li>
                                        <li>“Terms of Use” (also referred to as "Terms") mean these Terms of Use that form the entire agreement between You and the Company regarding the use of the Service. </li>
                                        <li>“Third-party Social Media Service” means any services or content (including data, information, products, or services) provided by a third-party that may be displayed, included, or made available by the Service.</li>
                                        <li>“Website” refers to Hoteleers, accessible from www.hoteleers.com</li>
                                        <li>“You” means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>

                                    </ul>
                                </p>

                                <h3>Acknowledgment</h3>
                                <p class="fw-normal mb-3">These are the Terms of Use governing this Service’s use and the agreement between You and the Company. These Terms of Use set out the rights and obligations of all users regarding the use of the Service.</p>
                                <p class="fw-normal mb-3">Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms of Use. These Terms of Use apply to all visitors, users, and others who access or use the Service.</p>
                                <p class="fw-normal mb-3">By accessing or using the Service You agree to be bound by these Terms of Use. If You disagree with any part of these Terms of Use then You may not access the Service.</p>
                                <p class="fw-normal mb-3">You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>
                                <p class="fw-normal mb-3">Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use, and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>

                                
                                <h3>User Accounts</h3>
                                <p class="fw-normal mb-3">When You create an account with Us, You must provide Us with accurate information. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of Your account on Our Service.</p>
                                <p class="fw-normal mb-3">You are responsible for safeguarding the password that You use to access the Service and for any activities or actions under Your password, whether Your password is with Our Service or a Third-Party Social Media Service.</p>
                                <p class="fw-normal mb-3">You agree not to disclose Your password to any third party. You must notify Us immediately upon becoming aware of any breach of security or unauthorized use of Your account.</p>
                                <p class="fw-normal mb-3">You may not use as a username the name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of another person or entity other than You without appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.</p>

                                <h3>Content</h3>
                                <h3>Your Right to Post Content</h3> 
                                <p class="fw-normal mb-3">Our Service allows You to post Content on your profile. You are responsible for the Content that You post to the Service, including its legality, reliability, and appropriateness.</p>
                                <p class="fw-normal mb-3">By posting Content to the Service, You grant Us the right to promote and distribute such Content on and through the Service with employer clients or recruitment companies or professionals, and related business partners as such with any job portal. You retain any and all of Your rights to any Content You submit, post, or display on or through the Service and You are responsible for protecting those rights. You agree that this license includes the right for Us to make Your Content available to business partners of the Service, who may also use Your Content subject to these Terms.</p>
                                <p class="fw-normal mb-3">You represent and warrant that: (i) the Content is Yours (You own it) or You have the right to use it and grant Us the rights and license as provided in these Terms, and (ii) the posting of Your Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any person.</p>
                                


                                <h3>Content Restrictions</h3>
                                <p class="fw-normal mb-3">The Company is not responsible for the content of the Service's users. You expressly understand and agree that You are solely responsible for the Content and for all activity that occurs under your account, whether done so by You or any third person using Your account.</p>
                                <p class="fw-normal mb-3">You may not transmit any unlawful Content, offensive, upsetting, intended to disgust, threatening, libelous, defamatory, obscene, or otherwise objectionable. Examples of such objectionable Content include, but are not limited to, the following:</p>
                                <ul>
                                    <li>Unlawful or promoting unlawful activity.</li>
                                    <li>Defamatory, discriminatory, or mean-spirited content, including references or commentary about religion, race, sexual orientation, gender, national/ethnic origin, or other targeted groups.</li>
                                    <li>Spam, machine – or randomly – generated, constituting unauthorized or unsolicited advertising, chain letters, any other form of unauthorized solicitation, or any form of lottery or gambling.</li>
                                    <li>Containing or installing any viruses, worms, malware, trojan horses, or other content that is designed or intended to disrupt, damage, or limit the functioning of any software, hardware, or telecommunications equipment or to damage or obtain unauthorized access to any data or other information of a third person.</li>
                                    <li>Infringing on any proprietary rights of any party, including patent, trademark, trade secret, copyright, right of publicity, or other rights.</li>
                                    <li>Impersonating any person or entity including the Company and its employees or representatives.</li>
                                    <li>Violating the privacy of any third person.</li>
                                    <li>False information and features.</li>
                                </ul>
                                <p class="fw-normal mb-3">The Company reserves the right, but not the obligation, to, in its sole discretion, determine whether or not any Content is appropriate and complies with these Terms, refuse or remove this Content. The Company further reserves the right to make formatting and edits and change the manner of any Content. The Company can also limit or revoke the use of the Service if You post such objectionable Content. As the Company cannot control all content posted by users and/or third parties on the Service, you agree to use the Service at your own risk. You understand that by using the Service You may be exposed to content that You may find offensive, indecent, incorrect, or objectionable, and You agree that under no circumstances will the Company be liable in any way for any content, including any errors or omissions in any content, or any loss or damage of any kind incurred as a result of your use of any content.</p>

                                
                                <h3>Content Backups</h3>
                                <p class="fw-normal mb-3">Although regular backups of Content are performed, the Company does not guarantee there will be no loss or corruption of data.</p>
                                <p class="fw-normal mb-3">Corrupt or invalid backup points may be caused by, without limitation, Content that is corrupted prior to being backed up or that changes during the time a backup is performed.</p>
                                <p class="fw-normal mb-3">The Company will provide support and attempt to troubleshoot any known or discovered issues that may affect the backups of Content. But You acknowledge that the Company has no liability related to the integrity of Content or the failure to successfully restore Content to a usable state.</p>
                                <p class="fw-normal mb-3">You agree to maintain a complete and accurate copy of any Content in a location independent of the Service.</p>
                                <h3>Your Information</h3>
                                <p class="fw-normal mb-3">If You wish to apply for a job available on the Service, You may be asked to supply certain information relevant to Your application including, without limitation, Your name, Your email, Your phone number, previous work experiences, education, skills, and other pertinent information.</p>
                                <p class="fw-normal mb-3">By submitting such information, You grant us the right to provide the information to employer clients or recruitment companies or professionals, and related business partners as such with any job portal for purposes of facilitating the process of Your applications.</p>
                                <h3>Errors and Inaccuracies</h3>
                                <p class="fw-normal mb-3">We are constantly updating information on the Service. The information available on Our Service may be described inaccurately, or unavailable, and We may experience delays in updating information regarding our products on the Service and in Our advertising on other websites.</p>
                                <p class="fw-normal mb-3">We cannot and do not guarantee the accuracy or completeness of any information, product images, specifications, availability, and services. We reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice.</p>
                                <h3>Intellectual Property</h3>
                                <p class="fw-normal mb-3">The Service and its original content (excluding Content provided by You or other users), features, and functionality are and will remain the exclusive property of the Company and its licensors.</p>
                                <p class="fw-normal mb-3">The Service is protected by copyright, trademark, and other laws of both the Country and foreign countries.</p>
                                <p class="fw-normal mb-3">Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of the Company.</p>
                                <h3>Your Feedback to Us</h3>
                                <p class="fw-normal mb-3">You assign all rights, title, and interest in any Feedback You provide the Company. If for any reason such assignment is ineffective, You agree to grant the Company a non-exclusive, perpetual, irrevocable, royalty-free, worldwide right and license to use, reproduce, disclose, sub-license, distribute, modify and exploit such Feedback without restriction.</p>
                                <h3>Links to Other Websites</h3>
                                <p class="fw-normal mb-3">Our Service may contain links to third-party websites or services that are not owned or controlled by the Company.</p>
                                <p class="fw-normal mb-3">The Company has no control over and assumes no responsibility for, the content, privacy policies, or practices of any third-party websites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods, or services available on or through any such web sites or services.</p>
                                <p class="fw-normal mb-3">We strongly advise You to read the Terms of Use and privacy policies of any third-party websites or services that You visit.</p>
                                <h3>Termination</h3>
                                <p class="fw-normal mb-3">We may terminate or suspend Your Account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms of Use.</p>
                                <p class="fw-normal mb-3">Upon termination, Your right to use the Service will cease immediately. If You wish to terminate Your Account, You may simply discontinue using the Service.</p>


                                <h3>Limitation of Liability</h3>
                                <p class="fw-normal mb-3">To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
                                <h3>"As Is" and "As Available" Disclaimer</h3>
                                <p class="fw-normal mb-3">The Service is provided to You "AS IS" and "AS AVAILABLE" and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory, or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems, or services, operate without interruption, meet any performance or reliability standards or be error-free or that any errors or defects can or will be corrected.</p>
                                <p class="fw-normal mb-3">Without limiting the foregoing, neither the Company nor any of the company's providers make any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
                                <p class="fw-normal mb-3">Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>
                                <h3>Governing Law</h3>
                                <p class="fw-normal mb-3">The laws of the Republic of the Philippines, excluding its conflicts of law rules, shall govern these Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
                                <h3>Disputes Resolution</h3>
                                <p class="fw-normal mb-3">If You have any concerns or disputes about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>
                                <h3>For European Union (EU) Users</h3>
                                <p class="fw-normal mb-3">If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which you are resident in.</p>
                                <h3>The United States Legal Compliance</h3>
                                <p class="fw-normal mb-3">You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a "terrorist supporting" country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
                                <h3>Severability and Waiver</h3>
                                <h3>Severability</h3>
                                <p class="fw-normal mb-3">If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>
                                <h3>Waiver</h3>
                                <p class="fw-normal mb-3">Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Terms shall not affect a party's ability to exercise such right or require such performance at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.</p>
                                <h3>Changes to These Terms of Use</h3>
                                <p class="fw-normal mb-3">We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is a material We will make reasonable efforts to provide informed notice to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
                                <p class="fw-normal mb-3">By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.</p>


                                <h3 id="contact_us">Contact Us</h3>
                                <p class="fw-normal mb-3">If you have any questions about this Privacy Policy, You can contact us by email: admin@hoteleers.com</p>

                                
                            </div>
                        </div>
                     </div><!--./card--> 
                    
                </div>
                <div class="col-2 mobile-privspacer"></div>
            </div><!--./row-->
       
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


<script src="<?php echo base_url('assets/main/js/term_of_use.js?v='). date('Ymdi') ?>"></script>

