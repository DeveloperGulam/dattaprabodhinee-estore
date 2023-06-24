
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Newsletter</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard/');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Newsletter</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mb-30">
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
									<div class="card-title-2">
										<h4>All Newsletter Customers</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th style="width:60px">Select</th>
														<th style="width:60px">Sr.no.</th>
														<th>Email</th>
														<th>Date</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$count=0;
													foreach($customer as $customer){ 
													$count++;?>
													<tr>
														<td><input type="checkbox" class="check-item" name="ids[]" value="10"></td>
														<td><?php echo $count; ?></td>
														<td><?php echo $customer->email; ?></td>
														<td><?php echo $customer->date; ?></td>
														<td class="action-btns">
															<a onclick="return confirm('Are you sure want to delete this?')" href="<?php echo base_url('admin/newsletter/');?>";
  var url="<?php echo base_url('admin/deleteItem/'.$customer->id).'/newsletter/'.'newsletter/';?>" class="delete-btn" title="Edit"><i class="fas fa-trash-alt"></i> Delete</a>
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
  var redirect_url="<?php echo base_url('admin/newsletter/');?>";
  var url="<?php echo base_url('admin/deleteItem/').strtolower(str_replace(' ', '-',$customer->id)).'/newsletter/';?>";
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