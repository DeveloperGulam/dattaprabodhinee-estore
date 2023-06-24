<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Orders</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/orders/');?>">Orders</a></li>
                            <li class="breadcrumb-item active">Order View</li>
                        </ol>
                        <div class="row">
							<div class="col-xl-12 col-md-12">
								<div class="">
									<div class="card-title-2">
										<h2 class="title1458"></h2>
										<span class="order-id"><button class="btn btn-danger" onclick="printDiv('print-content')">Print</button></span> 
									</div>
								</div>
							</div>
                        </div>
<script>

function printDiv(divName) {

 var printContents = document.getElementById(divName).innerHTML;
 var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
                        <div class="row" id="print-content">
							<div class="col-xl-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h2 class="title1458">Invoice</h2>
										<span class="order-id"><img height="50px" src="<?php echo base_url('assets/images/logo2.png'); ?>"/></span> 
									</div>
									<div class="invoice-content">
										<div class="row">
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date">
													<b>Order Date :</b> <?php echo substr($order_info->date_time,0,10); ?><br/>
													<b>Order By :</b> <?php echo $order_info->name;?>,<br>
													<b>User's Email :</b> <?php echo $order_info->email;?>,<br>
													<b>User's Number :</b> <?php echo $order_info->number;?>,<br>
													<b>Payment Method :</b> <?php if($order_info->paymentmethod=='cod'){
													        echo 'Cash On Delivery';
													   }
													   else
													   {
													        echo 'Online Payment';
													   }?>
												</div>
											</div>
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date right-text">
													<b>Order No: #<?php echo $order_info->order_no;?> </b><br>
													<?php echo $order_info->address;?>,<br>
													<?php echo $order_info->locality;?>,<br>
													<?php echo $order_info->state;?>,<br>
													<?php echo $order_info->pincode;?><br>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="card card-static-2 mb-30 mt-30">
													<div class="card-title-2">
														<h4>Recent Orders</h4>
													</div>
													<div class="card-body-table">
														<div class="table-responsive">
															<table class="table ucp-table table-hover">
																<thead>
																	<tr>
																		<th style="width:130px">#</th>
																		<th>Item</th>
																		<th style="width:150px" class="text-center">Price</th>
																		<th style="width:150px" class="text-center">Qty</th>
																		<th style="width:100px" class="text-center">Total</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																	<?php $count=0;
													foreach($item_info as $item_info){
														$count++; ?>
																		<td><?php echo $count; ?></td>
																		<td>
																			<a href="#" target="_blank"><?php echo $item_info->product_name; ?></a>
																		</td>
																		<td class="text-center">₹<?php echo $item_info->subtotal/$item_info->qty; ?></td>
																		<td class="text-center"><?php echo $item_info->qty; ?></td>
																		<td class="text-center">₹<?php echo $item_info->subtotal; ?></td>
																	</tr>
													<?php } ?>
																	
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-7"></div>
											<div class="col-lg-5">
												<div class="order-total-dt">
													<div class="order-total-left-text">
														Sub Total
													</div>
													<?php $subtotal=$order_info->total_amount-120;?>
													<div class="order-total-right-text">
														₹<?php echo $subtotal;?>
													</div>
												</div>
												<div class="order-total-dt">
													<div class="order-total-left-text">
														Shipping Fee
													</div>
													<div class="order-total-right-text">
														₹20
													</div>
												</div>
												<div class="order-total-dt">
													<div class="order-total-left-text">
														Delivery Fee
													</div>
													<div class="order-total-right-text">
														₹100
													</div>
												</div>
												<div class="order-total-dt">
													<div class="order-total-left-text fsz-18">
														Total Amount
													</div>
													<div class="order-total-right-text fsz-18">
														₹<?php echo $order_info->total_amount;?>
													</div>
												</div>
											</div>
											<div class="col-lg-7"></div>
											<div class="col-lg-5">
												<div class="select-status">
													<label for="status">Status*</label>
													<?php if($order_info->status=='0'){ ?>
													<div class="status-active">
														Pending
													</div>
													<?php } ?>
													<?php if($order_info->status=='1'){ ?>
													<div class="status-active text-warning">
														Placed
													</div>
													<?php } ?>
													<?php if($order_info->status=='2'){ ?>
													<div class="status-active text-primary">
														Progress
													</div>
													<?php } ?>
													<?php if($order_info->status=='3'){ ?>
													<div class="status-active">
														Canceled
													</div>
													<?php } ?>
													<?php if($order_info->status=='4'){ ?>
													<div class="status-active text-success">
														Completed
													</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>