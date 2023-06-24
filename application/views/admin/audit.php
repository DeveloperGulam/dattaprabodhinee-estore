
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>
    $(document).ready(function () {
      $('#product_name').selectize({
          sortField: 'text'
      });
  });
</script>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Sales Transaction</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales Transaction</li>
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
										<h4>Transfer New Product</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
										<form action="<?php echo base_url('admin/addAudit');?>" method="post" enctype="multipart/form-data">
										    <div class="row">
											<div class="col-4">
											    <div class="form-group">
											        <label class="form-label">Bill No*</label>
												    <input required type="text" name="bill_no" class="form-control">
											    </div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Payment Mode*</label>
    												<select required="" id="payment_mode" name="payment_mode" class="form-control">
    													<option value="cash">Cash</option>
    													<option value="online">Online</option>
    													<option value="credit">Credit</option>
    												</select>
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group">
											        <label class="form-label">Date*</label>
												    <input required type="date" name="date" class="form-control">
											    </div>
											</div>
											</div>
											<hr/>
											<div class="row">
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Customer Name*</label>
    												<input type="text" required="" id="customer_name" name="customer_name" class="form-control">
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Mobile Number*</label>
    												<input type="text" required="" id="number" name="number" class="form-control">
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group text-center mt-3"><br/>
    												<p class="form-label">Prev. Outstanding: 0</p>
    											</div>
											</div>
											</div>
											<div class="row">
											<div class="col-6">
											    <div class="form-group">
    												<label class="form-label">Address*</label>
    												<input required type="text" name="address" class="form-control">
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Reference Name</label>
    												<input type="text" name="reference_name" class="form-control">
    											</div>
											</div>
											<div class="col-2">
											    <div class="form-group">
											        <label class="form-label"></label><br/>
											        <input class="mt-2" type="checkbox" value="1" name="wholesale"/>
											        <label class="form-label">Wholesale?</label>
    											</div>
											</div>
											</div>
											<hr/>
											<div class="row">
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Item Name*</label>
    												<select required="" id="product_name" name="product_name" class="form-control" placeholder="Pick a product...">
    													<option selected disabled></option>
    													<?php
    													foreach($product as $products){?>
    													<option value="<?php echo $products->name; ?>"><?php echo $products->name; ?></option>
    													<?php }?>
    												</select>
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Per Unit Price*</label>
    												<input type="text" id="price" name="price" class="form-control">
    											</div>
											</div>
											<div class="col-4">
											    <div class="form-group">
    												<label class="form-label">Quantity*</label>
    												<input type="text" name="qty" id="qty" class="form-control" value="1">
    											</div>
											</div>
											</div>
											<!--<div class="form-group">
												<label class="form-label">Billing Amount*</label>
												<input required="" type="text" value="1" name="billing_amount" class="form-control" placeholder="₹0">
											</div>-->
											<div class="row">
											<div class="col-lg-7"></div>
											<div class="col-lg-5">
												<div class="select-status">
													<label for="status">Total Amount*</label>
													<h5 id="total_amount">₹0</h5>
												</div>
											</div>
											</div>
											<button class="save-btn hover-btn pull-right mb-3" id="save_btn" type="submit">Save</button>
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
                        $("#price").keyup(function(){
                            var price = $(this).val();
                            var qty = $("#qty").val();
                            var total_amount = price*qty;
                            $("#total_amount").text(total_amount);
                        });
                        $("#qty").keyup(function(){
                            var qty = $(this).val();
                            var price = $("#price").val();
                            var total_amount = price*qty;
                            $("#total_amount").text(total_amount);
                        });
                    });
                </script>