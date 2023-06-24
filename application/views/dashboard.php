<?php
$total_sum=0;
foreach($order_details as $order_details){
	$total_sum+=$order_details->total_amount;
}
?>
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
								<a href="<?php echo base_url('dashboard/'); ?>" class="user-item active"><i class="uil uil-apps"></i>Overview</a>
								<a href="<?php echo base_url('my-orders/'); ?>" class="user-item"><i class="uil uil-box"></i>My Orders</a>
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
								<div class="col-md-12">
									<div class="main-title-tab">
										<h4><i class="uil uil-apps"></i>Overview</h4>
									</div>
									<div class="welcome-text">
										<h2>Hi! <?php echo $user_details->name; ?></h2>
									</div>
								</div>
								<!--<div class="col-lg-6 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>My Rewards</h4>
										</div>
										<div class="ddsh-body">
											<h2>6 Rewards</h2>
											<ul>
												<li>
													<a href="#" class="small-reward-dt hover-btn">Won $2</a>
												</li>
												<li>
													<a href="#" class="small-reward-dt hover-btn">Won 40% Off</a>
												</li>
												<li>
													<a href="#" class="small-reward-dt hover-btn">Caskback $1</a>
												</li>
												<li>
													<a href="#" class="rewards-link5">+More</a>
												</li>
											</ul>
										</div>
										<a href="#" class="more-link14">Rewards and Details <i class="uil uil-angle-double-right"></i></a>
									</div>
								</div>-->
								<div class="col-lg-6 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>My Orders</h4>
										</div>
										<div class="ddsh-body">
											<h2><?php echo $count_orders;?> Recently Purchases</h2>
											<ul class="order-list-145">
												<li>
													<div class="smll-history">
														<div class="order-title">Your Items</div>
														<div class="order-status">On the way</div>
														<p>₹<?php echo $total_sum;?></p>
													</div>
												</li>
											</ul>
										</div>
										<a href="<?php echo base_url('my-orders'); ?>" class="more-link14">All Orders <i class="uil uil-angle-double-right"></i></a>
									</div>
								</div>
								<!--<div class="col-lg-12 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title">
											<h4>My Wallet</h4>
										</div>
										<div class="wllt-body">
											<h2>Credits $100</h2>
											<ul class="wallet-list">
												<li>
													<a href="#" class="wallet-links14"><i class="uil uil-card-atm"></i>Payment Methods</a>
												</li>
												<li>
													<a href="#" class="wallet-links14"><i class="uil uil-gift"></i>3 offers Active</a>
												</li>	
												<li>
													<a href="#" class="wallet-links14"><i class="uil uil-coins"></i>Points Earning</a>
												</li>	
											</ul>
										</div>
										<a href="#" class="more-link14">Rewards and Details <i class="uil uil-angle-double-right"></i></a>
									</div>
								</div>-->
							</div>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
	<!-- Body End -->