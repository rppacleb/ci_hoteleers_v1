<?php require_once('app/Views/libraries/header.php'); ?>

<script type="text/javascript">

var notification_id             = <?php echo isset($_GET['notification_id'])? '"'.$_GET['notification_id'].'"' : '""'; ?>;
var mod_state                   = <?php echo '"'.$mod_state.'"'; ?>;
var applied                     = <?php echo $applied; ?>;
var favorites                    = <?php echo $favorites; ?>;
var type                        = <?php echo '"'.$type.'"'; ?>;
var perks_and_benefits          = <?php echo json_encode($perks_and_benefits); ?>;
var country_dial_code           = <?php echo json_encode($country_dial_code["data"]); ?>;
var profile_id                   = <?php echo isset($_SESSION['userid'])? '"'.$_SESSION['userid'].'"' : '""'; ?>;
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- template -->
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">


<?php require_once('app/Views/libraries/top-bar.php'); ?>

<div class="row mb-3 mobile-jsvwcompany">
    <div class="col-xl-3 col-lg-3 align-self-center">
        <a class="text-link" href="<?php echo base_url('job_search/private') ?>">Back</a>
    </div><!--./col-->
</div>

<div class="row mb-3 mobile-jsvwcompany">
    <div class="col-xl-3 col-lg-3">
		<div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:125px;height:125px;">
          <div class="media-body">
            <h6 id="header[job_title]" class="mt-0 text-break"></h6>
            <p id="header[company_name]" class="text-break"></p>
          </div>
        </div>
        <hr/>
        <p id="header[recruiter]"></p>
	</div>
</div>


<div class="row mb-3 mobile-jsvwrow desktop-lock">
    <div class="col-xl-1 col-lg-1">
        
    </div><!--./col-->
    <div class="col-xl-3 col-lg-3 align-self-center desktop-jsvwcompany">
        <p class="text-muted mb-4"><a class="text-link" href="<?php echo base_url('job_search/private') ?>">Back</a> / Job Post</p>
    </div><!--./col-->
	<div class="col align-self-center">
        <div class="outside_button">
            <?php if(isset($_SESSION['userid'])){?>
                <button class="btn btn-pill-sm btn-pill-sm-outline-light text-muted" title="Report" data-toggle="modal" data-target="#report_modal"><i class="fa fa-flag"></i></button>
            <?php }?>  

            <button name="btn_copy_link" type="button" class="btn btn-pill-sm btn-pill-sm-outline-light text-muted" title="Copy"><i class="fa fa-link"></i></button>

            <?php
                $fb_url = "http://stackoverflow.com/questions/16463030/how-to-add-facebook-share-button-on-my-website";
                $fb_url = base_url('job_search/public/view/'.$id);
            ?>

             <button class="btn btn-pill-sm btn-pill-sm-outline-light text-muted" title="Share" data-toggle="modal" data-target="#share_modal"><i class="fa fa-share"></i></button>

            
        </div><!--./text-right-->

	</div><!--./col-->
    <?php
        if(isset($_SESSION['usertype'])){
            $user_type = $_SESSION['usertype'];
        } else {
            $user_type = '';
        }
    ?>
    <?php if($user_type == 'employer'||$user_type == 'admin'){?>
    <?php }else{?>
        <div class="col align-self-center">
            <!--<div class="text-right">
                
                <button class="btn btn-pill-sm btn-pill-sm-outline-light mb-2 text-primary btn_submit" type="button" aria-type="Company">Submit</button>
            </div>-->

            <div class="outside_button text-right">
                
                <?php if(isset($_SESSION['userid'])){?>

                    <?php if(!$applied){?>
                        <?php if(!$favorites){?>
                            <button class="btn btn-pill-hover-link btn-pill-lg text-link btn_add_fav"><i class="fa fa-heart-o"></i></button>
                        <?php }else{ ?>
                            <button class="btn btn-pill-hover-primary btn-pill-lg text-primary btn_add_fav"><i class="fa fa-heart"></i></button>
                        <?php }?> 
                    <?php }?> 

                    <?php if(!$applied){?>
                        <button class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit">Apply</button>
                    <?php }else{ ?>

                        <button disabled class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit disabled">Apply</button>
                    <?php }?>  
                <?php }else{?>
                    <a href="<?php echo base_url('login?type=job_search&rdr_id='.$id.'')?>" class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit">Apply</a>
                <?php }?>
            </div><!--./text-right-->

        </div><!--./col-->
    <?php }?>
	
