
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Shops</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/products');?>">Products</a></li>
                            <li class="breadcrumb-item active">Product Details</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-5 col-md-6">
								<div class="card card-static-2 mb-30">
									<div class="card-body-table">
										<div class="shopowner-content-left text-center pd-20">
											<div class="shop_img">
												<img src="<?php if($product->product_img==''){
											echo base_url('assets/images/product/img-1.jpg');
										}
										else{
											echo base_url('assets/images/product/'.$product->product_img);
										}
										?>" alt="">
											</div>
											<ul class="product-dt-purchases">
												<li>
													<div class="product-status">
														Orders <span class="badge-item-2 badge-status"><?php echo $product->orders; ?></span>
													</div>
												</li>
												<li>
													<div class="product-status">
														In Stock <span class="badge-item-2 badge-status"><?php echo $product->stock; ?></span>
													</div>
												</li>
											</ul>
											<div class="shopowner-dts">
												<div class="shopowner-dt-list">
													<span class="left-dt">Price</span>
													<span class="right-dt">₹<?php echo $this->uri->segment(4); ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Status</span>
													<span class="right-dt"><?php if($product->status=='1'){
														echo"Active";
													}else{
														echo"Inactive";
													} ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Category</span>
													<span class="right-dt"><?php echo $product->category; ?></span>
												</div>
												<div class="shopowner-dt-list">
													<span class="left-dt">Created</span>
													<span class="right-dt"><?php echo $product->date; ?></span>
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