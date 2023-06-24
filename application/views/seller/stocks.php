
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Stocks</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('seller/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stocks</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('seller/products');?>" class="add-btn hover-btn">Request Stock</a>
							</div>
							<div class="col-lg-12 col-md-12">
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
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>Available Stocks</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover text-center" id="table_id">
												<thead>
													<tr>
														<th>Sr.no.</th>
														<th style="width:100px">Image</th>
														<th>Download Image</th>
														<th>Name</th>
														<th>Category</th>
														<th>Tranfer Date</th>
														<th>Status</th>
														<th>Available in Stock</th>
														<th style="width:200px">Action</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($product as $products){
														$count++; ?>
														<td><?php echo $count; ?></td>
														<td>
															<div class="cate-img-5">
																<img src="<?php if($products->product_img==''){
											echo base_url('assets/images/product/img-1.jpg');
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
														<td><?php echo $products->transfer_date_time; ?></td>
														<td><span class="badge-item badge-status"><?php if($products->status=='1'){
														echo"Active";
													}else{
														echo"Inactive";
													} ?></span></td>
													<td><?php echo $products->stock_qty; ?></td>
														<td class="action-btns">
															<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('seller/stock_details/').$products->sid;?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> details</a>
															<a type="button" class="btn btn-success btn-sm text-white" href="<?php echo base_url('seller/edit_stock/').$products->sid;?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i> edit</a>
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