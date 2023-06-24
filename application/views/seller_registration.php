<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Dattaprabodhinee">
		<meta name="author" content="Dattaprabodhinee">		
		<title>Dattaprabodhinee E-Store - Seller Registration</title>
		
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
									<form action="<?php echo base_url('Seller/seller_registration');?>" method="post">
										<div class="form-title"><h6>Vendor Registration</h6></div>
										<div class="form-group pos_rel">
											<input id="full[name]" name="name" type="text" placeholder="Full name" class="form-control lgn_input" required="">
											<i class="uil uil-user-circle lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="business_name" name="business_name" type="text" placeholder="Business name" class="form-control lgn_input" required="">
											<i class="uil uil-shop lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="email[address]" name="email" type="email" placeholder="Email Address" class="form-control lgn_input" required="">
											<i class="uil uil-envelope lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input name="number" id="mobile_num1" type="text" placeholder="Phone Number" class="form-control lgn_input" required="">
											<i class="uil uil-mobile-android-alt lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input name="street" id="street" type="text" placeholder="Street Address" class="form-control lgn_input" required="">
											<i class="uil uil-map lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input name="city" id="city" type="text" placeholder="Enter Your City" class="form-control lgn_input" required="">
											<i class="uil uil-building lgn_icon"></i>
										</div>
								<div class="row">
								    <div class="col-sm-10 testtt">
										<div class="form-group pos_rel">
											<input name="pincode[]" id="pincode" type="text" placeholder="Enter Your Pincode" class="form-control lgn_input" required="">
											<i class="uil uil-map-marker-alt lgn_icon"></i>
										</div>
									</div>
									<div class="col-sm-2">
										<a class="login-btn hover-btn imgAdd2" style="height:29px;" type="button"><i class="uil uil-plus" style="font-size:27px;color:white;line-height:50%;"></i></a>
									</div>
								</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$(".imgAdd2").click(function(){
  $(this).closest(".row").find('.testtt').after('<div class="col-sm-10"><div class="form-group pos_rel"><input name="pincode[]" id="pincode" type="text" placeholder="Enter Your Pincode" class="form-control lgn_input" required=""><i class="uil uil-map-marker-alt lgn_icon"></i></div></div>');
});
});
</script>
										<div class="form-group pos_rel">
											<input name="state" id="state" type="text" placeholder="Enter Your State" class="form-control lgn_input" required="">
											<i class="uil uil-home lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="password1" name="password" required="" type="password" placeholder="New Password" class="form-control lgn_input" >
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<button class="login-btn hover-btn" type="submit">Sign Up Now</button>
									</form>
								</div>
								<div class="signup-link">
									<p>I have an account? - <a href="<?php echo base_url('seller/');?>">Sign In Now</a></p>
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