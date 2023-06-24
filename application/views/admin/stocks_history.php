
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Transfered Stock History</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stock History</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('admin/transfer_stock');?>" class="add-btn hover-btn">Add New</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>Transfered Stock History List</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th class="text-center">Sr. No.</th>
														<th>Product Name</th>
														<th>Size</th>
														<th class="text-center">Price</th>
														<th class="text-center">Quantity</th>
														<th class="text-center">Total Amount</th>
														<th> Date</th>
														<th>Transfer To</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($stocks_history as $products){
														$count++; ?>
														<td class="text-center"><?php echo $count; ?></td>
														<td><?php echo $products->product_name; ?></td>
														<td><?php echo $products->packing_size.$products->packing_type; ?></td>
														<td class="text-center">₹<?php echo $products->price; ?></td>
														<td class="text-center"><?php echo $products->stock_qty; ?></td>
														<?php $total_amount=$products->price*$products->stock_qty; ?>
														<td class="text-center">₹<?php echo $total_amount; ?></td>
														<td><?php echo substr($products->transfer_date_time,0,10); ?></td>
														<td><?php echo $products->name; ?></td>
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