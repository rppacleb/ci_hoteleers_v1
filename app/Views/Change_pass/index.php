<?php require_once('app/Views/libraries/header.php'); ?>


<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('../../assets/main/css/styles.css') ?>">
<script type="text/javascript">
  var usertype = <?php echo !isset($_SESSION['usertype'])? '""' : '"'.$_SESSION['usertype'].'"'; ?>;
</script>

<?php
    $username = isset($_SESSION['username'])? $_SESSION['username'] : '';
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
          <h5 class="card-title text-link pt-4 mb-4">Change Password</h5>
          <p  class="mb-4">Click submit to receive an email containing link and instructions on how to change password.</p>
          <form id = "frm_forgot_password">

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <input Placeholder="Email" name="header[username]" value="<?php echo $username;?>" type="text" class="form-control form-control-sm" maxlength="100">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

           

          

            <div class="row">
                <div class="col text-center">
                    <button name="btn_login" class="btn btn-primary btn-pill mb-5 text-white" type="button">Submit</button>
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
<script src="<?php echo base_url('assets/main/js/change_pass.js?v='). date('Ymdi') ?>"></script>
