<?php foreach($cart_products as $products){}
$discount_price=$products['price']*$products['qty'];
$orignal_price=$products['orignal_price']*$products['qty'];
$total_saving=$orignal_price-$discount_price;
$gst=($this->cart->total()*8)/100;
$total_price=$this->cart->total()+50;
$sub_category=$products['sub_category'];
if(!empty($products['seller_id'])){
	$seller_id=$products['seller_id'];
}
else{
	$seller_id=0;
}
?>
<style>
.product-radio {
    margin-top: 7px;
}

.product-now {
  list-style-type: none;
  margin:  0;
  padding: 0;
}

.product-now li {
	margin-right: 5px;
    width: 50px;
    height: 36px;
    position: relative;
    text-align: center;
    display: inline-block;
}

.product-now label,
.product-now input {
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
}

.product-now input[type="radio"] {
	display: none;
}

.product-now input[type="radio"]:checked+label,
.Checked+label {
	background: #f55d2c;
}

.product-now label {
	padding: 5px;
    cursor: pointer;
    background: #c7c7c7;
    color: #fff;
    border-radius: 3px;
	font-weight: 500;
    font-size: 12px;
}

.product-now label:hover {
	background: #f55d2c;
}
.radio--group-inline-container_1 {
    width: 100%;
    width: 100%;
    display: block;
    margin-bottom: 22px !important;
}

.radio--group-inline-container_1 li {
    display: inline-block;
    width: 100%;
	margin-right: 10px;
}

.radio--group-inline-container_1 li:last-child {
    margin-right: 0;
}

.radio--group-inline-container_1 .radio-item_1 {
    display: inline-block;
	margin-right: 10px;
	width: 100%;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"] {
	position: absolute;
	opacity: 0;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"] + .radio-label_1:before {
	content: '';
	background: #f7f7f7;
	border-radius: 100%;
	border: 1px solid #b4b4b4;
	display: inline-block;
	width: 1em;
	height: 1em;
	top: 0px;
	position: relative;
	margin-right: 10px;
	vertical-align: top;
	cursor: pointer;
	text-align: center;
	-webkit-transition: all 250ms ease;
	transition: all 250ms ease;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"]:checked + .radio-label_1:before {
	background-color: #f55d2c;
	box-shadow: inset 0 0 0 2px #f4f4f4;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"]:focus + .radio-label_1:before {
	outline: none;
	border-color: #0E8A86;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"]:disabled + .radio-label_1:before {
	box-shadow: inset 0 0 0 4px #f4f4f4;
	border-color: #b4b4b4;
	background: #b4b4b4;
}

.radio--group-inline-container_1 .radio-item_1 input[type="radio"] + .radio-label:empty:before {
	margin-right: 0;
}

.radio-label_1 {
    font-size: 14px;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
    line-height: 16px;
	color: #2b2f4c;
	cursor: pointer;
	padding: 15px 20px;
    background: #f9f9f9;
    width: 100%;
	border-radius: 5px;
	border: 1px solid #efefef;
}

