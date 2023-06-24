
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title"><?= $title ?></h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-12">
								<a href="<?php echo base_url('admin/transfer_stock');?>" class="add-btn hover-btn">Add New</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4><?= $title ?></h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th class="text-center">Sr. No.</th>
														<th>User Name</th>
														<th>Product Name</th>
														<th>Rating</th>
														<th>Title</th>
														<th>Comment</th>
														<th> Date</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<?php $count=0;
													foreach($users_review as $data){
														$count++; ?>
														<td class="text-center"><?= $count; ?></td>
														<td><?= $data->user_name; ?></td>
														<td><?= $data->product_name; ?></td>
														<td class="text-center">
														    <div class="review-block-rate">
                                								<?php
                                								for ($i = 1; $i <= 5; $i++) {
                                									$ratingClass = "text-secondary";
                                									if($i <= $data->rating) {
                                										$ratingClass = "text-warning";
                                									}
                                								?>
                                								<span class="fa fa-star <?= $ratingClass; ?>"></span>
                                								<?php } ?>
                                							</div>
														</td>
														<td class="text-center"><?= $data->title; ?></td>
														<td class="text-center"><?= $data->comment; ?></td>
														<td><?= substr($data->created,0,10); ?></td>
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