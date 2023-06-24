
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Customers</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/customers/');?>">Customers</a></li>
                            <li class="breadcrumb-item active">Customer View</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-5 col-md-6">
								<div class="card card-static-2 mb-30">
									<div class="card-body-table">
										<div class="shopowner-content-left text-center pd-20">
											<div class="customer_img">
												<img src="<?php if($customer->customer_img==''){
											echo base_url('assets/images/avatar/img-1.jpg');
										}
										else{
											echo base_url('assets/images/customers_img/'.$customer->customer_img);
										}
										?>" alt="">
											</div>
											<div class="shopowner-dt-left mt-4">
												<h4><?php echo $customer->name; ?></h4>
												<span>Customer</span>
											</div>
											<ul class="product-dt-purchases">
												<li>
													<div class="product-status">
														Purchased <span class="badge-item-2 badge-status"><?php echo $customer->purchased; ?></span>
													</div>
												</li>
												<li>
													<div class="product-status">
														Canceled <span class="badge-item-2 badge-status"><?php echo $customer->canceled; ?></span>
													</div>
												</li>
											</ul>
											<div class="shopowner-dts">
												<div class="shopowner-dt-list">
													<span class="left-dt">Name</span>
													<span class="right-dt"><?php echo $customer->name; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Email</span>
													<span class="right-dt"><?php echo $customer->email; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Phone</span>
													<span class="right-dt"><?php echo $customer->number; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Address</span>
													<span class="right-dt"><?php echo $customer->address; ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>