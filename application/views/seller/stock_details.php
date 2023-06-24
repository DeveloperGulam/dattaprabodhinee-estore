
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Stocks</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/stocks');?>">stock</a></li>
                            <li class="breadcrumb-item active">Stock Details</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-5 col-md-6">
								<div class="card card-static-2 mb-30">
									<div class="card-body-table">
										<div class="shopowner-content-left text-center pd-20">
											<div class="shop_img">
												<img src="<?php if($product->product_img==''){
											echo base_url('assets/images/product.jpg');
										}
										else{
											echo base_url('assets/images/product/'.$product->product_img);
										}
										?>" alt="" style="height:85px">
											</div>
											<ul class="product-dt-purchases">
												<li>
													<div class="product-status">
														Orders <span class="badge-item-2 badge-status"><?php echo $product->stock_orders; ?></span>
													</div>
												</li>
												<li>
													<div class="product-status">
														In Stock <span class="badge-item-2 badge-status"><?php echo $product->stock_qty; ?></span>
													</div>
												</li>
											</ul>
											<div class="shopowner-dts">
												<div class="shopowner-dt-list">
													<span class="left-dt">Product Name</span>
													<span class="right-dt"><?php echo $product->name; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">MRP</span>
													<span class="right-dt">₹<?php echo $product->orignal_price; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Selling Price</span>
													<span class="right-dt">₹<?php echo $product->price; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Transfer Date</span>
													<span class="right-dt"><?php echo substr($product->transfer_date_time,0,10); ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-5 col-md-6">
								<div class="card card-static-2 mb-30">
									<div class="card-body-table">
										<div class="shopowner-content-left text-center pd-20">
											<?php echo $product->name; ?>
										</div>
										<div class="shopowner-content-left text-center pd-20">
											<?php echo $product->description; ?>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>