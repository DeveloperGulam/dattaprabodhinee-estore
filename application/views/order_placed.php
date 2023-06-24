<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Order Placed</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid" id="print-content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8">
						<div class="order-placed-dt">
							<i class="uil uil-check-circle icon-circle"></i>
							<h2>Order Successfully Placed</h2>
							<p>Thank you for your order on Dattaprabodhinee E-store</span></p>
							<div class="delivery-address-bg">
								<div class="title585">
									<div class="pln-icon"><i class="uil uil-telegram-alt"></i></div>
									<h4>Your order will be sent to this address</h4>
								</div>
								<ul class="address-placed-dt1">
									<li><p><i class="uil uil-cart"></i>Order Number :<span>#<?php echo $order_details->order_no; ?></span></p></li>
									<li><p><i class="uil uil-map-marker-alt"></i>Address :<span><?php echo $order_details->address; ?></span></p></li>
									<li><p><i class="uil uil-phone-alt"></i>Phone Number :<span>+91<?php echo $order_details->number; ?></span></p></li>
									<li><p><i class="uil uil-envelope"></i>Email Address :<span><?php echo $order_details->email; ?></span></p></li>
									<li><p><i class="uil uil-card-atm"></i>Payment Method :<span><?php echo $order_details->paymentmethod; ?></span></p></li>
								</ul>
								<div class="stay-invoice">
									<div class="st-hm">Stay Home<i class="uil uil-smile text-danger"></i></div>
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