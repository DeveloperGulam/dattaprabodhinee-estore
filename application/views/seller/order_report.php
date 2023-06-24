
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Product Report</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/orders/');?>">Orders</a></li>
                            <li class="breadcrumb-item active">Order Report</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Orders Reports</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Report Number</th>
														<th>Report By</th>
														<th>Email Address</th>
														<th>Mobile Number</th>
														<th>User's Issue</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($report_info as $order_details){
														$count++; ?>
														<td><?php echo $count; ?></td>
														<td>#<?php echo $order_details->report_no; ?></td>
														<td>
															<?php echo $order_details->user_name; ?>
														</td>
														<td><?php echo $order_details->user_email; ?>
														</td>
														<td><?php echo $order_details->user_number; ?></td>
														<td><?php echo $order_details->issue; ?>
														</td>
														<!--<td class="action-btns">
															<a href="<?php echo base_url('admin/order_details/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i></a>
															<a href="<?php echo base_url('admin/edit_order/').strtolower(str_replace(' ', '-',$order_details->order_no)).'/'.strtolower(str_replace(' ', '-',$order_details->id));?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
														</td>-->
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