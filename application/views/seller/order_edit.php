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
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h2 class="title1458">Invoice</h2>
										<span class="order-id">Order #<?php echo $order_info->order_no;?></span> 
									</div>
									<div class="invoice-content">
										<div class="row">
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date">
													<b>Order Date :</b> <?php echo substr($order_info->date_time,0,10); ?>
												</div>
											</div>
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date right-text">
													<b>Order Address :</b><br>
													#<?php echo $order_info->flat;?>,<br>
													<?php echo $order_info->street;?>,<br>
													<?php echo $order_info->locality;?>,<br>
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
													<?php $subtotal=$order_info->total_amount-50;?>
													<div class="order-total-right-text">
														₹<?php echo $subtotal;?>
													</div>
												</div>
												<div class="order-total-dt">
													<div class="order-total-left-text">
														Delivery Fees
													</div>
													<div class="order-total-right-text">
														₹50
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
												<form action="<?php echo base_url('seller/update_order_status/'.$order_info->id); ?>" method="post">
													<label for="status">Status*</label>
													<div class="input-group">
														<select id="status" name="status" class="custom-select">
															<option value="0" selected disabled>Pending</option>
															<option value="1">Placed</option>
															<option value="2">Progress</option>
															<option value="3">Cancel</option>
															<option value="4">Completed</option>
														</select>
														<div class="input-group-append">
															<button class="status-btn hover-btn" type="submit">Submit</button>
														</div>
													</div>
												</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>