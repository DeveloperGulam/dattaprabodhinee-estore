
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Sales Transaction</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales Transaction</li>
                        </ol>
                        <div class="row justify-content-between">
							<div class="col-lg-10">
								<a href="<?php echo base_url('admin/audit');?>" class="add-btn hover-btn">New Sale</a>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="card card-static-2 mt-30 mb-30">
									<div class="card-title-2">
										<h4>Transaction History</h4>
									</div>
									<div class="card-body-table">
										<div class="table-responsive">
											<table class="table ucp-table table-hover" id="table_id">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Bill No.</th>
														<th>Customer Name</th>
														<th>Item Name</th>
														<th>Payment Mode</th>
														<th> Date</th>
														<th>Wholesale</th>
														<th>Quantity</th>
														<th>Per Unit Price</th>
														<th>Total Price</th>
														<th>View Details</th>
													</tr>
												</thead>
												<tbody>
												    <?php $count=0;
													foreach($products as $products){
														$count++; ?>
													<tr>
														<td><?php echo $count; ?></td>
														<td>
															<?php echo $products->bill_no; ?>
														</td>
														<td>
														    <?php echo $products->customer_name; ?>
                                                        </td>
														<td><?php echo $products->product; ?></td>
														<td><?php echo $products->payment_mode; ?></td>
														<td><?php echo $products->date; ?></td>
														
														<td><span class="badge-item badge-status"><?php if($products->wholesale=='1'){
														echo"Yes";
													}else{
														echo"No";
													} ?></span></td>
													<td class="text-center"><?php echo $products->qty; ?></td>
													<td class="text-center">₹<?php echo $products->unit_price; ?></td>
													<td class="text-center">₹<?php echo $products->unit_price*$products->qty; ?></td>
														<td class="action-btns">
															<a type="button" class="btn btn-primary btn-sm text-white" href="<?php echo base_url('admin/salesDetails/').$products->id;?>" class="view-shop-btn" title="View"><i class="fas fa-eye"></i> view</a>
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