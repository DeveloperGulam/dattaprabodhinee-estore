
<body>
	<div class="sign-inup">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<div class="sign-form">
						<div class="sign-inner">
							<div class="sign-logo" id="logo">
								<a href="<?php echo base_url('Welcome_controller');?>"><img src="<?php echo base_url('assets/images/logo.svg');?>" alt=""></a>
								<a href="<?php echo base_url('Welcome_controller');?>"><img class="logo-inverse" src="<?php echo base_url('assets/images/dark-logo.svg');?>" alt=""></a>
							</div>
							
							<div class="form-dt">
								<div class="form-inpts checout-address-step">
									<form action="<?php echo base_url('Welcome_controller/verify_otp');?>" method="post">
										<div class="form-title"><h6>OTP Verification <?php echo $this->uri->segment(1); ?></h6></div>
											
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</body>
</html>