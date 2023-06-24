
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Categories</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/category/');?>">Categories</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
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
										<h4>Add New Category</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/add_categories');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Name*</label>
												<input type="text" required name="name" class="form-control" placeholder="Category Name">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" required name="status" class="form-control">
													<option selected value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Category Image*</label>
												<div class="input-group">
													<div class="custom-file">
														<input required name="category_img" type="file" class="custom-file-input" id="image"  aria-describedby="inputGroupFileAddon04">
														<label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
													</div>
												</div>
												<div class="add-cate-img" id="gallery">
													
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
											<button class="save-btn hover-btn" type="submit">Add New Category</button>
										</form>
										</div> 
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
<script type="text/javascript">
	$(function() {
    var imagesPreview = function(input) {
	    if (input.files) {
	      var filesAmount = input.files.length;
	      for (i = 0; i < filesAmount; i++) {
	        var reader = new FileReader();
	        reader.onload = function(event) {
	        	$('#gallery').append('<img src='+event.target.result+' alt="">')
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