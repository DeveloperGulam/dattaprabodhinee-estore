<?php foreach($cart_products as $products){}
$discount_price=$products['price']*$products['qty'];
$orignal_price=$products['orignal_price']*$products['qty'];
$total_saving=$orignal_price-$discount_price;
$gst=($this->cart->total()*8)/100;
$total_price=$this->cart->total()+100+20;
$sub_category=$products['sub_category'];
if(!empty($products['seller_id'])){
	$seller_id=$products['seller_id'];
}
else{
	$seller_id=0;
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
								<li class="breadcrumb-item active" aria-current="page">Checkout</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-7">
					    <?php if($this->session->flashdata('orr')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('orr'); ?>
							</div><br/>
						<?php } ?>
						<div id="checkout_wizard" class="checkout accordion left-chck145">
							<div class="checkout-step">
					    
								<div class="checkout-card" id="headingOne"> 
									<span class="checkout-step-number">1</span>
									<h4 class="checkout-step-title"> 
										<button class="wizard-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Phone Number</button>
									</h4>
								</div>
								<div id="collapseOne" class="collapse in show" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<p>We need your phone number so we can inform you about any delay or problem.</p>	
										<p class="phn145">Your Registerd Mobile Number is <span>+91<?php echo $user_details->number; ?></span><a class="edit-no-btn hover-btn" data-toggle="collapse" href="#edit-number">Edit</a></p>
										<div class="collapse" id="edit-number">
											<div class="row">
												<div class="col-lg-8">
													<div class="checkout-login">
														<form action="" id="insert_number" method="post">
															<div class="login-phone">
																<input name="number" type="text" id="number" value="<?php echo $user_details->number; ?>" class="form-control" placeholder="Phone Number">
															</div>
															<button name="confirm_btn" class="chck-btn hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseTwo" style="border:none;">Confirm</button>
														</form>
													</div>
												</div>
											</div>
										</div>
<script>
    $(document).ready(function(){
        $("#insert_number").submit(function(e){
            e.preventDefault();
            var number = $("#number").val();
			// alert(number);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Welcome_controller/orders'); ?>",
                data: {number:number},
                success:function(data)
                {
                    
                },
                error:function()
                {
                    alert('fail');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#insert_default_number").submit(function(e){
            e.preventDefault();
            var number = $("#number").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Welcome_controller/orders'); ?>",
                data: {number:number},
                success:function(data)
                {
					
                },
                error:function()
                {
                    alert('fail');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#insert_details").submit(function(e){
            e.preventDefault();
            var address_type = $("input[name='address_type']:checked").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var flat = $("#flat").val();
            var street = $("#street").val();
            var pincode = $("#pincode").val();
            var locality = $("#locality").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Welcome_controller/orders'); ?>",
                data: {address_type:address_type,name:name,email:email,flat:flat,street:street,pincode:pincode,locality:locality},
                success:function(data)
                {
                    
                },
                error:function()
                {
                    alert('fail');
                }
            });
        });
    });
</script>
										<div class="otp-verifaction">
											<div class="row">
												<div class="col-lg-12">
													<div class="form-group mb-0">
														<form action="" id="insert_default_number" method="post">
														<input name="number" type="hidden" id="number" value="<?php echo $user_details->number; ?>" class="form-control" placeholder="Phone Number">
														<button class="collapsed chck-btn hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseTwo" style="border:none;">Next</button>
													</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="checkout-step">
								<div class="checkout-card" id="headingTwo">
									<span class="checkout-step-number">2</span>
									<h4 class="checkout-step-title">
										<p class="wizard-btn collapsed"> Delivery Address</p>
									</h4>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="checout-address-step">
											<div class="row">
												<div class="col-lg-12">												
													<form action="" id="insert_details" method="post">
														<!-- Multiple Radios (inline) -->
														<div class="form-group">
															<div class="product-radio">
																<ul class="product-now">
																	<li>
																		<input type="radio" id="ad1" name="address_type" value="home" checked>
																		<label for="ad1">Home</label>
																	</li>
																	<li>
																		<input type="radio" id="ad2" name="address_type" value="office">
																		<label for="ad2">Office</label>
																	</li>
																	<li>
																		<input type="radio" id="ad3" name="address_type" value="other">
																		<label for="ad3">Other</label>
																	</li>
																</ul>
															</div>
														</div>
														<div class="address-fieldset">
															<div class="row">
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Name*</label>
																		<input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Email Address*</label>
																		<input id="email" name="email" type="text" placeholder="Email Address" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Flat / House / Office No.*</label>
																		<input id="flat" name="flat" type="text" placeholder="Address" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Street / Society / Office Name*</label>
																		<input id="street" name="street" type="text" placeholder="Street Address" class="form-control input-md">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Pincode*</label>
																		<input id="pincode" name="pincode" type="text" placeholder="Pincode" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Locality*</label>
																		<input id="locality" name="locality" type="text" placeholder="Enter City" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<div class="address-btns">
																			<button class="save-btn14 collapsed ml-auto next-btn16 hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseThree">Next</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="checkout-step">
								<div class="checkout-card" id="headingThree"> 
									<span class="checkout-step-number">3</span>
									<h4 class="checkout-step-title">
										<p class="wizard-btn collapsed"> Choose Delivery Time </p>
									</h4>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="row">
										<form action="" id="insert_delivery_timing" method="post">
											<div class="col-md-12">
												<div class="form-group">
													<div class="time-radio">
													
														<div class="ui form">
															<div class="grouped fields">
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="delivery_timing" name="delivery_timing" checked="" value="any time" tabindex="0" class="hidden">
																		<label>Any Time</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="delivery_timing" name="delivery_timing" value="10.00AM - 8.00PM"  tabindex="0" class="hidden">
																		<label>10.00AM - 8.00PM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" value="10.00AM - 4.00PM" id="delivery_timing" name="delivery_timing" tabindex="0" class="hidden">
																		<label>10.00AM - 4.00PM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" value="12.00PM - 2.00PM" id="delivery_timing" name="delivery_timing" tabindex="0" class="hidden">
																		<label>12.00PM - 2.00PM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input id="delivery_timing" type="radio" value="8.00AM - 10.00AM" name="delivery_timing" tabindex="0" class="hidden">
																		<label>8.00AM - 10.00AM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input id="delivery_timing" type="radio" value="4.00PM - 7.00PM" name="delivery_timing" tabindex="0" class="hidden">
																		<label>4.00PM - 7.00PM</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<button class="collapsed next-btn16 hover-btn" style="border:none;" role="button" data-toggle="collapse"  href="#collapseFour"> Proccess to payment </button>
										</form>
									</div>
								</div>
							</div>
<script>
    $(document).ready(function(){
        $("#insert_delivery_timing").submit(function(e){
            e.preventDefault();
            var delivery_timing = $("input[name='delivery_timing']:checked").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Welcome_controller/orders'); ?>",
                data: {delivery_timing:delivery_timing},
                success:function(data)
                {
                    
                },
                error:function()
                {
                    alert('fail');
                }
            });
        });
    });