</div><!--./row-->


<div class="row mobile-jsvwrow desktop-lock">
    <div class="col-xl-1 col-lg-1">
        
    </div><!--./col-->

	<div class="col-xl-3 col-lg-3 desktop-jsvwcompany">
		<div class="media">
          <img id="header[company_logo]" class="mr-3 img-fluid rounded" style="width:76px;height:76px;">
          <div class="media-body">
            <h6 id="header[job_title]" class="mt-0 text-break"></h6>
            <p id="header[company_name]" class="text-break"></p>
          </div>
        </div>
        <hr/>
        <p id="header[recruiter]"></p>


        <h6 class="mt-0 jsvw-companyimglabel"></h6>
        <div id="image_cont_desktop" class="row row-cols-1"></div>
        
	</div>

	<div class="col">

		<form id="frm_data_entry" class="job_search_format">
            <div class="card mb-3">
                <div class="card-body">
                   

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Doc Content</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[doc_content]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Doc Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="header[doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Old Image</label>
                        <div class="col">
                            <input readonly class="form-control form-control-sm" type="text" name="file[old_doc_image]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->
                    
                    <div class="form-group row d-none">
                        <label class="col-3 col-form-label text-right">Id</label>
                        <div class="col">
                          <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Date Posted</label>
                        <div class="col align-self-center">
                            <input class="form-control-sm fw-bolder view form-control-plaintext" type="text" name="header[date_created]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->


                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Apply Before</label>
                        <div class="col align-self-center">
                            <input class="form-control-sm fw-bolder view form-control-plaintext" type="text" name="header[job_expiration_date]" maxlength="100"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <hr/>

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Job Title</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[job_title]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Job Level</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" id="header[job_level_text]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Job Type</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" id="header[job_type_text]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Job Description</label>
                        <div class="col pcl_qte_editor jd" name="placeholder[job_description]">
                            <textarea class="form-control form-control-sm jsvw-textarea texteditor" name="header[job_description]"></textarea>

                           
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    



                    <div class="form-group row mobile-jsvwjobdescrow d-none">
                        <label class="col-5 col-sm-5 col-md-5 col-lg-3 col-xl-3 col-form-label text-left">Job Description</label>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control form-control-sm jsvw-textarea" name="header[job_description]"></textarea>
                            </div><!--./col-10-->
                        </div>
                        
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Qualifications</label>
                        <div class="col pcl_qte_editor" name="placeholder[qualification]">
                            <textarea class="form-control form-control-sm jsvw-textarea texteditor" name="header[qualification]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-sm-5 col-md-5 col-lg-3 col-xl-3 col-form-label text-left">Qualifications</label>
                        <div class="row">
                            <div class="col">
                            <textarea class="form-control form-control-sm jsvw-textarea" name="header[qualification]"></textarea>
                            </div><!--./col-10-->
                        </div>
                        
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Salary</label>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col align-self-center">
                            <input class="form-control form-control-sm fw-bolder" type="text" name="header[salary_type]"/>
                        </div><!--./col-10-->   

                        <div class="col align-self-center">
                            <input class="form-control form-control-sm fw-bolder" type="text" name="header[salary]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-left">Salary</label>
                        <div class="row">
                            <div class="col align-self-center">
                                <input class="form-control form-control-sm fw-bolder" type="text" name="header[salary]"/>
                            </div><!--./col-10-->
                        </div>
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Location </label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" name="header[location]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-left">Location </label>
                        <div class="row">
                            <div class="col align-self-center">
                                <input class="form-control form-control-sm" name="header[location]"></textarea>
                            </div><!--./col-10-->
                        </div>
                    </div><!--./form-group-->

                    <div class="form-group row d-none">
                      <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Country</label>
                      <div class="col align-self-center">
                        <input readonly class="form-control form-control-sm" type="text" name="header[country]"/>
                      </div><!--./col-10-->
                    </div><!--./form-group-->
                    


                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Perks & Benefits</label>
                        <div class="col pb-content">
                           <div id="p_b_content_desktop" class="row row-cols-2">
                                
                           </div><!--./row-->
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-sm-5 col-md-5 col-lg-3 col-xl-3 col-form-label text-left">Perks & Benefits</label>
                        <div class="row">
                            <div class="col">
                               <div id="p_b_content_mobile" class="row row-cols-2">
                                    
                               </div><!--./row-->
                            </div><!--./col-10-->
                        </div>
                    </div><!--./form-group-->
                    <hr/>

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">Job Summary</label>
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Industry</label>
                                <div class="col">
                                    <input class="form-control form-control-sm" type="text" id="header[industry_text]"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Department</label>
                                <div class="col">
                                    <input class="form-control form-control-sm" type="text" id="header[department_text]"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Education</label>
                                <div class="col">
                                    <input class="form-control form-control-sm" type="text" id="header[education_text]"/>
                                </div><!--./col-10-->
                            </div><!--./form-group-->

                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-sm-5 col-md-5 col-lg-3 col-xl-3 col-form-label text-left">Job Summary</label>
                        <div class="row row-cols-2 justify-content-between">
                            <div class="form-group row">
                                <label class="col col-form-label text-muted">Industry</label>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-sm w-auto" type="text" id="header[industry_text]"/>
                                    </div><!--./col-10-->
                                </div>
                            </div><!--./form-group-->

                            <div class="form-group row">
                                <label class="col col-form-label text-muted">Education</label>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-sm w-auto" type="text" id="header[education_text]"/>
                                    </div><!--./col-10-->
                                </div>
                            </div><!--./form-group-->
                        </div>

                        <div class="row">
                            <div class="form-group row">
                                <label class="col col-form-label text-muted">Department</label>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-sm" type="text" id="header[department_text]"/>
                                    </div><!--./col-10-->
                                </div>
                            </div><!--./form-group-->
                        </div>
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">No. of Vacancies</label>
                        <div class="col align-self-center">
                            <input class="form-control form-control-sm" type="text" name="header[vacancies]"/>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-form-label align-self-center text-left">No. of Vacancies</label>
                        <div class="row">
                            <div class="col align-self-center">
                                <input class="form-control form-control-sm" type="text" name="header[vacancies]"/>
                            </div><!--./col-10-->
                        </div>
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label text-right">About </label>
                        <div class="col">
                            <textarea class="form-control form-control-sm jsvw-textarea" name="header[about]"></textarea>
                        </div><!--./col-10-->
                    </div><!--./form-group-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-form-label text-left">About </label>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control form-control-sm jsvw-textarea" name="header[about]"></textarea>
                            </div><!--./col-10-->
                        </div>
                    </div><!--./form-group-->

                    <div class="form-group row desktop-jsvwjobdescrow">
                        <label class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-form-label align-self-center text-right">Website </label>
                        <div class="col align-self-center">
                              <input value="" name="header[website]" type="text" class="form-control form-control-sm">
                              <a target="_blank" name="placeholder[website]" class="text-link d-none"></a>
                        </div><!--./col-->
                    </div><!--./row-->

                    <div class="form-group row mobile-jsvwjobdescrow">
                        <label class="col-5 col-form-label align-self-center text-left">Website </label>
                        <div class="row">
                            <div class="col align-self-center">
                                  <input value="" name="header[website]" type="text" class="form-control form-control-sm">
                                  <a target="_blank" name="placeholder[website]" class="text-link d-none"></a>
                            </div><!--./col-->
                        </div>
                    </div><!--./row-->
                    
                </div><!--./card-body-->
            </div><!--./card-->

        </form>
        
        <?php if($user_type == 'employer'||$user_type == 'admin'){?>
        <?php }else{?>
            <div class="outside_button text-right">

                <?php if(isset($_SESSION['userid'])){?>

                    <?php if(!$applied){?>
                        <?php if(!$favorites){?>
                            <button class="btn btn-pill-hover-link btn-pill-lg text-link btn_add_fav"><i class="fa fa-heart-o"></i></button>
                        <?php }else{ ?>
                            <button class="btn btn-pill-hover-primary btn-pill-lg text-primary btn_add_fav"><i class="fa fa-heart"></i></button>
                        <?php }?> 
                    <?php }?> 

                    <?php if(!$applied){?>
                        <button class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit">Apply</button>
                    <?php }else{ ?>

                        <button disabled class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit disabled">Apply</button>
                    <?php }?>  
                <?php }else{?>
                    <a href="<?php echo base_url('login?type=job_search&rdr_id='.$id.'')?>" class="btn btn-pill-sm-no-brdr btn-primary btn-sm text-white btn_submit">Apply</a>
                <?php }?>


                
                
            </div><!--./text-right-->
        <?php }?>
	</div><!--./col-->
	
