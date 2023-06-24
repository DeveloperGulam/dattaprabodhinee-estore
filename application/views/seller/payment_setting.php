
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Payment Setting</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payment Setting</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="left-side-tabs">
									<div class="dashboard-left-links">
										<a href="<?php echo base_url('seller/payment_gateway/'); ?>" class="user-item active"><img src="<?php echo base_url('assets/images/instamojo.png'); ?>" style="height:15px;"/> &nbsp;Instamojo</a>
										<a href="<?php echo base_url('seller/razorpay_payment_gateway/'); ?>" class="user-item"><img src="<?php echo base_url('assets/images/razorpay.png'); ?>" style="height:15px;"/> Razorpay</a>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-6">
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
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Instamojo Setting</h4> 
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										    <form action="<?php echo base_url('seller/add_payment_gateway');?>" method="post">
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group">
														<label class="form-label">Private API Key*</label>
														<input type="text" class="form-control" required name="private_key" placeholder="Enter Instamojo Private API Key">
													</div>
													<div class="form-group">
														<label class="form-label">Private Auth Token*</label>
														<input type="text" class="form-control" required name="private_token" placeholder="Enter Instamojo Private Auth Token">
													</div>
													<div class="form-group">
														<label class="form-label">Private Salt*</label>
														<input type="text" class="form-control" required name="private_salt" placeholder="Enter Instamojo Private Salt">
													</div>
													
													<button class="save-btn hover-btn" type="submit">Save</button>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
                