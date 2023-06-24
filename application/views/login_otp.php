<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Dattaprabodhinee">
		<meta name="author" content="Dattaprabodhinee">		
		<title>Dattaprabodhinee E-Store - Vendor Signin</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/fav.png'); ?>">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href='<?php echo base_url('assets/vendor/unicons-2.0.1/css/unicons.css');?>' rel='stylesheet'>
		<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/responsive.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/night-mode.css');?>" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/OwlCarousel/assets/owl.carousel.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/OwlCarousel/assets/owl.theme.default.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/semantic/semantic.min.css');?>" rel="stylesheet">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
	</head>

<body>
	<div class="sign-inup">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<div class="sign-form">
						<div class="sign-inner">
							<div class="sign-logo" id="logo">
								<a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/logo2.png');?>" alt=""></a>
								<a href="<?php echo base_url();?>"><img class="logo-inverse" src="<?php echo base_url('assets/images/dark-logo.png');?>" alt=""></a>
							</div>
							
							<div class="form-dt">
							<?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('err'); ?>
							</div>
							<?php } ?>
								<div class="form-inpts checout-address-step">
									<form action="<?php echo base_url('Welcome_controller/login_with_otp');?>" method="post">
										<div class="form-title"><h6>OTP Verification</h6></div>
										<div class="form-group pos_rel">
											<label class="control-label">Enter Code</label>
											<div class="form-group pos_rel">
											<input name="otp" id="otp" type="tel	" placeholder="Enter OTP" value="" class="form-control lgn_input" required="">
											<i class="uil uil-mobile-android-alt lgn_icon"></i>
										</div>
										<a href="<?php echo base_url('Welcome_controller/resend_otp');?>" class="resend-link">Resend Code</a>
										</div>
										<button class="login-btn hover-btn" type="submit">Verify OTP</button>
									</form>
								</div>
								<div class="signup-link">
									<p>Don't have account? - <a href="<?php echo base_url('signup/');?>">Create new account</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="copyright-text text-center mt-3">
						<i class="uil uil-copyright"></i>Copyright 2020 <b>Dattaprabodhinee E-Store</b> . All rights reserved
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Javascripts -->
	<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/OwlCarousel/owl.carousel.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/semantic/semantic.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.countdown.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
	<script src="<?php echo base_url('assets/js/offset_overlay.js');?>"></script>
	<script src="<?php echo base_url('assets/js/night-mode.js');?>"></script>
	
	
</body>
</html>