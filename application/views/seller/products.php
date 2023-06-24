
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Products</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('seller/add_product');?>" class="add-btn hover-btn">Add New</a>
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
										<h4>All Areas</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th>Select</th>
														<th>Sr.no.</th>
														<th style="width:100px">Image</th>
														<th>Download Image</th>
														<th>Name</th>
														<th>Category</th>
														<th>Created</th>
														<th>Status</th>
														<th style="width:200px">Request Stock</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($product as $products){
														$count++; ?>
														<td><input type="checkbox" class="check-item" name="ids[]" value="10"></td>
														<td><?php echo $count; ?></td>
														<td>
															<div class="cate-img-5">
																<img src="<?php if($products->product_img==''){
											echo base_url('assets/images/product.jpg');
										}
										else{
											echo base_url('assets/images/product/'.$products->product_img);
										}
										?>" alt="">
															</div>
														<td><?php if($products->product_img!==''){?>
														    <a download href="<?php echo base_url('assets/images/product/'.$products->product_img); ?>" title="ImageName">
                                                                Download
                                                            </a>
                                                        <?php }?>
                                                        </td>
														</td>
														<td><?php echo $products->name; ?></td>
														<td><?php echo $products->category; ?></td>
														<td><?php echo $products->date; ?></td>
														<td><span class="badge-item badge-status"><?php if($products->status=='1'){
														echo"Active";
													}else{
														echo"Inactive";
													} ?></span></td>
														<td class="action-btns">
														    <?php if($products->product_id==''){?>
														    <form action="<?php echo base_url('seller/request_stock/');?>" method="post">
														        <input type="hidden" value="<?php echo $products->id;?>" name="product_id"/>
														        <input type="hidden" value="<?php echo $products->name;?>" name="product_name"/>
														        <input type="hidden" value="<?php echo $products->packing_size;?>" name="packing_size"/>
														        <input type="hidden" value="<?php echo $products->packing_type;?>" name="packing_type"/>
														        <input type="hidden" value="<?php echo $products->price;?>" name="price"/>
														        <button name="request_stock_btn" class="btn btn-success btn-sm text-white edit-btn" title="Edit"><i class="fas fa-paper-plane"></i> Request Stock</button>
														    </form>
														   <?php  }
														    else{ 
														        echo "<span class='text-danger'>Requested</span>";
														     } ?>
															<!--<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('seller/product_details/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> details</a>
															<a type="button" class="btn btn-success btn-sm text-white" href="<?php echo base_url('seller/edit_product/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i> edit</a>
															<a onclick="DeleteConfirm('<?php echo $products->id; ?>')" href="javascript:;" class="delete-btn" title="Delete"><i class="fas fa-trash-alt"></i></a>-->
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
  var redirect_url="<?php echo base_url('seller/products/');?>";
  var url="<?php echo base_url('seller/deleteItem/').strtolower(str_replace(' ', '-',$products->id)).'/products/';?>";
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