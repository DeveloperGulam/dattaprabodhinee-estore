
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Products</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/products/');?>">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
										<h4>Edit This Product</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/update_product/'.$details->id);?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Name*</label>
												<input type="text" value="<?php echo $details->name; ?>" name="name" class="form-control" placeholder="Product Name">
											</div>
											<div class="form-group">
												<label class="form-label">Category*</label>
												<select id="categtory" name="category" class="form-control">
													<option selected disabled>--Select Category--</option>
													<?php
													foreach($category_list as $category_list){?>
													<option <?php if($details->category==$category_list->id){echo'selected';} ?> value="<?php echo $category_list->id; ?>"><?php echo $category_list->name; ?></option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Sub Category*</label>
												<select required="" id="sub_categtory_id" name="sub_categtory_id" class="form-control">
													<option selected disabled>--Choose Sub Category--</option>
													<?php
													foreach($sub_category_list as $sub_category_list){?>
													<option <?php if($details->sub_category_id==$sub_category_list->id){echo'selected';} ?> value="<?php echo $sub_category_list->id; ?>"><?php echo $sub_category_list->sub_category_name; ?></option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">MRP*</label>
												<input type="text" value="<?php echo $details->orignal_price; ?>" name="orignal_price" class="form-control" placeholder="₹0">
											</div>
											<div class="form-group">
												<label class="form-label">Discount MRP*</label>
												<input type="text" value="<?php echo $details->price; ?>" name="price" class="form-control" placeholder="₹0">
											</div>
											<div class="row">
											<div class="col-8">
											    <div class="form-group">
											        <label class="form-label">Packing Size* (Enter numaric value)</label>
												    <input type="text" value="<?php echo $details->packing_size; ?>" name="packing_size" class="form-control" placeholder="0">
											    </div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Packing Type*</label>
    												<select required="" id="packing_type" name="packing_type" class="form-control">
    													<option selected disabled>--Select Type--</option>
    													<option value="mg" <?php if($details->packing_type=='mg'){echo'selected';} ?>>Mg</option>
    													<option value="gm" <?php if($details->packing_type=='gm'){echo'selected';} ?>>Gm</option>
    													<option value="kg" <?php if($details->packing_type=='kg'){echo'selected';} ?>>Kg</option>
    													<option value="l" <?php if($details->packing_type=='l'){echo'selected';} ?>>L</option>
    												</select>
    											</div>
											</div>
											</div>
											<div class="form-group">
												<label class="form-label">Available in Stock*</label>
												<input type="text" value="<?php echo $details->stock; ?>" name="stock" class="form-control" value="1">
											</div>
											<div class="form-group">
												<label class="form-label">Delivery Charges*</label>
												<input type="text" name="delivery_charge" value="<?php echo $details->delivery_charge; ?>" required class="form-control">
											</div>
											<div class="form-group">
												<label class="form-label">YouTube URL*</label>
												<input type="text" value="<?php echo $details->youtube; ?>" name="youtube" class="form-control" placeholder="Enter YouTube URL">
											</div>
											<div class="form-group">
												<label class="form-label">Subcription URL*</label>
												<input type="text" value="<?php echo $details->subcription; ?>" name="subcription" class="form-control" placeholder="Enter Subcription URL">
											</div>
											<div class="form-group">
												<label class="form-label">Want to Show On Banner*</label>
												<select id="banner_product" name="banner_product" class="form-control">
													<option <?php if($details->banner_product=='0'){echo'selected';} ?> value="0">No</option>
													<option <?php if($details->banner_product=='1'){echo'selected';} ?> value="1">Yes</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" name="status" class="form-control">
													<option <?php if($details->status=='1'){echo'selected';} ?> value="1">Active</option>
													<option <?php if($details->status=='0'){echo'selected';} ?> value="0">Inactive</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Product Images*</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" name="product_img" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon05">
														<label class="custom-file-label" for="inputGroupFile05">Choose Image</label>
													</div>
												</div>
												<ul class="add-produc-imgs" id="gallery">
													<li><div class="add-cate-img-1"><img src="<?php echo base_url('assets/images/product/'.$details->product_img); ?>" alt=""></div></li>
												</ul>
											</div>
											<div class="form-group">
												<label class="form-label">Short Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea name="description"><?php echo $details->description; ?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Long Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea name="long_description"><?php echo $details->long_description; ?></textarea>
													</div>
												</div>
											</div>
											<button class="save-btn hover-btn" type="submit">Edit This Product</button>
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