</div><!--./row-->

<div class="row mt-4 mobile-jsvwcompany">
    <h6 class="mt-0 jsvw-companyimglabel"></h6>
    <div id="image_cont_mobile" class="row row-cols-1"></div>
</div>




<!--CONTENT END TAG-->			
		</div><!--./col content-->
	</div><!--./row-->
</div><!--./container-fluid-->
<!--CONTENT END TAG-->	

<?php require_once('app/Views/libraries/copyright.php'); ?>
  

<!-- Footer Menu -->
<div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Report</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_report">
            <div class="form-group row d-none">
                
                <label class="col-3 col-form-label text-right">ID</label>
                <div class="col">
                  <input readonly class="form-control form-control-sm mb-2" type="text" aria-type="<?php echo $type;?>" name="header[id]" value="<?php echo $id;?>" />
                </div>
            </div>

            <div class="form-group row">
                
                <label class="col-3 col-form-label text-right">ID</label>
                <div class="col">
                    <label class="col-form-label"><?php echo $id;?></label>
                  
                </div>
            </div>

            <div class="form-group row">
                
                <label class="col-3 col-form-label text-right">Job Title</label>
                <div class="col">
                  <input readonly class="form-control form-control-sm mb-2" type="text" name="placeholder[report_modal_job_title]" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label text-right">Comment <i class="text-danger fw-bolder">*</i></label>
                <div class="col">
                    <textarea class="form-control form-control-sm jsvw-textarea" name="header[comment]" /></textarea>
                </div><!--./col-10-->
            </div><!--./form-group-->

          </form><!--./form-->
        </div>
        <div class="modal-footer">
          <button name="btn_report" class="btn btn-primary btn-sm" type="button">Submit</button>
        </div>

    </div>
  </div>
