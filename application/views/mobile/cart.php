 <style>
     .abs{
	position: relative;
	display: inline-block;
	width: 90px;
	height: 30px;
	padding: 0;
}

.qtybutton {
	font-size: 16px;
	line-height: 30px;
	position: absolute;
	float: inherit;
	width: 20px;
	margin: 0;
	cursor: pointer;
	-webkit-transition: all 0.3s ease 0s;
	-o-transition: all 0.3s ease 0s;
	transition: all 0.3s ease 0s;
	text-align: center;
	color: #111111;
}

.dec.qtybutton {
	top: 0;
	left: 0;
	height: 30px;
	border-right: 1px solid #e6e6e6;
}

.inc.qtybutton {
	top: 0;
	right: 0;
	height: 30px;
	border-left: 1px solid #e6e6e6;
}

input.cart-plus-minus-box {
	font-size: 14px;
	float: left;
	width: 90px;
	height: 30px;
	margin: 0;
	padding: 0;
	text-align: center;
	color: #111111;
	border: 1px solid #e6e6e6;
	background: transparent none repeat scroll 0 0;
}
 </style>
 <!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url();?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="page-title text-center">Cart</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of breadcrumb area  ====================-->
        <!--====================  cart product area ====================-->
        <div class="cart-product-area">
		<?php $weight=0;
		//if($this->cart->total_items()!==0){
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
            <div class="cart-product border-bottom--medium">
                <div class="cart-product__image">
                    <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$products['id'])).'/'.strtolower(str_replace(' ', '-',$products['name']));?>">
                        <img src="<?php if(!empty($products['image'])){
											echo base_url('assets/images/product/'.$products['image']);
											}
											else{
												echo base_url('assets/images/sub_category/'.$products['sub_category_image']);
											}
											?>" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="cart-product__content">
                    <h3 class="title"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$products['id'])).'/'.strtolower(str_replace(' ', '-',$products['name']));?>"><?php echo $products['name']; ?></a></h3>
                    <span class="category"><?php echo $products['product_no']; ?></span>
                    <div class="price">
                        <span class="main-price">₹<?php echo $products['orignal_price']; ?></span>
                        <span class="discounted-price">₹<?php echo $products['price']; ?></span>
                    </div>
                </div>
                <div class="cart-product__counter">
                    <a style="right:0;" href="<?php echo base_url('Welcome_controller/removeItem/'.$products['rowid']).'/cart/'; ?>" type="button" class="cart-close-btn">Remove</a>
                    <div class="abs">
					<div class="dec qtybutton" onclick="decCartItem('<?php echo $products['rowid']; ?>','qty')">-</div>
                        <input class="cart-plus-minus-box" type="text" step="1" id="qty" name="qty" value="<?php echo $products['qty']; ?>" disabled value="<?php echo $products['qty']; ?>">
					<div class="inc qtybutton" onclick="updateCartItem('<?php echo $products['rowid']; ?>','qty')">+</div>
                    </div>
                </div>
            </div>
		<?php }?>
        </div>
        <!--====================  End of cart product area  ====================-->
        <!--<div class="discount-code-wrapper space-mt--20">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title">Use Coupon Code</h4>
                        </div>
                        <div class="discount-code">
                            <p>Enter your coupon code if you have one.</p>
                            <form>
                                <input type="text" required="" name="name">
                                <button class="cart-btn-2" type="submit">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
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
		?>
        <div class="grand-total space-mt--20">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title">Cart Total</h4>
                        </div>
                        <!--<h5>Sub Total <span>₹<?php echo $this->cart->format_number($this->cart->total()); ?></span></h5>-->
                        <div class="total-shipping">
                            <h5>Sub Total <span>₹<?php echo $this->cart->format_number($this->cart->total()); ?></span></h5>
                            <ul>
                                <li> Shipping Charges <span>₹&nbsp;&nbsp;20.00</span></li>
                                <li> Delivery Charges <span>₹&nbsp;&nbsp;<?php echo $delivery_charges; ?>.00</span></li>
                            </ul>
                        </div>
                        <!--<div class="total-shipping">
                            <h5>Delivery Charges <span>₹50</span></h5>
                            <ul>
                                <li><input type="radio" name="shippingInput"> Standard <span>$20.00</span></li>
                                <li><input type="radio" name="shippingInput"> Express <span>$30.00</span></li>
                            </ul>
                        </div>-->
                        <p id="sub_total" style="display:none;"><?php echo $this->cart->total(); ?></p>
                        <h4 class="grand-total-title">Grand Total <span>₹<?php echo $total_price; ?></span></h4>
                        <a id="checkout_btn" href="javascript:;">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
		<?php }
		else{
		   ?><a href='<?php echo base_url()?>' class='btn text-white' style='margin: 0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);padding:10px;background:#f55d2c;'>Shop Now</a>
		<?php }?>
		<script>
				$(document).ready(function(){
					$('#more_btn').click(function(){
						$('#show_more').show();
						$('#show_default').hide();
					})
					$('#hide_more_btn').click(function(){
						$('#show_more').hide();
						$('#show_default').show();
					})
				})
				</script>
	<script>
	function updateCartItem(rowid,qty){
		var search = $('#'+qty).val();
		var add=1;
		var qty=parseInt(search)+parseInt(add);
		// alert(qty);
		$.ajax({
		url: "<?php echo base_url('Welcome_controller/updateItemQty/'); ?>",
		method: 'POST',
		data: { rowid:rowid,qty:qty },
		success:function(response){
			location.reload();
		}
	})
			
	}
	</script>
	<script>
	function decCartItem(rowid,qty){
		var search = $('#'+qty).val();
		var add=1;
		var qty=parseInt(search)-parseInt(add);
		$.ajax({
		url: "<?php echo base_url('Welcome_controller/updateItemQty/'); ?>",
		method: 'POST',
		data: { rowid:rowid,qty:qty },
		success:function(response){
			location.reload();
		}
	})
			
	}
	$(document).ready(function(){
	$('#checkout_btn').click(function(){
		    var subtotal = $("#sub_total").text()
		    if(subtotal < 499){
	                swal({
            		  title: "Sorry!",
            		  text: "Can't place order need minimum cart value of Rs.500 !",
            		  icon: "error",
            		  button: false,
            		  timer:2500,
            		});
	        }
	        else{
	            window.location.href="<?php echo base_url('checkout/'); ?>";
	        }
		})
	})
	</script>