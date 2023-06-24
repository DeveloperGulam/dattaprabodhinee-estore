
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Request Stock</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/stocks/');?>">Stocks</a></li>
                            <li class="breadcrumb-item active">Request Stock</li>
                        </ol>
						<?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('err'); ?>
							</div>
							<?php } ?>
                        <div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Request Stock</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('seller/requestStock/');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">How many stock do you want?*</label>
												<input type="text" name="stock_qty" class="form-control">
											</div>
											<input type="hidden" value="<?php echo $product_id; ?>" name="product_id">
											<input type="hidden" value="<?php echo $product_name;?>" name="product_name"/>
											<input type="hidden" value="<?php echo $packing_size;?>" name="packing_size"/>
											<input type="hidden" value="<?php echo $packing_type;?>" name="packing_type"/>
											<input type="hidden" value="<?php echo $price;?>" name="price"/>
											<button class="save-btn hover-btn" type="submit">Request Now</button>
										</form>
										</div> 
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>