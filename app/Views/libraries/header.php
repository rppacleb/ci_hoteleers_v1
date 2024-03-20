<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php
		if(isset($_SESSION['usertype'])){
			if($_SESSION['usertype'] == 'employer'){
		?>
			<meta http-equiv="refresh" content="600;url=<?php echo base_url('home/logout') ?>" />

		<?php 
			}//end if
		}//end if?>
		
		<title>Hoteleers</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<!-- Add this within the head section of your HTML template -->
		<link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">
		<link rel="shortcut icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">



		<!--autocomplete-->
		<link rel="stylesheet" href="<?php echo base_url('assets/autocomplete/css/autocomplete.css') ?>">
		<!--autocomplete-->

		<!-- CSS Bootstrap 4 -->
		<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-4.0.0/dist/css/bootstrap.min.css') ?>">
		<!-- End CSS Bootstrap 4 -->

		<!--Date Picker-->
	  
	  	<!--Date Picker-->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css" />

	  	<!-- font awesome icons -->
		<link rel="stylesheet" href="<?php echo base_url('assets/admin_dashboard/vendor/fontawesome-free/css/all.min.css') ?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- font awesome icons -->

		<!-- rich text editor -->
		<link rel="stylesheet" href="<?php echo base_url('assets/texteditor/jquery-te-1.4.0.css') ?>">
		<!-- rich text editor -->

		
		
	  	<script type="text/javascript">
			var baseurl 					= "<?php echo base_url('') ?>";
			var curdate 					= "<?php echo date('Y-m-d H:i:s'); ?>";
			const env = 'staging'
			
			//var action 			= "<?php //echo isset($action)?$action : ''; ?>";
			//var id 				= "<?php //echo isset($id)?$id : ''; ?>";
			//var base_type 		= "<?php //echo isset($base_type)?$base_type : ''; ?>";
			//var base_id 		= "<?php //echo isset($base_id)?$base_id : ''; ?>";
			
			var firstName = '<?php echo session()->get('first_name'); ?>';
			var userid = '<?php echo session()->get('userid'); ?>';
			var usertype = '<?php echo session()->get('usertype'); ?>';
			console.log(firstName, userid, usertype);
			
			if (userid !== '') {
				if (firstName === '' && usertype === 'applicant') {
					if (env === 'dev' && window.location.pathname !== '/__projects/ci_hoteleers_v1/home') {
						window.location.href = '/__projects/ci_hoteleers_v1/home'
					} else if (env !== 'dev' && window.location.pathname !== '/home') {
						window.location.href = '/home'
					}
				}
			}
		</script>


	</head>
	<body id="page-top">
		<div id="loading">
			
			<div id="loading-image" class="spinner-grow text-muted"></div>
		</div>