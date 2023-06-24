<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Orders</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/getAudit/');?>">Orders</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                        <div class="row">
							<div class="col-xl-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h2 class="title1458">Invoice</h2>
										<span class="order-id">Bill No. #<?php echo $product->bill_no;?></span> 
									</div>
									<div class="invoice-content">
										<div class="row">
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date">
													<b>Order Date :</b> <?php echo $product->date; ?><br/>
													<b>Payment Mode :</b> <?php echo $product->payment_mode;?>
												</div>
											</div>
											<div class="col-lg-6 col-sm-6">
												<div class="ordr-date right-text">
													<b>Order Address :</b><br>
													<?php echo $product->address;?>
									
												</div>
											</div>
											<div class="col-lg-12">
												<div class="card card-static-2 mb-30 mt-30">
													<div class="card-body-table">
														<div class="table-responsive">
															<table class="table ucp-table table-hover">
																<thead>
																	<tr>
																		<th>Customer Name</th>
																		<th>Mpbile Number</th>
														                <th>Item Name</th>
																		<th class="text-center">Per Unit</th>
																		<th class="text-center">Qty</th>
																		<th class="text-center">Wholesale</th>
																		<th>Reference Name</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																	<td><?php echo $product->customer_name; ?></td>
																	<td><?php echo $product->number; ?></td>
																		<td>
                														    <?php echo $product->product; ?>
                                                                        </td>
																		<td class="text-center">₹<?php echo $product->unit_price; ?></td>
																		<td class="text-center"><?php echo $product->qty; ?></td>
																		<td class="text-center"><span class="badge-item badge-status"><?php if($products->wholesale=='1'){
														echo"Yes";
													}else{
														echo"No";
													} ?></span></td>
													<td><?php echo $product->reference_name; ?></td>
																	</tr>
																	
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-7"></div>
											<div class="col-lg-5">
												<div class="order-total-dt">
													<div class="order-total-left-text fsz-18">
														Total Amount
													</div>
													<div class="order-total-right-text fsz-18">
														₹<?php echo $product->unit_price*$product->qty; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>