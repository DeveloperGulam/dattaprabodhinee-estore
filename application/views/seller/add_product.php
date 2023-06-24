
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Products</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/products/');?>">Products</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
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
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Add New Product</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('seller/add_products');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Name*</label>
												<input type="text" required="" name="name" class="form-control" placeholder="Product Name">
											</div>
											<div class="form-group">
												<label class="form-label">Category*</label>
												<select id="categtory" name="category" class="form-control">
													<option selected disabled>--Select Category--</option>
													<?php
													foreach($category_list as $category_list){?>
													<option value="<?php echo $category_list->id; ?>"><?php echo $category_list->name; ?></option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">MRP*</label>
												<input type="text" required="" name="orignal_price" class="form-control" placeholder="₹0">
											</div>
											<div class="form-group">
												<label class="form-label">Discount MRP*</label>
												<input type="text" required="" name="price" class="form-control" placeholder="₹0">
											</div>
											<div class="row">
											<div class="col-8">
											    <div class="form-group">
											        <label class="form-label">Packing Size* (Enter numaric value)</label>
												    <input type="text" value="0" name="packing_size" class="form-control">
											    </div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Packing Type*</label>
    												<select required="" id="packing_type" name="packing_type" class="form-control">
    													<option selected disabled>--Select Type--</option>
    													<option value="mg">Mg</option>
    													<option value="gm">Gm</option>
    													<option value="kg">Kg</option>
    													<option value="l">L</option>
    												</select>
    											</div>
											</div>
											</div>
											<div class="form-group">
												<label class="form-label">Available in Stock*</label>
												<input type="text" name="stock" required class="form-control" value="1">
											</div>
											<div class="form-group">
												<label class="form-label">Delivery Charges*</label>
												<input type="text" name="delivery_charge" required class="form-control" value="50">
											</div>
											<!--<div class="form-group">
												<label class="form-label">Instamojo Payment URL*</label>
												<input type="text" required="" name="payment_url" class="form-control" placeholder="Enter Your Instamojo Payment URL">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" name="status" class="form-control">
													<option selected value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>-->
											<div class="form-group">
												<label class="form-label">Product Images*</label>
												<div class="input-group">
													<div class="custom-file">
														<input required="" type="file" name="product_img" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon05">
														<label class="custom-file-label" for="inputGroupFile05">Choose Image</label>
													</div>
												</div>
												<ul class="add-produc-imgs" id="gallery">
													
												</ul>
											</div>
											<div class="form-group">
												<label class="form-label">Short Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea required="" name="description"></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Long Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea required="" name="long_description"></textarea>
													</div>
												</div>
											</div>
											<button class="save-btn hover-btn" type="submit">Add New Product</button>
										</form>
										</div> 
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
                <script>
                        CKEDITOR.replace( 'description' );
                        CKEDITOR.replace( 'long_description' );
                </script>
				<script type="text/javascript">
	$(function() {
    var imagesPreview = function(input) {
	    if (input.files) {
	      var filesAmount = input.files.length;
	      for (i = 0; i < filesAmount; i++) {
	        var reader = new FileReader();
	        reader.onload = function(event) {
	        	$('#gallery').append('<li><div class="add-cate-img-1"><img src='+event.target.result+' alt=""></div></li>')
	        }
	       	reader.readAsDataURL(input.files[i]);
	      }
		  }
		}

		$('#image').on('change', function() {
			$('#gallery').html('');
			imagesPreview(this);
		});
	});
	</script>