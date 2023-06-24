<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Edit Profile</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-4 col-md-5">
								<div class="card card-static-2 mb-30">
									<div class="card-body-table">
										<div class="shopowner-content-left text-center pd-20">
											<div class="shopowner-dt-left">
												<h4><?php echo $user_details->business_name;?></h4>
												<span class='text-success'><i class="fas fa-wallet"></i> Total Sales - ₹<?php echo $user_details->wallet_balance;?>.00</span>
											</div>
											<div class="shopowner-dts">
												<div class="shopowner-dt-list">
													<span class="left-dt">Status</span>
													<span class="right-dt"><?php if($user_details->status==1)
												{
													echo"<span class='text-success'>Active</span>";
												}
												else
												{
													echo"<span class='text-danger'>Acount Deactivated</span>";
												};?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Name</span>
													<span class="right-dt"><?php echo $user_details->name;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Phone</span>
													<span class="right-dt">+91<?php echo $user_details->number;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Email</span>
													<span class="right-dt"><?php echo $user_details->email;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Street/Flat/House No.</span>
													<span class="right-dt"><?php echo $user_details->street;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">City</span>
													<span class="right-dt"><?php echo $user_details->city;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Pincode</span>
													<span class="right-dt"><?php echo $user_details->pincode;?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">State</span>
													<span class="right-dt"><?php echo $user_details->state;?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-7">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Edit Profile</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
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
											<form action="" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Name*</label>
														<input type="text" name="name" value="<?php echo $user_details->name;?>" class="form-control" placeholder="Enter Your Name">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Business Name*</label>
														<input type="text" name="business_name" class="form-control" value="<?php echo $user_details->business_name;?>" placeholder="Enter Business Name">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Email*</label>
														<input name="email"  type="email" class="form-control" value="<?php echo $user_details->email;?>" placeholder="Enter Email Address">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Phone*</label>
														<input name="number"  type="text" class="form-control" value="<?php echo $user_details->number;?>" placeholder="Enter Phone Number">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Street/Flat/House Number*</label>
														<input name="street"  type="text" class="form-control" value="<?php echo $user_details->street;?>" placeholder="Enter Street/Flat/House Number">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">City*</label>
														<input name="city"  type="text" class="form-control" value="<?php echo $user_details->city;?>" placeholder="Enter Your City">
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group mb-3">
														<label class="form-label">State*</label>
														<input name="state"  type="text" class="form-control" value="<?php echo $user_details->state;?>" placeholder="Enter Your State">
													</div>
												</div>
												<?php
												//$pincodes=$user_details->pincode;
												//$b=explode(', ',$pincodes);
												//for($i=0;$i<count($b);$i++) { ?>
                                                <!--<div class="col-lg-8">
													<div class="form-group mb-3">
														<label class="form-label">Pincode*</label>
														<input name="pincode[]"  type="text" class="form-control" value="<?php //echo $b[$i]; ?>" placeholder="Enter Your Pincode">
													</div>
												</div>-->
                                                <?php //} ?>
												<!--<div class="col-lg-8 addonf" style="display:none;">
													<div class="form-group mb-3">
														<label class="form-label">Pincode*</label>
														<input name="pincodes"  type="text" class="form-control" placeholder="Enter Your Pincode">
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group mb-3">
														<label class="form-label" style="visibility:hidden;">Seller Pincodes</label>
														<div>
														<a href="javascript:;" class="btn btn-danger hover-btn imgAdd2" type="button">Add More <i class="fa fa-plus"></i></a>
														</div>
													</div>
												</div>-->
												<div class="col-lg-8">
													<button class="save-btn hover-btn" type="submit" name="submit">Save Changes</button>
												</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
$(".imgAdd2").click(function(){
  $(this).closest(".row").find('.addonf').before('<div class="col-lg-8"><div class="form-group mb-3"><label class="form-label">Pincode*</label><input name="pincode[]"  type="text" class="form-control" placeholder="Enter Your Pincode"></div></div>');
});
});
</script>
												<!--<div class="col-lg-4">
													<a href="javascript:;" onclick="edit_business_details()">Edit Business Details</a>
												</div>-->
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<script>
							    function edit_business_details()
							    {
							        $('#business_details').show();
							    }
							</script>
							<div class="col-lg-12 col-md-12" style="display:none;" id="business_details">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Edit Business Details</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<?php if($this->session->flashdata('bmsg')){ ?>
										<div class="alert alert-success" role="alert">
										  <?php echo $this->session->flashdata('bmsg'); ?>
										</div>
										<?php } ?>
										<?php if($this->session->flashdata('berr')){ ?>
										<div class="alert alert-danger" role="alert">
										  <?php echo $this->session->flashdata('berr'); ?>
										</div>
										<?php } ?>
											<form action="<?php echo base_url('seller/update_profile');?>" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Name*</label>
														<input type="text" name="name" value="<?php echo $user_details->name;?>" class="form-control" placeholder="Enter Your Name">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Business Name*</label>
														<input type="text" name="business_name" class="form-control" value="<?php echo $user_details->business_name;?>" placeholder="Enter Business Name">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Email*</label>
														<input name="email"  type="email" class="form-control" value="<?php echo $user_details->email;?>" placeholder="Enter Email Address">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Phone*</label>
														<input name="number"  type="text" class="form-control" value="<?php echo $user_details->number;?>" placeholder="Enter Phone Number">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Street/Flat/House Number*</label>
														<input name="street"  type="text" class="form-control" value="<?php echo $user_details->street;?>" placeholder="Enter Street/Flat/House Number">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">City*</label>
														<input name="city"  type="text" class="form-control" value="<?php echo $user_details->city;?>" placeholder="Enter Your City">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">Pincode*</label>
														<input name="pincode"  type="text" class="form-control" value="<?php echo $user_details->pincode;?>" placeholder="Enter Your Pincode">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label">State*</label>
														<input name="state"  type="text" class="form-control" value="<?php echo $user_details->state;?>" placeholder="Enter Your State">
													</div>
												</div>
												<div class="col-lg-12">
													<button class="save-btn hover-btn" type="submit">Save Changes</button>
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