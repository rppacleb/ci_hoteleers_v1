<?php require_once('app/Views/libraries/header.php'); ?>
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php
    $about_us_desc = '';
    if(count($home_page_banner)>0){
        $about_us_desc     = $home_page_banner[0]["privacy_policy"];
    
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
                    <!-- <h3 class="privacyhead">Privacy Policy</h3> -->
                    <h3 style="padding-top: 2rem;">Privacy Policy</h3>
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
                                
                                <p class="fw-normal mb-3">Our Privacy Policy was last updated on September 4, 2022.
                                </p>
                                <p class="fw-normal mb-3">This Privacy Policy describes Our policies and procedures on the collection, use, and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.
                                </p>

                                
                                <p class="fw-normal mb-3">We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy.
                                </p>

                                <h3>Interpretation and Definitions</h3>
                                <h3>Interpretation</h3>
                                <p class="fw-normal mb-3">The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in the singular or in the plural.
                                </p>
                                <h3>Definitions</h3>
                                <p class="fw-normal mb-3">
                                    <ul>
                                        <li>“Account” means a unique account created for You to access our Service or parts of our Service.</li>
                                        <li>“Company” (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Butteredfly Inc, 122 Valero Street Salcedo Village Ber-Air Makati City, NCR 1227. </li>

                                        <li>“Cookies” are small files that are placed on Your computer, mobile device, or any other device by a website, containing the details of Your browsing history on that website among its many uses.</li>

                                        <li>“Country” refers to the Republic of the Philippines</li>

                                        <li>“Device” means any device that can access the Service such as a computer, a cellphone, or a digital tablet.</li>

                                        <li>“Personal Data” is any information that relates to an identified or identifiable individual.</li>

                                        <li>“Service” refers to the Website.</li>

                                        <li>“Service Provider” means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service, or to assist the Company in analyzing how the Service is used.</li>

                                        <li>“Usage Data” refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</li>

                                        <li>“Website” refers to Hoteleers, accessible from www.hoteleers.com</li>

                                        <li>“You” means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>

                                    </ul>
                                </p>

                                <h3>Collecting and Using Your Personal Data</h3>
                                <h3>Types of Data Collected</h3>
                                <p class="fw-normal mb-3">Personal Data</p>
                                <p class="fw-normal mb-3">While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You, including your profile as typical of a job portal. Personally, identifiable information may include, but is not limited to:</p>
                                <ul>
                                    <li>Email address</li>
                                    <li>First name and last name</li>
                                    <li>Phone number</li>
                                    <li>Address, State, Province, ZIP/Postal code, City</li>        
                                </ul>
                                <h3>Usage Data</h3>
                                <p class="fw-normal mb-3">Usage Data is collected automatically when using the Service.</p>
                                <p class="fw-normal mb-3">Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
                                <p class="fw-normal mb-3">
                                    When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device’s unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.
                                </p>
                                <p class="fw-normal mb-3">
                                    We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.
                                </p>
                                <h3>Tracking Technologies and Cookies</h3>
                                <p class="fw-normal mb-3">We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service. The technologies We use may include:</p>
                                <p class="fw-normal mb-3">Cookies or Browser Cookies. A cookie is a small file placed on Your Device. You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service. Unless you have adjusted Your browser setting so that it will refuse Cookies, our Service may use Cookies.</p>
                                <p class="fw-normal mb-3">Flash Cookies. Certain features of our Service may use local stored objects (or Flash Cookies) to collect and store information about Your preferences or Your activity on our Service. Flash Cookies are not managed by the same browser settings as those used for Browser Cookies. </p>
                                <p class="fw-normal mb-3">Web Beacons. Certain sections of our Service and our emails may contain small electronic files known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that permit the Company, for example, to count users who have visited those pages or opened an email and for other related website statistics (for example, recording the popularity of a certain section and verifying system and server integrity).</p>
                                <p class="fw-normal mb-3">Cookies can be; Persistent; or; Session Cookies. Persistent Cookies remain on Your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close Your web browser. </p>
                                <p class="fw-normal mb-3">We use both Session and Persistent Cookies for the purposes set out below:</p>
                                <p class="fw-normal mb-3">Necessary / Essential Cookies</p>
                                <p class="fw-normal mb-3">Type: Session Cookies</p>
                                <p class="fw-normal mb-3">Administered by: Us</p>
                                <p class="fw-normal mb-3">Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
                            
                                <h3>Cookies Policy / Notice Acceptance Cookies</h3>
                                <p class="fw-normal mb-3">Type: Persistent Cookies</p>
                                <p class="fw-normal mb-3">Administered by: Us</p>
                                <p class="fw-normal mb-3">Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>
                                <p class="fw-normal mb-3">Functionality Cookies</p>
                                <p class="fw-normal mb-3">Type: Persistent Cookies</p>
                                <p class="fw-normal mb-3">Administered by: Us</p>
                                <p class="fw-normal mb-3">Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>
                                
                                <h3>Use of Your Personal Data</h3>
                                <p class="fw-normal mb-3">The Company may use Personal Data for the following purposes:</p>
                                <p class="fw-normal mb-3">To provide and maintain our Service, including monitoring the usage of our Service.</p>
                                <p class="fw-normal mb-3">To manage Your Account: to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user, including the performance of hiring companies to search profiles for job application-related processes.</p>
                                <p class="fw-normal mb-3">For the performance of a contract: the development, compliance, and undertaking of the purchase contract for the products, items, or services You have purchased or of any other contract with Us through the Service.</p>
                                <p class="fw-normal mb-3">To contact You: To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products, or contracted services, including the security updates, when necessary or reasonable for their implementation.</p>
                                <p class="fw-normal mb-3">To provide you with news, special offers, and general information about other goods, services, and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.</p>
                                <p class="fw-normal mb-3">To manage Your requests: To attend and manage Your requests to Us.</p>
                                <p class="fw-normal mb-3">For business transfers: We may use Your information to evaluate or conduct a merger, divestiture, restructuring, reorganization, dissolution, or other sale or transfer of some or all of Our assets, whether as a going concern or as part of bankruptcy, liquidation, or similar proceeding, in which Personal Data held by Us about our Service users is among the assets transferred.</p>
                                <p class="fw-normal mb-3">For other purposes: We may use Your information for other purposes, such as data analysis, identifying usage trends, determining the effectiveness of our promotional campaigns, and to evaluate and improve our Service, products, services, marketing, and your experience.</p>
                                <p class="fw-normal mb-3">We may share Your personal information in the following situations:</p>
                                <p class="fw-normal mb-3">With Service Providers: We may share Your personal information with Service Providers to monitor and analyze the use of our Service, to contact You.</p>
                                <p class="fw-normal mb-3">For business transfers: We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of Our business to another company.</p>
                                <p class="fw-normal mb-3">With Affiliates: We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners, or other companies that We control or that are under common control with Us.</p>
                                <p class="fw-normal mb-3">With business partners: We may share Your information with Our business partners to offer You certain products, services, or promotions.</p>
                                <p class="fw-normal mb-3">With Your consent: We may disclose Your personal information for any other purpose with Your consent.</p>


                                <h3>Retention of Your Personal Data</h3>
                                <p class="fw-normal mb-3">The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p>
                                <p class="fw-normal mb-3">The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer periods.</p>
                                <h3>Transfer of Your Personal Data</h3>
                                <p class="fw-normal mb-3">Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country, or other governmental jurisdiction where the data protection laws may differ from those of Your jurisdiction.</p>
                                <p class="fw-normal mb-3">Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.</p>
                                <p class="fw-normal mb-3">The Company will take all steps reasonably necessary to ensure that Your data is treated securely and by this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.</p>
                                <h3>Disclosure of Your Personal Data</h3>
                                <h3>Business Transactions</h3>
                                <p class="fw-normal mb-3">If the Company is involved in a merger, acquisition, or asset sale, Your Personal Data may be transferred. We will provide notice if Your Personal Data is transferred and becomes subject to a different Privacy Policy.</p>
                                <h3>Law enforcement</h3>
                                <p class="fw-normal mb-3">Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p>
                                <h3>Other legal requirements</h3>
                                <p class="fw-normal mb-3">The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p>
                                <ul>
                                    <li>Comply with a legal obligation</li>
                                    <li>Protect and defend the rights or property of the Company</li>
                                    <li>Prevent or investigate possible wrongdoing in connection with the Service</li>
                                    <li>Protect the personal safety of Users of the Service or the public</li>
                                    <li>Protect against legal liability</li>
                                    <li>Security of Your Personal Data</li>
                                </ul>
                                <p class="fw-normal mb-3">The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p>
                                
                                <h3>Children's Privacy</h3>
                                <p class="fw-normal mb-3">Our Service does not address anyone under the age of 18. We do not knowingly collect personally identifiable information from anyone under the age of 18. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 18 without verification of parental consent, We take steps to remove that information from Our servers.</p>
                                <p class="fw-normal mb-3">If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent's consent before We collect and use that information.</p>
                                <h3>Links to Other Websites</h3>
                                <p class="fw-normal mb-3">Our Service may contain links to other websites that are not operated by Us. If You click on a third-party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.</p>
                                <p class="fw-normal mb-3">We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>
                                <h3>Changes to this Privacy Policy</h3>
                                <p class="fw-normal mb-3">We may update Our Privacy Policy from time to time. The updates on Privacy Policy will appear on this page with a revised date indicated on the “Last updated” date at the top of this Privacy Policy.</p>
                                <p class="fw-normal mb-3">You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
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


<script src="<?php echo base_url('assets/main/js/privacy_policy.js?v='). date('Ymdi') ?>"></script>