</div>


<!--share modal-->
<div class="modal fade" id="share_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
      <div class="modal-header share-modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        <div class="modal-body mb-5 mt-3 align-middle text-center">
            <p>Share this job post at</p>

            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url?>" class="mr-4"><img src="<?php echo base_url('/files/images/default/fb-logo.png')?>" class="jsvw-socicons" /></a>

            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $fb_url?>"><img src="<?php echo base_url('/files/images/default/ln-logo.png')?>" class="jsvw-socicons" /></a>
        </div>

    </div>
  </div>
</div>

<!-- Application Modal  -->
<div class="modal fade" id="application_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="text-center my-3">
               <h5 class="text-link">Application sent!</h5>
                <a href="<?php echo base_url('job_search/private')?>" class="btn btn-pill-sm-no-brdr btn-primary text-white">Browse more jobs!</a> 
            </div>
            
        </div>
    </div>
  </div>
</div>


<?php require_once('app/Views/libraries/footer-menu.php'); ?>
<?php require_once('app/Views/libraries/footer.php'); ?>
<!-- Footer Menu -->



<!-- datatables -->
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/admin_dashboard/vendor/datatables/dataTables.buttons.min.js') ?>"></script>
<!-- datatables -->





<!--Autocomplete-->
<script src="<?php echo base_url('assets/autocomplete/js/jquery.mockjax.js') ?>"></script>
<script src="<?php echo base_url('assets/autocomplete/js/jquery.autocomplete.js') ?>"></script>
<!--Autocomplete-->

<script src="<?php echo base_url('assets/autosize-master/dist/autosize.js') ?>"></script>

<script src="<?php echo base_url('assets/main/js/job_search_vw.js?v='). date('Ymdi') ?>"></script>



