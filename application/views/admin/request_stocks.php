
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Stock Requests</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stock Requests</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('admin/transfer_stock');?>" class="add-btn hover-btn">Transfer New Stock</a>
							</div>
							<div class="col-lg-12 col-md-12">
							    <?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success mt-3" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger mt-3" role="alert">
							  <?php echo $this->session->flashdata('err'); ?>
							</div>
							<?php } ?>
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Stock Requests</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover text-center" id="table_id">
												<thead>
													<tr>
														<th class="text-center">Sr. No.</th>
														<th>Product Name</th>
														<th>Request By</th>
														<th>Price</th>
														<th>Quantity</th>
														<th>Total Amount</th>
														<th> Date</th>
														<th> Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($request_stocks as $products){
														$count++; ?>
														<td class="text-center"><?php echo $count; ?></td>
														<td><?php echo $products->product_name; ?></td>
														<td><?php echo $products->name; ?></td>
														<td><?php echo $products->price; ?></td>
														<td class="text-center"><?php echo $products->stock_qty; ?></td>
														<td class="text-center">₹<?php echo $products->price*$products->qty; ?></td>
														<td><?php echo substr($products->transfer_date_time,0,10); ?></td>
														<td class="action-btns">
															<a type="button" class="btn btn-success btn-sm text-white" href="<?php echo base_url('admin/stockAction/'.$products->sid).'/transfer/';?>" class="edit-btn" title="Transfer"><i class="fas fa-paper-plane"></i> Transfer</a>
															<a type="button" class="btn btn-danger btn-sm text-white" onclick="return confirm('Are you sure want to reject this?')" href="<?php echo base_url('admin/stockAction/'.$products->sid).'/reject/';?>" class="delete-btn" title="Reject"><i class="fas fa-trash-alt"></i> Reject</a>
														</td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
<script type="text/javascript">
  // var redirect_url="<?php echo base_url('admin/products/');?>";
  // var url="<?php echo base_url('admin/deleteItem/').strtolower(str_replace(' ', '-',$products->id)).'/products/';?>";
  // function DeleteConfirm(id){
    // swal({
      // title: "Are you sure?",
      // text: "You want to delete this ?",
      // icon: "warning",
      // buttons: true,
      // dangerMode: true,
    // })
    // .then((willDelete) => {
      // if (willDelete) {
        // $.ajax({
          // url:url,
          // method: 'POST',
          // data: { id: id },
          // success:function(response){
            // if (response=='success') {
              // swal({
                // title: "Success!",
                // text: "You have deleted successfully",
                // icon: "success",
                // button: false,
              // }); 
              // setTimeout(function(){ window.location=redirect_url; },2000)
            // }
          // }
        // })
      // }
    // });
  // }
</script>