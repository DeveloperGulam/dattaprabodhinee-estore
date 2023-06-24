
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('select').multiselect();
    });
</script>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Create Group</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/cities/');?>">Cities</a></li>
                            <li class="breadcrumb-item active">Create Group</li>
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
							<div class="col-lg-5 col-md-6">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Create New Group</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										    <form action="<?php echo base_url('admin/createNewGroup');?>" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="form-label">Group Name*</label>
												<input type="text" class="form-control" name="group_name" placeholder="City Name">
											</div>
											<div class="form-group">
												<label class="form-label">Add Vendor*</label>
												<select required="" id="seller_id" name="seller_id[]" class="form-control selectpicker" multiple data-live-search="true" data-droptop-auto="false">
													<?php
													foreach($seller_details as $seller_details){?>
													<option value="<?php echo $seller_details->id; ?>"><?php echo $seller_details->name; ?></option>
													<?php }?>
													
												</select>
											</div>
											<button class="save-btn hover-btn" type="submit">Create Group</button>
											</form>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
<script>
$(document).ready(function(){
$(".imgAdd2").click(function(){
  $(this).closest(".row").find('.addonf').before('<div class="col-lg-8"><div class="form-group mb-3"><label class="form-label">Pincode*</label><input name="pincode[]"  type="text" class="form-control" placeholder="Enter Your Pincode"></div></div>');
});
});
</script>