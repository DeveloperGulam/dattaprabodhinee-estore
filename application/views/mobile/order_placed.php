<style>
.order-placed-dt {
    text-align: center;
    padding: 20px 0 14px;
    float: left;
    width: 100%;
}

.order-placed-dt .icon-circle {
    font-size: 56px;
    color: #f55d2c;
}
.order-placed-dt h2 {
    font-size: 30px;
    font-weight: 500;
    color: #2b2f4c;
    text-align: center;
    margin-bottom: 25px;
}

.order-placed-dt p {
    font-size: 16px;
    font-weight: 500;
    color: #3e3f5e;
    margin-bottom: 0;
    text-align: center;
	line-height: 24px;
}

.delivery-address-bg {
    margin-top: 40px;
    background: #fff;
    border-radius: 5px;
    float: left;
    width: 100%;
	text-align: left;
	box-shadow: 0 1px 2px 0 #e9e9e9;
}

.title585 {
    display: inline-block;
    float: left;
    width: 100%;
	border-bottom: 1px solid #efefef;
}

.pln-icon {
    float: left;
    width: 50px;
    height: 50px;
    text-align: center;
	line-height: 50px;
    margin-right: 10px;
}

.title585 h4 {
    float: left;
    margin-top: 0;
    font-weight: 500;
    font-size: 16px;
    color: #2b2f4c;
	line-height: 50px;
}

.pln-icon i {
    font-size: 20px;
	color: #f55d2c;
}

.address-placed-dt1 {
    float: left;
    padding: 20px;
	width: 100%;
}

.address-placed-dt1 li {
    margin-bottom: 10px;
}

.address-placed-dt1 li:last-child {
    margin-bottom: 0;
}

.address-placed-dt1 i {
    margin-right: 5px;
}

.address-placed-dt1 p {
    font-size: 14px;
    font-weight: 500;
	text-align: left;
	color: #2b2f4c;
}

.address-placed-dt1 p span {
    margin-left: 10px;
	font-weight: 400;
	color: #3e3f5e;
}

.stay-invoice {
    float: left;
    width: 100%;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    border-top: 1px solid #efefef;
    border-bottom: 1px solid #efefef;
}

.invc-link {
    margin-left: auto;
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    background: #f55d2c;
    padding: 5px 15px;
    border-radius: 5px;
}

.st-hm {
    font-size: 16px;
    font-weight: 500;
    color: #2b2f4c;
}

.st-hm i {
    margin-left: 5px;
}

.placed-bottom-dt {
    padding: 20px;
    float: left;
    font-size: 14px;
    font-weight: 400;
    color: #3e3f5e;
    margin-bottom: 0;
    text-align: center;
    line-height: 24px;
    width: 100%;
}

.placed-bottom-dt span {
    font-weight: 600;
    color: #f55d2c;
}
</style>
<!-- Body Start -->
	<div class="wrapper">
		<div class="all-product-grid">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8">
						<div class="order-placed-dt" id="print-content">
							<i class="fa fa-check-circle icon-circle"></i>
							<h4>Order Successfully Placed</h4>
							<p>Thank you for your order!</p>
							<div class="delivery-address-bg">
								<div class="title585">
									<div class="pln-icon"><i class="fa fa-telegram"></i></div>
									<h4>Your order will be sent to this address</h4>
								</div>
								<ul class="address-placed-dt1">
									<li><p><i class="uil uil-cart"></i>Order No. :<span>#<?php echo $order_details->order_no; ?></span></p></li>
									<li><p><i class="uil uil-map-marker-alt"></i>Address :<span><?php echo $order_details->address; ?></span></p></li>
									<li><p><i class="uil uil-phone-alt"></i>Number :<span>+91<?php echo $order_details->number; ?></span></p></li>
									<li><p><i class="uil uil-envelope"></i>Email :<span><?php echo $order_details->email; ?></span></p></li>
									<li><p><i class="uil uil-card-atm"></i>Payment Method :<span><?php echo $order_details->paymentmethod; ?></span></p></li>
								</ul>
								<div class="stay-invoice">
									<div class="st-hm">Stay Home<i class="fa fa-smile text-danger"></i></div>
									<a href="javascript:;" onclick="printDiv('print-content')" class="invc-link hover-btn">invoice</a>
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

function printDiv(divName) {

 var printContents = document.getElementById(divName).innerHTML;
 var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>