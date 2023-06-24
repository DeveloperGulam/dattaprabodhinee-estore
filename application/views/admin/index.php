
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Dashboard</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="dashboard-report-card purple">
									<div class="card-content">
										<span class="card-title">Order Pending</span>
										<span class="card-count"><?php echo $pending_orders; ?></span>
									</div>
									<div class="card-media">
										<i class="fab fa-rev"></i>
									</div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
								<div class="dashboard-report-card red">
									<div class="card-content">
										<span class="card-title">Order Cancel</span>
										<span class="card-count"><?php echo $cancel_orders; ?></span>
									</div>
									<div class="card-media">
										<i class="far fa-times-circle"></i>
									</div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="dashboard-report-card info">
									<div class="card-content">
										<span class="card-title">Order Process</span>
										<span class="card-count"><?php echo $progress_orders; ?></span>
									</div>
									<div class="card-media">
										<i class="fas fa-sync-alt rpt_icon"></i>
									</div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
								<div class="dashboard-report-card success">
									<div class="card-content">
										<span class="card-title">Order Complete</span>
										<span class="card-count"><?php echo $completed_orders; ?></span>
									</div>
									<div class="card-media">
										<i class="fas fa-check rpt_icon"></i>
									</div>
                                </div>
                            </div>
							<!--<div class="col-xl-12 col-md-12">
								<div class="card card-static-1 mb-30">
									<div class="card-body">
										<div id="earningGraph"></div>
									</div>
								</div>
							</div>-->
							<div class="col-xl-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Recent Orders</h4>
										<a href="<?php echo base_url('admin/orders/');?>" class="view-btn hover-btn">View All</a> 
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover">
												<thead>
													<tr>
														<th style="width:130px">Order ID</th>
														<th>Item</th>
														<th style="width:200px">Order Date</th>
														<th style="width:300px">Payment</th>
														<th style="width:130px">Status</th>
														<th style="width:130px">Total</th>
														<th style="width:100px">Reports</th>
														<th style="width:100px">Action</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($order_details as $order_details){?>
													<tr>
														<td>#<?php echo $order_details->order_no; ?></td>
														<td>
															<a href="#" target="_blank"><?php echo $order_details->name; ?></a>
														</td>
														<td>
															<span class="delivery-time"><?php echo substr($order_details->date_time,0,10); ?></span>
															<span class="delivery-time"><?php echo substr($order_details->date_time,11,23); ?></span>
														</td>
														<td>
														    <?php if($order_details->payment_status=='0'){ ?>
															<span class="text-danger">Pending</span>
    														<?php }?>
    														<?php if($order_details->payment_status=='1'){ ?>
    															<span class="text-success">Received</span>
    														<?php }?>
														</td>
														<td><?php if($order_details->status=='0'){ ?>
															<span class="badge-item badge-status">Pending</span>
														<?php }?>
														<?php if($order_details->status=='1'){ ?>
															<span class="badge-item badge-status bg-warning">Placed</span>
														<?php }?>
														<?php if($order_details->status=='2'){ ?>
															<span class="badge-item badge-status bg-primary">Progress</span>
														<?php }?>
														<?php if($order_details->status=='3'){ ?>
															<span class="badge-item badge-status">Canceled</span>
														<?php }?>
														<?php if($order_details->status=='4'){ ?>
															<span class="badge-item badge-status bg-success">Completed</span>
														<?php }?>
														</td>
														<td>₹<?php echo $order_details->total_amount; ?></td>
														<td><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/Report/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>">View</a></td>
														<td class="action-btns">
															<a href="<?php echo base_url('admin/order_details/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="views-btn"><i class="fas fa-eye"></i></a>
															<a href="<?php echo base_url('admin/edit_order/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="edit-btn"><i class="fas fa-edit"></i></a>
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
                