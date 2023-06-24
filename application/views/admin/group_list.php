
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Groups</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Groups</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('admin/createGroup');?>" class="add-btn hover-btn">Add New</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Groups</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr align="center">
														<th>Sr. No.</th>
														<th>Group Name</th>
														<th>Sellers ID</th>
														<th>Created Date</th>
														<!--<th>Action</th>-->
													</tr>
												</thead>
												<tbody>
													<tr align="center">
													<?php $count=0;
													foreach($group_list as $group_list){
														$count++; ?>
														<td><?php echo $count; ?></td>
														
														<td><?php echo $group_list->group_name; ?></td>
														<td><?php echo $group_list->seller_id; ?></td>
														<td><?php echo $group_list->date_time; ?></td>
														<!--<td class="action-btns">
															<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('admin/product_details/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> view</a>
															<a type="button" class="btn btn-success btn-sm text-white" href="<?php echo base_url('admin/edit_product/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i> edit</a>
															<a type="button" class="btn btn-danger btn-sm text-white" onclick="return confirm('Are you sure want to delete this?')" href="<?php echo base_url('admin/deleteItem/'.$products->id).'/products/'.'products/';?>" class="delete-btn" title="Delete"><i class="fas fa-trash-alt"></i> delete</a>
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