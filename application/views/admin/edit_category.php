
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Update Categories</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/category/');?>">Categories</a></li>
                            <li class="breadcrumb-item active">Update Category</li>
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
										<h4>Update This Category</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/update_details/').$details->id.'/category/';?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Name*</label>
												<input type="text" name="name" value="<?php echo $details->name; ?>" class="form-control" placeholder="Category Name">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" name="status" class="form-control">
													<option <?php if($details->status=='1'){ echo 'selected';} ?> value="1">Active</option>
													<option <?php if($details->status=='0'){ echo 'selected';} ?> value="0">Inactive</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Category Image*</label>
												<div class="input-group">
													<div class="custom-file">
														<input name="category_img" type="file" class="custom-file-input" id="image"  aria-describedby="inputGroupFileAddon04">
														<label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
													</div>
												</div>
												<div class="add-cate-img" id="gallery">
													<img src="<?php echo base_url('assets/images/category/'.$details->category_img); ?>" alt="">
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														<textarea name="description" class="text-control" placeholder="Enter Description"><?php echo $details->description; ?></textarea>
													</div>
												</div>
											</div>
											<button class="save-btn hover-btn" type="submit">Update This Category</button>
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