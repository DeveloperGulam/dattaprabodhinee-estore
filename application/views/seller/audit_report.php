
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Sales Transaction</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales Transaction</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-10">
								<a href="<?php echo base_url('seller/audit');?>" class="add-btn hover-btn">New Sale</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>Transaction History</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Bill No.</th>
														<th>Customer Name</th>
														<th>Item Name</th>
														<th>Payment Mode</th>
														<th> Date</th>
														<th>Wholesale</th>
														<th>Quantity</th>
														<th>Per Unit Price</th>
														<th>Total Price</th>
														<th>View Details</th>
													</tr>
												</thead>
												<tbody>
												    <?php $count=0;
													foreach($products as $products){
														$count++; ?>
													<tr>
														<td><?php echo $count; ?></td>
														<td>
															<?php echo $products->bill_no; ?>
														</td>
														<td>
														    <?php echo $products->customer_name; ?>
                                                        </td>
														<td><?php echo $products->product; ?></td>
														<td><?php echo $products->payment_mode; ?></td>
														<td><?php echo $products->date; ?></td>
														
														<td><span class="badge-item badge-status"><?php if($products->wholesale=='1'){
														echo"Yes";
													}else{
														echo"No";
													} ?></span></td>
													<td class="text-center"><?php echo $products->qty; ?></td>
													<td class="text-center">₹<?php echo $products->unit_price; ?></td>
													<td class="text-center">₹<?php echo $products->unit_price*$products->qty; ?></td>
														<td class="action-btns">
															<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('seller/salesDetails/').$products->id;?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> view</a>
														</td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>