<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Under Review</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8">
						<div class="order-placed-dt">
							<i class="uil uil-check-circle icon-circle"></i>
							<h2>Account Created Successfully</h2>
							<p>Thank you for parter with us. you have created your seller successfully.</p>
							<div class="delivery-address-bg">
								<div class="title585">
									<div class="pln-icon"><i class="uil uil-telegram-alt"></i></div>
									<h4>Your have under Review!</h4>
								</div>
								<ul class="address-placed-dt1">
									<p>Hello, <?php echo $user_details->name; ?><br/> Your account under review. We will verify your account and response as soon as posible. We will notify on your Mobile Number <span class="text-danger"><?php echo $user_details->number; ?></span> and on this Email Address <span class="text-danger"><?php echo $user_details->email; ?> </span> also send your panel url.</p>
								</ul>
								<div class="stay-invoice">
									<div class="st-hm">We response as soon as posible<i class="uil uil-smile text-danger"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->