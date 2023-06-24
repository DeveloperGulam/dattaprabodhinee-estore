<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description-dattaprabodhinee" content="">
	<meta name="author-dattaprabodhinee" content="">
	<title>Dattaprabodhinee E-store::Seller Login</title>
	<link href="<?php echo base_url('assets/admin/css/styles.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/css/admin-style.css');?>" rel="stylesheet">
	
	<!-- Vendor Stylesheets -->
	<link href="<?php echo base_url('assets/admin/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
</head>

    <body class="bg-sign">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header card-sign-header">
										<h3 class="text-center font-weight-light my-4">Seller Login</h3>
									</div>
                                    <div class="card-body">
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
                                        <form method="post" action="<?php echo base_url('seller/seller_login');?>">
                                            <div class="form-group">
												<label class="form-label" for="inputEmailAddress">Email*</label>
												<input class="form-control py-3" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address">
											</div>
                                            <div class="form-group">
												<label class="form-label" for="inputPassword">Password*</label>
												<input class="form-control py-3" id="inputPassword" name="password" type="password" placeholder="Enter password">
											</div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
													<input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
													<label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
												</div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
												<button class="btn btn-sign hover-btn">Login</button>
											</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>	
		<script src="<?php echo base_url('assets/admin/js/jquery-3.4.1.min.js');?>"></script>
        <script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/admin/js/scripts.js');?>"></script>
    </body>
</html>
