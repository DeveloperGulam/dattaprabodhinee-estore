
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Customers</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customers</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>All Customers</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th style="width:60px">Select</th>
														<th style="width:60px">Sr.no.</th>
														<th style="width:100px">Image</th>
														<th>Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($customer as $customer){ ?>
													<tr>
														<td><input type="checkbox" class="check-item" name="ids[]" value="10"></td>
														<td>1</td>
														<td>
															<div class="cate-img-6">
																<img src="<?php if($customer->customer_img==''){
											echo base_url('assets/images/avatar/img-1.jpg');
										}
										else{
											echo base_url('assets/images/customers_img/'.$customer->customer_img);
										}
										?>" alt="">
															</div>
														</td>
														<td><?php echo $customer->name; ?></td>
														<td><?php echo $customer->email; ?></td>
														<td><?php echo $customer->number; ?></td>
														<td><?php if($customer->status=='1'){
															echo "<span class='text-success'>Active</span>";
														}
														else{
															echo "<span class='text-danger'>Inactive</span>";
														}?></td>
														<td class="action-btns">
															<a href="<?php echo base_url('admin/customer_details/').strtolower(str_replace(' ', '-',$customer->name)).'/'.strtolower(str_replace(' ', '-',$customer->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i></a>
															<a onclick="DeleteConfirm('<?php echo $customer->id; ?>')" href="javascript:;" class="delete-btn" title="Edit"><i class="fas fa-trash-alt"></i></a>
															<?php if($customer->status=='0'){
															?><a onclick="return confirm('Are you sure?')" href="<?php echo base_url('admin/ActionOnItem/').strtolower(str_replace(' ', '-',$customer->id)).'/users'.'/1'.'/customers/';?>" ><span class="badge-item badge-status" style="background:#4ca9f5;">Active</span></a>
														<?php }
														else{
															?><a onclick="return confirm('Are you sure?')" href="<?php echo base_url('admin/ActionOnItem/').strtolower(str_replace(' ', '-',$customer->id)).'/users'.'/0'.'/customers/';?>" ><span class="badge-item badge-status">Deactive</span></a>
															<?php }?>
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
  var redirect_url="<?php echo base_url('admin/customers/');?>";
  var url="<?php echo base_url('admin/deleteItem/').strtolower(str_replace(' ', '-',$customer->id)).'/users/';?>";
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