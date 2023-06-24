
	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<!--<li class="breadcrumb-item"><a href=""><?php //echo $product_details->category; ?></a></li>-->
								<li class="breadcrumb-item active" aria-current="page"><?php echo $product_details->name; ?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
			
				<div class="row">
					<div class="col-lg-12">
						<div class="product-dt-view">
						
							<div class="row">
								<div class="col-lg-4 col-md-4">
									<div id="sync1" class="owl-theme">
										<div class="item">
											<img  class="thumb-preview" width="80%" src="<?php if($product_details->product_img==''){
											echo base_url('assets/images/product.jpg');
											}
											else{
												echo base_url('assets/images/product/'.$product_details->product_img);
											}
											?>" alt="">
										</div>
										<!--<div class="item">
											<img src="images/product/big-2.jpg" alt="">
										</div>
										<div class="item">
											<img src="images/product/big-3.jpg" alt="">
										</div>
										<div class="item">
											<img src="images/product/big-4.jpg" alt="">
										</div>-->
									</div>
									<!--<div id="sync2" class="owl-carousel owl-theme">
										<div class="item">
											<img src="images/product/big-1.jpg" alt="">
										</div>
										<div class="item">
											<img src="images/product/big-2.jpg" alt="">
										</div>
										<div class="item">
											<img src="<?php echo base_url('assets/images/product/big-3.jpg'); ?>" alt=""/>
										</div>
										<div class="item">
											<img src="<?php echo base_url('assets/images/product/big-4.jpg'); ?>" alt="">
										</div>
									</div>-->
								</div>
								<div class="col-lg-8 col-md-8">
									<div class="product-dt-right">
										<h2><?php echo $product_details->name; ?></h2>
										<div class="no-stock">
											<p class="pd-no">Product No.<span><?php echo $product_details->product_no; ?></span></p>
											<p class="stock-qty"><?php if($product_details->stock>'0'){
												echo"Available<span>(<span class='text-danger font-weight-bold'>".$product_details->stock."</span> In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
										</div>
										<!--<div class="no-stock">
											<p class="pd-no text-danger">Total Left: <span class="text-danger"><?php //echo $product_details->orders; ?></span></p>
										</div>-->
										<!--<div class="product-radio">
											<ul class="product-now">
												<li>
													<input type="radio" id="p1" name="product1">
													<label for="p1">500g</label>
												</li>
												<li>
													<input type="radio" id="p2" name="product1">
													<label for="p2">1kg</label>
												</li>
												<li>
													<input type="radio" id="p3" name="product1">
													<label for="p3">2kg</label>
												</li>
												<li>
													<input type="radio" id="p4" name="product1">
													<label for="p4">3kg</label>
												</li>
											</ul>
										</div>-->
										<p class="pp-descp"><?php echo $product_details->description; ?></p>
										<div class="product-group-dt">
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$product_details->id); ?>" method="post">
											<ul>
												<li><div class="main-price color-discount">Discount Price<span>₹<?php echo $product_details->price; ?></span></div></li>
												<li><div class="main-price mrp-price">MRP Price<span>₹<?php echo $product_details->orignal_price; ?></span></div></li>
											</ul>
											<ul class="gty-wish-share">
												<li>
													<div class="qty-product">
														<div class="quantity buttons_added">
															<input type="button" value="-" class="minus minus-btn">
															<input type="number" step="1" name="qty" value="1" class="input-text qty text">
															<input type="button" value="+" class="plus plus-btn">
														</div>
													</div>
												</li>
												<!--<li><span class="like-icon save-icon" title="wishlist"></span></li>-->
												<?php if($product_details->youtube!==''){?>
												<li><a href="<?php echo $product_details->youtube; ?>"><span style="font-size:35px;" class="fab fa-youtube text-danger" title="Watch YouTube Video"></span></a></li>
												<?php }?>
											</ul>
											<ul class="ordr-crt-share">
												<?php if($this->session->flashdata('cmsg')){ ?>
												<p class="text-success">
												  <?php echo $this->session->flashdata('cmsg'); ?>
												</p>
												<?php } ?>
												<?php if($this->session->flashdata('cerr')){ ?>
												<p class="text-danger">
												  <?php echo $this->session->flashdata('cerr'); ?>
												</p>
												<?php } ?>
												<li><button class="add-cart-btn hover-btn text-white"><i class="uil uil-shopping-cart-alt"></i>Add to Cart</button></li>
												<!--<li><input type="button" class="order-btn hover-btn" value="Order Now"></li>-->
												<?php if($product_details->subcription!==''){?>
												
												<li><a type="button" href="<?php echo $product_details->subcription;?>" style="padding-top:-10px;" class="order-btn hover-btn pt-2"> Visit Link</a></li>
												<?php }?>
											</ul>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>More Like This</h4>
							</div>
							<div class="pdpt-body scrollstyle_4">
								<?php foreach($similar_products as $similar_products){ ?>
								
									<?php
									$value=($similar_products->price*100)/$similar_products->orignal_price;
									$off=100-$value;
									?>
								<div class="cart-item border_radius">
									<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$similar_products->id)).'/'.strtolower(str_replace(' ', '-',$similar_products->name));?>" class="cart-product-img">
										<img src="<?php if($similar_products->product_img!=='')
										{
										    echo base_url('assets/images/product/'.$similar_products->product_img); 
										}
										else
										{
										    echo base_url('assets/images/product.jpg');
										} ?>" alt="">
										<div class="offer-badge"><?php echo substr($off, 0,2); ?>% OFF</div>
									</a>
									<div class="cart-text">
										<h4><?php echo $similar_products->name; ?></h4>
										<div class="cart-item-price">₹<?php echo $similar_products->price; ?> <span>₹<?php echo $similar_products->orignal_price; ?></span></div>
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$similar_products->id); ?>" method="post">
										<div class="qty-cart">
											<div class="quantity buttons_added">
												<input type="button" value="-" class="minus minus-btn">
												<input type="number" step="1" name="qty" value="1" class="input-text qty text">
												<input type="button" value="+" class="plus plus-btn">
											</div>
											<button style="border:none;background:none;" class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></button>
										</div>
										</form>
									</div>
								</div>
								<?php } ?>	
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-12">
						<div class="pdpt-bg">
							<div class="pdpt-title">
								<h4>Product Details</h4>
							</div>
							<div class="pdpt-body scrollstyle_4">
								<div class="pdct-dts-1">
									<div class="pdct-dt-step">
										<h4>Description</h4>
										<p><?php echo $product_details->long_description; ?></p>
									</div>
								</div>
								
								<div class="pdct-dts-1" id="ratingDetailsDiv">
									<div class="pdct-dt-step">
										<h4>Rating and Reviews</h4>
										<h2 class="bold padding-bottom-7">4.9 <small>/ 5</small></h2>
										<?php
                        				// $averageRating = round($average, 0);
                        				for ($i = 1; $i <= 5; $i++) {
                        				// 	$ratingClass = "btn-default btn-grey";
                        				// 	if($i <= $averageRating) {
                        				// 		$ratingClass = "btn-warning";
                        				// 	}
                        				$ratingClass = "btn-warning";
                        				?>
										<button type="button" class="btn btn-sm text-white <?php echo $ratingClass; ?>" aria-label="Left Align">
                        				  <span class="fa fa-star" aria-hidden="true"></span>
                        				</button>
                        				<?php } ?>
                        				<?php if($this->session->userdata('userlogin')){ ?>
                        				<button type="button" id="rateProductBtn" class="add-cart-btn hover-btn float-right">Rate this product</button>
                        				<?php } else{
                        				    $redirect_url = base_url('login');
                        				?>
                        				<button type="button" class="add-cart-btn hover-btn float-right" onclick="location.href='<?= $redirect_url ?>'">Rate this product</button>
                        				<?php } ?>
									</div>
								</div>
								
								<div class="pdct-dts-1" id="ratingDiv">
									<!--<div class="pdct-dt-step">-->
									<!--	<h4>Description</h4>-->
									<!--	<p><?php echo $product_details->long_description; ?></p>-->
									<!--</div>-->
									<div id="ratingSection" style="display:none;">
		<div class="row">
			<div class="col-sm-12">
				<form id="ratingForm" method="POST">					
					<div class="form-group">
						<h4>Rate this product</h4>
						<button type="button" class="btn btn-warning btn-sm text-white rateButton" aria-label="Left Align">
						  <span class="fa fa-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-secondary btn-sm text-white rateButton" aria-label="Left Align">
						  <span class="fa fa-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-secondary btn-sm text-white rateButton" aria-label="Left Align">
						  <span class="fa fa-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-secondary btn-sm text-white rateButton" aria-label="Left Align">
						  <span class="fa fa-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-secondary btn-sm text-white rateButton" aria-label="Left Align">
						  <span class="fa fa-star" aria-hidden="true"></span>
						</button>
						<input type="hidden" id="rating" name="rating" value="1">
						<input type="hidden" id="itemId" name="product_id" value="<?= $product_details->id ?>">
						<input type="hidden" name="user_id" value="<?= $this->session->userdata('userlogin'); ?>">
					</div>		
					<div class="form-group">
						<label for="usr">Title*</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="comment">Comment*</label>
						<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="add-cart-btn hover-btn" id="saveReview">Save Review</button> <button type="button" class="add-cart-btn btn-default btn-secondary " id="cancelReview">Cancel</button> <button type="button" style="display:none" class="add-cart-btn hover-btn" id="loadingReviewBtn" disabled>Loding..</button>
					</div>			
				</form>
			</div>
		</div>		
	</div>
								</div>
								<!--//Comments-->
								<div class="pdct-dts-1 bg-light" id="ratingDetailsDiv" style="display:<?= (count($product_ratings) > 0)?'': 'none' ?>" >
									<div class="pdct-dt-step">
		<div class="row">
			<div class="col-sm-12">
				<hr/>
				<div class="review-block">		
				<?php
				// $itemRating = $rating->getItemRating($_GET['item_id']);
				foreach($product_ratings as $rating){				
					$date=date_create($rating->created);
					$reviewDate = date_format($date,"M d, Y");						
					$profilePic = "profile.png";	
				// 	if($rating['avatar']) {
				// 		$profilePic = $rating['avatar'];	
				// 	}
				$logged_user_id = $this->session->userdata('userlogin');
				if($rating->status != 0 or $rating->user_id == $logged_user_id){
				?>				
					<div class="row">
						<div class="col-sm-3">
							<img src="<?php echo base_url('assets/images/avatar/img-5.jpg');?>" class="img-rounded user-pic" style="height:60px;">
							<div class="review-block-name">By <a href="#"><?php echo $rating->name; ?></a></div>
							<div class="review-block-date"><?php echo $reviewDate; ?></div>
						</div>
						<div class="col-sm-9">
							<div class="review-block-rate">
								<?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-secondary";
									if($i <= $rating->rating) {
										$ratingClass = "btn-warning";
									}
								?>
								<button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align" disabled>
								  <span class="fa fa-star text-white" aria-hidden="true"></span>
								</button>								
								<?php } ?>
							</div>
							<div class="review-block-title"><b><?php echo $rating->title; ?></b> </div>
							<div class="review-block-description"><?php echo $rating->comment; ?></div>
						</div>
					</div>
					<hr/>					
				<?php }} ?>
				</div>
			</div>
		</div>
									</div>
								</div>
								
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Featured Products Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2>Top Featured Products</h2>
							</div>
							<a href="#" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
							<?php foreach($latest_product as $latest_products){ ?>
							<div class="item">
								<div class="product-item">
									<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>" class="product-img">
										<img height="155px" src="<?php if($latest_products->product_img==''){
											echo base_url('assets/images/product.jpg');
										}
										else{
											echo base_url('assets/images/product/'.$latest_products->product_img);
										}
										?>" title="" longdesc="" caption="" alt="">
										<?php
										$value=($latest_products->price*100)/$latest_products->orignal_price;
										$off=100-$value;
										?>
										<div class="product-absolute-options">
											<span class="offer-badge-1"><?php echo substr($off, 0,2); ?>% off</span>
											<!--<span class="like-icon" title="wishlist"></span>-->
										</div>
									</a>
									<div class="product-text-dt">
										<p><?php if($latest_products->stock!=='0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
										<h4><?php echo $latest_products->name; ?></h4>
										<div class="product-price">₹<?php echo $latest_products->price; ?> <span>₹<?php echo $latest_products->orignal_price; ?></span></div>
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$latest_products->id); ?>" method="post">
										<div class="qty-cart">
											<div class="quantity buttons_added">
												<input type="button" value="-" class="minus minus-btn">
												<input type="number" step="1" name="qty" value="1" class="input-text qty text">
												<input type="button" value="+" class="plus plus-btn">
											</div>
											<button style="border:none;background:none;" class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></button>
										</div>
										<div class="product-price mt-3"><button style="padding-top:-5px;" class="add-cart-btn hover-btn form-control"> <i class="uil uil-shopping-cart-alt"></i> Add to cart (for buy)</button></div>
									</form>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Featured Products End -->
	</div>
	<!-- Body End -->
	<script>
	    $(document).ready(function(){
	        $("#rateProductBtn").click(function(){
	            $("#ratingDetailsDiv").hide();
	            $("#ratingSection").show();
	        });
	        $("#cancelReview").click(function(){
	            $("#ratingDetailsDiv").show();
	            $("#ratingSection").hide();
	        });
	        // implement start rating select/deselect
        	$( ".rateButton" ).click(function() {
        		if($(this).hasClass('btn-secondary')) {			
        			$(this).removeClass('btn-secondary btn-default').addClass('btn-warning star-selected');
        			$(this).prevAll('.rateButton').removeClass('btn-secondary btn-default').addClass('btn-warning star-selected');
        			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-secondary btn-default');			
        		} else {						
        			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-secondary btn-default');
        		}
        		$("#rating").val($('.star-selected').length);		
        	});
        	
        	$('#ratingForm').on('submit', function(event){
        		event.preventDefault();
        		var formData = $(this).serialize();
        		var action_url = "<?php echo base_url('Welcome_controller/saveRatings');?>";
        		$("#cancelReview").hide();
        		$("#saveReview").hide();
        		$("#loadingReviewBtn").show();
        		$.ajax({
        			type : 'POST',	
        			url : action_url,					
        			data : formData,
        			success: function(response){
        				if(response == 'success') {
        					toastr.success("Thankyou for rating this product.");
                            setTimeout(function(){
                              location.reload();
                            }, 1000);
        				} else{
        				    toastr.error("Something wrong!!");
        				}
        			}
        		});		
        	});
	    });
	</script>