</script>
							<div class="checkout-step">
								<div class="checkout-card" id="headingFour">
									<span class="checkout-step-number">4</span>
									<h4 class="checkout-step-title"> 
										<p class="wizard-btn collapsed">Payment</p>
									</h4>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="payment_method-checkout">
											<form action="<?php echo base_url('Welcome_controller/orders'); ?>" id="insert_paymentmethod" method="post">
											<div class="row">
												
												<div class="col-md-12">
													<div class="rpt100">													
														<ul class="radio--group-inline-container_1">
															<!--<li>
																<div class="radio-item_1">
																	<input id="cashondelivery1" value="cod" name="paymentmethod" type="radio" data-minimum="50.0">
																	<label for="cashondelivery1" class="radio-label_1">Cash on Delivery</label>
																</div>
															</li>-->
															<li>
																<div class="radio-item_1">
																	<input id="card1" value="online" name="paymentmethod" type="radio" data-minimum="50.0" checked>
																	<label  for="card1" class="radio-label_1">Credit / Debit Card / UPI</label>
																</div>
															</li>
															<input type="hidden" name="total_amount" value="<?php echo $total_price;?>" id="total_amount"/>
															<input type="hidden" name="seller_id" value="<?php echo $seller_id;?>" id="seller_id"/>
														</ul>
														</form>
													</div>
													<div class="form-group return-departure-dts" data-method="cashondelivery">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title">
																	<h4>Cash on Delivery</h4>
																	<p>Cash on Delivery will not be available if your order value exceeds ₹300.</p>
																</div>
															</div>														
														</div>
													</div>
													<div class="form-group return-departure-dts" data-method="card">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title mb-4">
																	<h4>Credit / Debit Card</h4>
																</div>
															</div>														
															
														</div>
													</div>
													<button style="border:none;" class="next-btn16 hover-btn">Place Order</a>
												</div>
												
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-lg-4 col-md-5">
						<div class="pdpt-bg mt-0">
							<div class="pdpt-title">
								<h4>Order Summary</h4>
							</div>
							<?php foreach($cart_products as $products){ ?>
									<?php
									if($products['orignal_price']!=='0'){
										$value=($products['price']*100)/$products['orignal_price'];
										$off=100-$value;
									}
									else{
										$off=0;
									}
										?>
							<div class="right-cart-dt-body">
								<div class="cart-item border_radius">
									<div class="cart-product-img">
										<img src="<?php if(!empty($products['image'])){
											echo base_url('assets/images/product/'.$products['image']);
										}
										else{
											echo base_url('assets/images/sub_category/'.$products['sub_category_image']);
										}?>" alt="">
										<div class="offer-badge"><?php echo substr($off, 0,2); ?>% OFF</div>
									</div>
									<div class="cart-text">
										<h4><?php echo $products['name']; ?></h4>
										<div class="cart-item-price">₹<?php echo $products['price']; ?> <span>₹<?php echo $products['orignal_price']; ?></span></div>
									</div>		
								</div>
							</div>
							<?php }?>
							<?php if($this->cart->total_items()!==0){
								
							?>
							<div class="total-checkout-group">
								<div class="cart-total-dil">
									<h4>Sub-Total</h4>
									<span>₹<?php echo $this->cart->total(); ?></span>
								</div>
								<div class="cart-total-dil pt-3">
									<h4>Delivery Charges</h4>
									<span>₹100</span>
								</div>
							</div>
							<?php
									if($products['orignal_price']!=='0'){
										$saving=$products['orignal_price']-$products['price'];
									}
									else{
										$saving=0;
									}
										?>
							<div class="cart-total-dil saving-total ">
								<h4>Shiping Charges</h4>
								<span>₹20</span>
							</div>
							<div class="main-total-cart">
								<h2>Total</h2>
								<span>₹<?php echo $total_price; ?></span>
							</div>
							<div class="payment-secure">
								<i class="uil uil-padlock"></i>Secure checkout
							</div>
							<?php }?>
						</div>
						<?php //if($this->session->flashdata('error')){ ?>
							<!--<div class="text-danger pt-3">
							  <?php //echo $this->session->flashdata('error'); ?>
							</div>
						<?php// } ?>
						<?php //if($this->session->userdata('promocode_success')){ ?>
							<div class="promo-link45">
								<div class="text-success">
								  <?php //echo $this->session->userdata('promocode_success'); ?><span class="text-danger"><a href="<?php //echo base_url('Welcome_controller/removePromocode'); ?>"> Remove</a></span>
								</div>
							</div>
						<?php //}
						//else{ ?>
							<a href="javascript:;" id="promocode" class="promo-link45">
								Have a promocode?</a>
						<?php //} ?>
						<form action="<?php// echo base_url('Welcome_controller/applyPromocode'); ?>" class="promo-link45 mt-3" method="post" style="display:none;" id="promocode_form">
							<div class="login-phone">
								<input type="text" name="promocode" id="promocode_name" class="form-control pr-5 p-0 text-center" placeholder="Enter Your Promocode">
							</div>
							<button class="chck-btn hover-btn" role="button" data-toggle="collapse" href="#otp-verifaction" style="border:none;">Apply</button>
						</form>-->
						<script>
				// $(document).ready(function(){
					// $('#promocode').click(function(){
						// $('#promocode_form').show();
						// $('#promocode').hide();
					// });
				// })
				</script>
						<div class="checkout-safety-alerts">
							<p><i class="uil uil-sync"></i>100% Replacement Guarantee</p>
							<p><i class="uil uil-check-square"></i>100% Genuine Products</p>
							<p><i class="uil uil-shield-check"></i>Secure Payments</p>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->