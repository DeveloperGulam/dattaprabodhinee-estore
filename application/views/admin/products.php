
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Products</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-10">
								<a href="<?php echo base_url('admin/add_product');?>" class="add-btn hover-btn">Add New</a>
							</div>
							<div class="col-lg-2 well" id="selectAll" style="display:none;">
                    			<span class="rows_selected" id="select_count">0 Selected</span>
                    			<a type="button" id="delete_records" href="javascript::" class="add-btn hover-btn pull-right">Delete</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>All Areas</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th><input type="checkbox" id="select_all"></th>
														<th>Sr. No.</th>
														<th style="width:100px">Image</th>
														<th>Download Image</th>
														<th>Name</th>
														<th>Category ID</th>
														<th>Selling Price</th>
														<th>Listed Date</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												    <?php $count=0;
													foreach($product as $products){
														$count++; ?>
													<tr id="row<?php echo $products->id;?>">
														<td><input type="checkbox" class="check-item" name="ids[]" value="<?php echo $products->id;?>" data-product-id="<?php echo $products->id;?>"></td>
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
														</td>
														<td><?php if($products->product_img!==''){?>
														    <a download href="<?php echo base_url('assets/images/product/'.$products->product_img); ?>" title="ImageName">
                                                                Download
                                                            </a>
                                                        <?php }?>
                                                        </td>
														<td><?php echo $products->name; ?></td>
														<td><?php echo $products->category; ?></td>
														<td class="text-center">₹<?php echo $products->price; ?></td>
														<td><?php echo $products->date; ?></td>
														<td><span class="badge-item badge-status"><?php if($products->status=='1'){
														echo"Active";
													}else{
														echo"Inactive";
													} ?></span></td>
														<td class="action-btns">
															<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('admin/product_details/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> view</a>
															<a type="button" class="btn btn-success btn-sm text-white" href="<?php echo base_url('admin/edit_product/').strtolower(str_replace(' ', '-',$products->name)).'/'.strtolower(str_replace(' ', '-',$products->price)).'/'.strtolower(str_replace(' ', '-',$products->id));?>" class="edit-btn" title="Edit"><i class="fas fa-edit"></i> edit</a>
															<a type="button" class="btn btn-danger btn-sm text-white deleteItems" id="<?php echo $products->id;?>" class="delete-btn" title="Delete"><i class="fas fa-trash-alt"></i> delete</a>
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
$(document).ready(function(){
    $(".deleteItems").click(function(){
        var id=$(this).attr("id");
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
               url:"<?php echo base_url('admin/deleteItem/');?>"+id+"/products/",
               method: 'POST',
               data: { id: id },
               success:function(response){
                 if (response=='success') {
                    $("#row"+id).remove();
                    swal({
                     title: "Success!",
                     text: "You have deleted successfully",
                     icon: "success",
                     button: false,
                     timer:2000,
                   }); 
                   //setTimeout(function(){ window.location=redirect_url; },2000);
                 }
               }
             })
           }
         });
    });
    $(document).on('click', '#select_all', function() {          	
		$(".check-item").prop("checked", this.checked);
		if($("input.check-item:checked").length == 0)
		{
		    $("#selectAll").hide();
		}
		else
		{
		    $("#selectAll").show();
		    $("#select_count").html($("input.check-item:checked").length+" Selected");
		}
	});
    $(document).on('click', '.check-item', function() {
		if ($('.check-item:checked').length == $('.check-item').length) {
			$('#select_all').prop('checked', true);
		} else {
			$('#select_all').prop('checked', false);
		}
		if($("input.check-item:checked").length == 0)
		{
		    $("#selectAll").hide();
		}
		else
		{
		    $("#selectAll").show();
		    $("#select_count").html($("input.check-item:checked").length+" Selected");
		}
	});
	$('#delete_records').on('click', function(e) { 
	var product = [];  
	$(".check-item:checked").each(function() {  
		product.push($(this).data('product-id'));
	});	
	if(product.length <=0)  {  
		alert("Please select records.");  
	}  
	else { 	
		WRN_PROFILE_DELETE = "Are you sure you want to delete "+(product.length>1?"these":"this")+" row?";  
		var checked = confirm(WRN_PROFILE_DELETE);  
		if(checked == true) {			
			var selected_values = product.join(","); 
			$.ajax({ 
				type: "POST",  
				url: "<?php echo base_url('admin/deleteItems/');?>",  
				cache:false,  
				data: 'product_id='+selected_values,  
				success: function(response) {	
					// remove deleted product rows
					var product_ids = selected_values.split(",");
					for (var i=0; i < product_ids.length; i++ ) {						
						$("#row"+product_ids[i]).remove();
					}
				}   
			});				
		}  
	}  
});
});
</script>