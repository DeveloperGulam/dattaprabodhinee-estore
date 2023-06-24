<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-group">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
							<?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php print_r($this->session->flashdata('err')); ?>
							</div>
							<?php } ?>
						<div class="user-dt">
							<div class="user-img" id="gallery">
								<img src="<?php if($user_details->customer_img==''){
									echo base_url('assets/images/avatar/img-5.jpg');
								}
								else{
									if($user_details->login_oauth_uid==''){
									    echo base_url('assets/images/avatar/'.$user_details->customer_img);
								    }
								    else
								    {
								        echo $user_details->customer_img;
								    }
								}?>" alt="">
								<div class="img-add">
									<input type="file" name="customer_img" id="file">
								</div>
							</div>
							<h4><?php echo $user_details->name; ?></h4>
							<p id="editnum">+91 <?php echo $user_details->number; ?><a href="javascript:;" onclick="edit_num()"><i class="uil uil-edit"></i></a></p>
							
							<form action="<?php echo base_url('Welcome_controller/upadate_number'); ?>" method="post" enctype="multipart/form-data" id="">
							<p id="editnum_input" class="mb-3" style="display:none;">+91<input type="text" name="number" id="number_input" class="border-bottom" value="<?php echo $user_details->number; ?>"/><span><button id="gobtn"><i class="uil uil-arrow-right"></i></button></span></p>
							</form>
							<!--<div class="earn-points"><img src="images/Dollar.svg" alt="">Points : <span>20</span></div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<style>
		#gobtn{
			background:none;
			border:none;
			outline:none;
			font-size:20px;
		}
		#number_input{
			outline:none;
			border:none;
			width:90px;	
			padding:5px;
			background:none;
			//text-align:center;
		}
		</style>
		<script type="text/javascript">
		function edit_num()
		{
			$('#editnum_input').show();
			$('#editnum').hide();
		}
	// $(function() {
    // var imagesPreview = function(input) {
	    // if (input.files) {
	      // var filesAmount = input.files.length;
	      // for (i = 0; i < filesAmount; i++) {
	        // var reader = new FileReader();
	        // reader.onload = function(event) {
	        	// $('#gallery').append('<img src='+event.target.result+' alt="">')
	        // }
	       	// reader.readAsDataURL(input.files[i]);
	      // }
		  // }
		// }

		// $('#file').on('change', function(e) {
			// $('#gallery').html('');
			// imagesPreview(this);
		// });
	// });
	</script>	
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="left-side-tabs">
							<div class="dashboard-left-links">
								<a href="<?php echo base_url('dashboard/'); ?>" class="user-item"><i class="uil uil-apps"></i>Overview</a>
								<a href="<?php echo base_url('my-orders/'); ?>" class="user-item active"><i class="uil uil-box"></i>My Orders</a>
								<!--<a href="dashboard_my_rewards.html" class="user-item"><i class="uil uil-gift"></i>My Rewards</a>
								<a href="dashboard_my_wallet.html" class="user-item"><i class="uil uil-wallet"></i>My Wallet</a>
								<a href="dashboard_my_wishlist.html" class="user-item"><i class="uil uil-heart"></i>Shopping Wishlist</a>-->
								<!--<a href="dashboard_my_addresses.html" class="user-item"><i class="uil uil-location-point"></i>My Address</a>-->
								<a href="<?php echo base_url('Welcome_controller/logout');?>" class="user-item"><i class="uil uil-exit"></i>Logout</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">
						<div class="dashboard-right">
							<div class="row">
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
								<div class="col-md-12">
									<div class="main-title-tab">
										<h4><i class="uil uil-box"></i>My Orders</h4>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<?php foreach($order_details as $order_details){ ?>
									<div class="pdpt-bg">
										<!--<div class="pdpt-title">
											<h6>Delivery Timing 10 May, 3.00PM - 6.00PM</h6>
										</div> -->
										<div class="order-body10">
											<ul class="order-dtsll">
												<li>
													<div class="order-dt-img">
														<img src="<?php echo base_url('assets/images/groceries.svg');?>" alt="">
													</div>
												</li>
												<li>
													<div class="order-dt47">
														<h4>Locality: <?php echo $order_details->locality;?></h4>
														<p> <?php if($order_details->status==0){ echo "<span class='text-danger'>Placed</span>";}
														if($order_details->status==1){ echo "<span class='text-warning'>Packed</span>";}
														if($order_details->status==2){ echo "<span class='text-primary'>On the way</span>";}
														if($order_details->status==4){ echo "<span class='text-success'>Delivered</span>";}
														?></p>
														<div class=""><a href="<?php echo base_url('product-details/'.$order_details->id.'/');?>">Product Details <span class="fa fa-arrow-right"></span></a></div>
													</div>
												</li>
											</ul>
											<div class="total-dt">
												<div class="total-checkout-group">
													<div class="cart-total-dil">
														<h4>Sub Total</h4>
														<span>₹<?php echo $order_details->total_amount-120;?></span>
													</div>
													<div class="cart-total-dil pt-3">
														<h4>Shipping Charges</h4>
														<span>₹20</span>
													</div>
													<div class="cart-total-dil pt-3">
														<h4>Delivery Charges</h4>
														<span>₹100</span>
													</div>
												</div>
												<div class="main-total-cart">
													<h2>Total</h2>
													<span>₹<?php echo $order_details->total_amount;?></span>
												</div>
											</div>
											<div class="track-order">
												<h4>Track Order</h4>
												<?php if($order_details->status==3){ 
													echo"<h3 class='text-danger' style='text-align:center'><b>Your Order has been Cancelled.</b></h3>";
												}
												else{?>
												<div class="bs-wizard" style="border-bottom:0;">   
													<div class="bs-wizard-step <?php if($order_details->status==0){ echo "active";}
													else{ echo "complete";}
													?>">
														<div class="text-center bs-wizard-stepnum">Placed</div>
														<div class="progress"><div class="progress-bar"></div></div>
														<a href="#" class="bs-wizard-dot"></a>
													</div>
													<div class="bs-wizard-step <?php if($order_details->status==0){ echo "disabled";}
													if($order_details->status==1){ echo "active";}
													if($order_details->status==2){ echo "complete";}
													if($order_details->status==4){ echo "complete";}
													?>"><!-- complete -->
														<div class="text-center bs-wizard-stepnum">Packed</div>
														<div class="progress"><div class="progress-bar"></div></div>
														<a href="#" class="bs-wizard-dot"></a>
													</div>
													<div class="bs-wizard-step <?php if($order_details->status==0){ echo "disabled";}
													if($order_details->status==1){ echo "disabled";}
													if($order_details->status==2){ echo "active";}
													if($order_details->status==4){ echo "complete";}
													?>"><!-- complete -->
														<div class="text-center bs-wizard-stepnum">On the way</div>
														<div class="progress"><div class="progress-bar"></div></div>
														<a href="#" class="bs-wizard-dot"></a>
													</div>
													<div class="bs-wizard-step <?php if($order_details->status==0){ echo "disabled";}
													if($order_details->status==1){ echo "disabled";}
													if($order_details->status==2){ echo "disabled";}
													if($order_details->status==4){ echo "active";}
													?>"><!-- active -->
														<div class="text-center bs-wizard-stepnum">Delivered</div>
														<div class="progress"><div class="progress-bar"></div></div>
														<a href="#" class="bs-wizard-dot"></a>
													</div>
												</div>
												<?php }?>
											</div>
											<!--<div class="alert-offer">
												<img src="images/ribbon.svg" alt="">
												Cashback of $2 will be credit to Gambo Super Market wallet 6-12 hours of delivery.
											</div>-->
											<div class="call-bill">
												<div class="delivery-man">
													Customer Care - <a href="tel:1800000000"><i class="uil uil-phone"></i> Call Us</a>
												</div>
												<?php if($order_details->status==4){?>
												<div class="order-bill-slip">
													 <?php if($report_details==''){?>
													<a href="javascript:;" onclick="report_btn('<?php echo $order_details->id ?>')" class="bill-btn5 hover-btn">Report</a>
													 <?php }
													else{
														echo "<span class='text-danger'>Report Number: </span>#".$report_details->report_no;
													}?>
												</div>
												<?php }?>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>								
							</div>
							<div class="row" id="report_row" style="display:none;">
								<div class="col-lg-12 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h6>Report This Product</h6>
										</div>
										<div class="order-body10">
											<ul class="order-dtsll">
											<form method="post" action="<?php echo base_url('Welcome_controller/product_report/'.$order_details->id); ?>">
												<input type="hidden" id="order_id" name="order_id" value=""/>
												<label>Describe Your Issue</label>
												<textarea name="issues" placeholder="Describe Your Issue..." class="form-control"></textarea>
												<div class="call-bill">
													<div class="order-bill-slip">
														<button class="bill-btn5 hover-btn" style="border:none;">Report</button>
													</div>
												</div>
											</form>
											</ul>
											</div>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
	<!-- Body End -->
	<script>
	function report_btn(id){
		document.getElementById('order_id').value=id;
		$('#report_row').show();
		$('#report_btn').hide();
	}
	</script>