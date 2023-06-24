
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Sub Categories</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/sub_category/');?>">Sub Categories</a></li>
                            <li class="breadcrumb-item active">Add Sub Category</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-6 col-md-6">
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
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Add New Sub Category</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/add_sub_categories');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Category*</label>
												<select required="" name="category_id" class="form-control">
													<option selected disabled>--Select Category--</option>
													<?php
													foreach($category_list as $category_list){?>
													<option value="<?php echo $category_list->id; ?>"><?php echo $category_list->name; ?></option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Sub Category Title*</label>
												<input type="text" required name="name" class="form-control" placeholder="Category Name">
											</div>
											<div class="form-group">
												<label class="form-label">YouTube URL*</label>
												<input type="text" name="youtube" class="form-control" placeholder="Enter YouTube URL">
											</div>
											<div class="form-group">
												<label class="form-label">Blog URL*</label>
												<input type="text" name="blog" class="form-control" placeholder="Enter Blog URL">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" required name="status" class="form-control">
													<option selected value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Sub Category Image*</label>
												<div class="input-group">
													<div class="custom-file">
														<input name="sub_category_img" type="file" class="custom-file-input" id="image"  aria-describedby="inputGroupFileAddon04">
														<label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
													</div>
												</div>
												<div class="" id="gallery">
													
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														<textarea required name="description" class="text-control" placeholder="Enter Description"></textarea>
													</div>
												</div>
											</div>
											<button class="save-btn hover-btn" type="submit">Add New Sub Category</button>
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
	        	$('#gallery').append('<img src='+event.target.result+' alt="" height="70px" width="100px" style="border:5px solid green;">')
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