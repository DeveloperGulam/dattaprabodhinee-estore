<?php $weight=0;
foreach($cart_products as $products){
    if($products['packing_type']=='gm')
    {
        $packing_weight=$products['packing_size']*$products['qty']*1000;
    }
    if($products['packing_type']=='kg')
    {
        $packing_weight=$products['packing_size']*$products['qty']*1000000;
    }
    if($products['packing_type']=='l')
    {
        $packing_weight=$products['packing_size']*$products['qty']*1000;
    }
    $weight+=$packing_weight;
}
if($weight<=1000000)
{
    $delivery_charges=150;
}
if($weight>1000000 and $weight<=2000000)
{
    $delivery_charges=200;
}
if($weight>2000000 and $weight<=3000000)
{
    $delivery_charges=300;
}
if($weight>3000000 and $weight<=4000000)
{
    $delivery_charges=400;
}
if($weight>4000000 and $weight<=5000000)
{
    $delivery_charges=500;
}
if($weight>5000000 and $weight<=6000000)
{
    $delivery_charges=600;
}
if($weight>6000000 and $weight<=7000000)
{
    $delivery_charges=700;
}
if($weight>7000000 and $weight<=8000000)
{
    $delivery_charges=800;
}
if($weight>8000000 and $weight<=9000000)
{
    $delivery_charges=900;
}
if($weight>9000000)
{
    $delivery_charges=1000;
}
if($weight>10000000)
{ ?>
  <script>
      swal({
		  title: "Sorry!",
		  text: "You can't proceed with this order beacause your order weight exceed 10kg. Please sure your order weight less then 10kg.",
		  icon: "error",
		  button: true,
		})
		.then((value) => {
          document.location.href="<?php echo base_url(); ?>";
        });
  </script>  
<?php }
//print_r($delivery_charges);die;
$discount_price=$products['price']*$products['qty'];
$orignal_price=$products['orignal_price']*$products['qty'];
$total_saving=$orignal_price-$discount_price;
$gst=($this->cart->total()*8)/100;
$sub_total=$this->cart->total();
$total_price=$this->cart->total()+$delivery_charges+20;
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
					    
								<div id="collapseOne" class="collapse in show" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<form action="<?php echo base_url('Welcome_controller/by_mobile_orders'); ?>" method="post">
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
																<input type="hidden" name="total_amount" value="<?php echo $total_price;?>" id="total_amount"/>
																<input type="hidden" name="sub_total" value="<?php echo $sub_total;?>" id="sub_total"/>
															<input type="hidden" name="seller_id" value="<?php echo $seller_id;?>" id="seller_id"/>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Email Address*</label>
																		<input id="email" name="email" type="email" placeholder="Email Address" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Mobile Number*</label>
																		<input id="number" name="number" type="text" placeholder="Your Mobile Number" class="form-control input-md">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">City*</label>
																		<input id="city" name="locality" type="text" placeholder="Enter Your City" class="form-control input-md">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">State*</label>
																		<input id="state" name="state" type="text" placeholder="Enter Your State" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-6 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Pincode*</label>
																		<input id="pincode" name="zipcode" type="text" placeholder="Pincode" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Landmark (optional)</label>
																		<input id="landmark" name="landmark" type="text" placeholder="Landmark" class="form-control input-md">
																	</div>
																</div>
																
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Shiping Address*</label>
																		<textarea style="resize:none;" class="form-control input-md" name="address" id="shippingAddress" cols="30" rows="5" placeholder="Enter Shipping Address."></textarea>
																	</div>
																</div>
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
													<!--<div class="form-group return-departure-dts" data-method="cashondelivery">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title">
																	<h4>Cash on Delivery</h4>
																	<p>Cash on Delivery will not be available if your order value exceeds ₹300.</p>
																</div>
															</div>														
														</div>
													</div>-->
													<div class="form-group return-departure-dts" data-method="card">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title mb-4">
																	<h4>Credit / Debit Card </h4>
																</div>
															</div>														
															
														</div>
													</div>
												</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<div class="address-btns">
																			<button class="save-btn14 collapsed ml-auto next-btn16 hover-btn">Place Order</button>
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
									<span>₹<?php echo $delivery_charges;?></span>
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
							<!--<p><i class="uil uil-sync"></i>100% Replacement Guarantee</p>-->
							<p><i class="uil uil-check-square"></i>Genuine Products</p>
							<p><i class="uil uil-shield-check"></i>Secure Payments</p>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->