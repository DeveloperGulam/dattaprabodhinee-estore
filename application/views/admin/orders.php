
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Products</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Orders</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th style="width:130px">Select</th>
														<th style="width:130px">Sr. No.</th>
														<th style="width:130px">Order ID</th>
														<th>Item</th>
														<th style="width:200px">Order Date</th>
														<th style="width:300px">Payment</th>
														<th style="width:130px">Status</th>
														<th style="width:130px">Total</th>
														<th style="width:130px">Reports</th>
														<th style="width:100px">Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($order_details as $order_details){
														$count++; ?>
														<td><input type="checkbox" class="check-item" name="ids[]" value="10"></td>
														<td><?php echo $count; ?></td>
														<td>#<?php echo $order_details->order_no; ?></td>
														<td>
															<a href="#" target="_blank"><?php echo $order_details->name; ?></a>
														</td>
														<td>
															<span class="delivery-time"><?php echo substr($order_details->date_time,0,10); ?></span>
															<span class="delivery-time"><?php echo substr($order_details->date_time,11,23); ?></span>
														</td>
														<td>
														    <?php if($order_details->payment_status=='0'){ ?>
															<span class="text-danger">Pending</span>
    														<?php }?>
    														<?php if($order_details->payment_status=='1'){ ?>
    															<span class="text-success">Received</span>
    														<?php }?>
														</td>
														<td><?php if($order_details->status=='0'){ ?>
															<span class="badge-item badge-status">Pending</span>
														<?php }?>
														<?php if($order_details->status=='1'){ ?>
															<span class="badge-item badge-status bg-warning">Placed</span>
														<?php }?>
														<?php if($order_details->status=='2'){ ?>
															<span class="badge-item badge-status bg-primary">Progress</span>
														<?php }?>
														<?php if($order_details->status=='3'){ ?>
															<span class="badge-item badge-status">Canceled</span>
														<?php }?>
														<?php if($order_details->status=='4'){ ?>
															<span class="badge-item badge-status bg-success">Completed</span>
														<?php }?>
														</td>
														<td>₹<?php echo $order_details->total_amount; ?></td>
														<td><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/Report/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>">View</a></td>
														<td class="action-btns">
															<a href="<?php echo base_url('admin/order_details/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i></a>
															<a href="<?php echo base_url('admin/edit_order/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
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
  var redirect_url="<?php echo base_url('admin/products/');?>";
  var url="<?php echo base_url('admin/deleteItem/').strtolower(str_replace(' ', '-',$products->id)).'/products/';?>";
  function DeleteConfirm(id){
    swal({
      title: "Are you sure?",
      text: "You want to delete this ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:url,
          method: 'POST',
          data: { id: id },
          success:function(response){
            if (response=='success') {
              swal({
                title: "Success!",
                text: "You have deleted successfully",
                icon: "success",
                button: false,
              }); 
              setTimeout(function(){ window.location=redirect_url; },2000)
            }
          }
        })
      }
    });
  }
</script>