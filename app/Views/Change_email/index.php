<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">

<?php
    $userid = isset($_SESSION['userid'])? $_SESSION['userid'] : '';
?>

<header class="py-5 header-changepass">   
<div class="container px-4 px-lg-5">
  <div class="row">
    <div class="col">
      
    </div>

    <div class="col-lg-4 col-md-6 align-self-center">
      <div class="card w-100 shadow">

        <div class="card-body">
          <button class="close text-danger" type="button" data-dismiss="modal" aria-label="Close" aria-id="35"><span class="fa fa-times"></span></button>
          <h5 class="card-title text-link pt-4 mb-4">Change Email</h5>
          <p  class="mb-4">Please enter verification code sent to your existing email, and enter new email address.</p>
          <form id = "frm_change_email">

            <div class="row d-none">
              <div class="col">
                  <div class="form-group">
                      <input readonly Placeholder="Email" name="header[id]" value="<?php echo $userid;?>" type="text" class="form-control form-control-sm">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            <div class="form-group row align-items-center">
                <div class="col">
                <input Placeholder="Verification Code" name="placeholder[verification_code]" type="text" class="form-control form-control-sm" maxlength="5">
                </div>
            </div>

            <div class="form-group row align-items-center">
                
                <div class="col">
                <input Placeholder="Enter new email" name="header[email_add]" type="text" class="form-control form-control-sm" maxlength="100">
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <button name="btn_submit" class="btn btn-primary btn-pill mb-5 text-white" type="button">Submit</button>
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
<script src="<?php echo base_url('assets/main/js/change_email.js?v='). date('Ymdi') ?>"></script>
