
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Coupons</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/coupons/');?>">Coupons</a></li>
                            <li class="breadcrumb-item active">Add Coupons</li>
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
										<h4>Add New Coupons (Promocode)</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/add_promo');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Name*</label>
												<input type="text" name="name" class="form-control" placeholder="Coupons Name">
											</div>
											<div class="form-group">
												<label class="form-label">Promocode*</label>
												<input type="text" name="code" class="form-control" placeholder="Promocode">
											</div>
											<div class="form-group">
												<label class="form-label">Discount Type*</label>
												<select id="discount_type" name="discount_type" class="form-control">
													<option selected value="fixed">Fixed</option>
													<option value="percentage">Percentage</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Value*</label>
												<input type="text" name="value" class="form-control" placeholder="Discount Value">
											</div>
											<div class="form-group">
												<label class="form-label">From Date*</label>
												<input type="date" name="from_date" class="form-control" placeholder="Promocode Valid From">
											</div>
											<div class="form-group">
												<label class="form-label">Expiry Date*</label>
												<input type="date" name="to_date" class="form-control" placeholder="Promocode Expiry Date">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" name="status" class="form-control">
													<option selected value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
											<button class="save-btn hover-btn" type="submit">Add New Promocode</button>
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