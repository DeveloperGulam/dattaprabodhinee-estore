
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>
    $(document).ready(function () {
      $('#product_id').selectize({
          sortField: 'text'
      });
  });
</script>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Transfer Stock</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/stocks_history/');?>">Stocks History</a></li>
                            <li class="breadcrumb-item active">Transfer Stock</li>
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
			<script>
			$(document).ready(function(){
 
            $('#categtory').change(function(){ 
                var id=$(this).val();
                // alert(id);
				 $.ajax({
                    url : "<?php echo site_url('Admin/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    // dataType : false,
                    dataType : 'json',
                    success: function(data){
						// var options = eval(data);
						// var x = data.toString();
                         // alert(x);
						// var len = options.length;
						// $("#sub_categtory_id").empty();
						// for( var i = 0; i<len; i++){
							// var id = options[i]['id'];
							// var name = options[i]['name'];
							// $("#sub_categtory_id").append("<option value='"+id+"'>"+name+"</option>");
						// }
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].subcategory_id+'>'+data[i].subcategory_name+'</option>';
                        }
                        $('#sub_categtory_id').html(html);
 
                    }
                });
            }); 
             
        });
		</script>
                        <div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Transfer New Product</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/transfer_stock_now');?>" method="post" enctype="multipart/form-data">
										    <div class="form-group">
												<label class="form-label">Select Product*</label>
												<select required="" id="product_id" name="product_id" class="form-control" placeholder="Pick a product...">
													<option selected disabled></option>
													<?php
													foreach($product as $products){?>
													<option value="<?php echo $products->id; ?>"><?php echo $products->name; ?></option>
													<?php }?>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Product Name*</label>
												<input required="" type="text" name="name" class="form-control" placeholder="Product Name">
											</div>
											<div class="row">
											<div class="col-8">
											    <div class="form-group">
											        <label class="form-label">Packing Size*</label>
												    <input type="text" name="packing_size" class="form-control">
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
												<label class="form-label">Per Unit Price*</label>
												<input type="text" name="price" class="form-control">
											</div>
											<div class="form-group">
												<label class="form-label">Quantity*</label>
												<input type="text" name="stock" class="form-control" value="1">
											</div>
											
											<div class="form-group">
												<label class="form-label">Transfer To*</label>
												<select required="" id="seller_id" name="seller_id" class="form-control">
													<option selected disabled>--Select Seller--</option>
													<?php
													foreach($seller_details as $seller_details){?>
													<option value="<?php echo $seller_details->id; ?>"><?php echo $seller_details->name; ?></option>
													<?php }?>
												</select>
											</div>
											<!--<div class="form-group">
												<label class="form-label">Billing Amount*</label>
												<input required="" type="text" value="1" name="billing_amount" class="form-control" placeholder="₹0">
											</div>
											<div class="form-group">
												<label class="form-label">Status*</label>
												<select id="status" name="status" class="form-control">
													<option selected value="1">Packed</option>
													<option value="0">Inactive</option>
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
													
												</ul>
											</div>
											<div class="form-group">
												<label class="form-label">Short Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea  name="description"></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Long Description*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <textarea  name="long_description"></textarea>
													</div>
												</div>
											</div>-->
											<button class="save-btn hover-btn" type="submit">Transfer Now</button>
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