.radio-label_1:hover {
	background: #f5f5f5;
    transition: all .4s ease-in-out;
}
</style>
<!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url('cart/'); ?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="page-title text-center">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of breadcrumb area  ====================-->
        <!--====================  checkout body ====================-->
        <div class="checkout-body space-mt--30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php if($this->session->flashdata('orr')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('orr'); ?>
							</div><br/>
						<?php } ?>
                        <!-- checkout form -->
                        <div class="checkout-form">
                            <form action="<?php echo base_url('Welcome_controller/by_mobile_orders'); ?>" method="post">
                                <div class="checkout-form__single-field space-mb--30">
                                    <label for="fullName">Full Name</label>
                                    <input type="text"  name="name" id="fullName" placeholder="Enter Full Name">
                                </div>
								<input type="hidden" name="total_amount" value="<?php echo $total_price;?>" id="total_amount"/>
								<input type="hidden" name="sub_total" value="<?php echo $this->cart->total();?>" id="sub_total"/>
								<input type="hidden" name="seller_id" value="<?php echo $seller_id;?>" id="seller_id"/>
                                <div class="checkout-form__single-field space-mb--30">
                                    <label for="phoneNo">Phone</label>
                                    <input type="text"  name="number" id="phoneNo" required placeholder="Enter Phone Number">
                                </div>
                                <div class="checkout-form__single-field space-mb--30">
                                    <label for="emailAddress">Email Address</label>
                                    <input type="text" required name="email"  id="emailAddress"
                                        placeholder="Enter Email Address">
                                </div>
                                <div class="checkout-form__single-field space-mb--30">
                                    <label for="city">City</label>
                                    <input type="text" required name="locality"  id="city"
                                        placeholder="Enter Your City">
                                </div>
								<div class="checkout-form__single-field space-mb--30">
                                    <label for="state">State</label>
                                    <input type="text" required name="state"  id="state"
                                        placeholder="Enter Your City">
                                </div>
								<div class="checkout-form__single-field space-mb--30">
                                    <label for="zipcode">Pincode</label>
                                    <input type="text" required name="zipcode"  id="zipcode"
                                        placeholder="Enter Your Pincode">
                                </div>
								<div class="checkout-form__single-field space-mb--30">
                                    <label for="landmark">Landmark (optional)</label>
                                    <input type="text" name="landmark"  id="landmark"
                                        placeholder="Landmark">
                                </div>
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
                                <div class="checkout-form__single-field space-mb--30">
                                    <label for="shippingAddress">Shipping Address</label>
                                    <textarea name="address" id="shippingAddress" cols="30" rows="5"
                                        placeholder="Enter Shipping Address"></textarea>
                                </div>
                                <div class="your-order-area space-mb--30">
                                    <h3>Your order</h3>
                                    <div class="your-order-wrap gray-bg-4">
                                        <div class="your-order-product-info">
                                            <div class="your-order-top">
                                                <ul>
                                                    <li>Product</li>
                                                    <li>Total</li>
                                                </ul>
                                            </div>
                                            <div class="your-order-middle">
                                                <ul>
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
													?>
                                                    <li><span class="order-middle-left"><?php echo $products['name']; ?> x <?php echo $products['qty']; ?></span> <span class="order-price">₹&nbsp;&nbsp;<?php echo $products['subtotal']; ?>.00 </span></li>
													<?php } ?>
                                                </ul>
             
                                            </div>
        <?php
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
        
		if($this->cart->total_items()!==0){
			$discount_price=$products['price']*$products['qty'];
			$orignal_price=$products['orignal_price']*$products['qty'];
			$total_saving=$orignal_price-$discount_price;
			$gst=($this->cart->total()*8)/100;
			$total_price=$this->cart->total()+$delivery_charges+20;
		}
		?>
											<div class="your-order-bottom">
                                                <ul>
                                                    <li class="your-order-shipping">Sub Total</li>
                                                    <li>₹&nbsp;&nbsp;<?php echo $this->cart->format_number($this->cart->total()); ?>.00</li>
                                                </ul>
                                            </div>
											<div class="your-order-bottom">
                                                <ul>
                                                    <li class="your-order-shipping">Shiping Charges</li>
                                                    <li>₹&nbsp;&nbsp;20.00</li>
                                                </ul>
                                            </div>
                                            <div class="your-order-bottom">
                                                <ul>
                                                    <li class="your-order-shipping">Delivery Charge</li>
                                                    <li>₹&nbsp;&nbsp;<?php echo $delivery_charges; ?>.00</li>
                                                </ul>
                                            </div>
                                            <div class="your-order-total">
                                                <ul>
                                                    <li class="order-total">Grand Total</li>
                                                    <li>₹&nbsp;&nbsp;<?php echo $total_price; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="checkout-form__single-field space-mb--30">
                                    <label><b>Choose Payment Method</b></label>
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
                                </div>
                                <button class="checkout-form__button">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of checkout body  ====================-->