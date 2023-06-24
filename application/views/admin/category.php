
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Category</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('admin/add_category');?>" class="add-btn hover-btn">Add New</a>
							</div>
							
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Categories</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<!--<th>Select</th>-->
														<th>Sr.no.</th>
														<th style="width:100px">Image</th>
														<th>Name</th>
														<th>Description</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($category as $category){
													$count++; ?>
														<!--<td><input type="checkbox" class="check-item" name="ids[]" value="10"></td>-->
														<td><?php echo $count; ?></td>
														<td>
															<div class="cate-img">
																<img src="<?php if($category->category_img==''){
											echo base_url('assets/images/product.jpg');
										}
										else{
											echo base_url('assets/images/category/'.$category->category_img);
										}
										?>" alt="">
															</div>
														</td>
														<td><?php echo $category->name; ?></td>
														<td><?php echo $category->description; ?></td>
														<td><span class="badge-item badge-status"><?php if($category->status=='1'){
														echo"Active";
													}else{
														echo"Inactive";
													} ?></span></td>
														<td class="action-btns">
															<a href="<?php echo base_url('admin/edit_category/').strtolower(str_replace(' ', '-',$category->id)).'/category/';?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
															<a onclick="return confirm('Are you sure want to delete this ?')" href="<?php echo base_url('admin/deleteItem/').$category->id.'/category/';?>" class="delete-btn" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
  var redirect_url="<?php echo base_url('admin/category/');?>";
  var url="<?php echo base_url('admin/deleteItem/').$category->id.'/category/';?>";
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