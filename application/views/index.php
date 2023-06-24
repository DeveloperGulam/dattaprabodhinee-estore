
	<!-- Body Start -->
	<div class="wrapper">
		<!-- Offers Start -->
		<div class="main-banner-slider">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel offers-banner owl-theme">
						    <?php foreach($banner_category as $banner_category){ ?>
							<div class="item">
								<div class="offer-item">								
									<div class="offer-item-img">
										<div class="gambo-overlay"></div>
										<img src="<?php if($banner_category->category_img!==''){
										            echo base_url('assets/images/category/'.$banner_category->category_img);
										        }
										        else{
										            echo base_url('assets/images/product.jpg');
										        }?>" height="230px" alt="">
									</div>
									<div class="offer-text-dt">
										<div class="offer-top-text-banner">
											<p>Category</p>
											<div class="top-text-1"><?php echo $banner_category->name; ?></div>
										</div>
										<a href="<?php echo base_url('shop-by-categories/'.$banner_category->id).'/'.strtolower(str_replace(' ', '-',$banner_category->name)).'/';?>" class="Offer-shop-btn hover-btn">Shop Now</a>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php foreach($herb as $herb){ ?>
							<div class="item">
								<div class="offer-item">								
									<div class="offer-item-img">
										<div class="gambo-overlay"></div>
										<img src="<?php if($herb->product_img!==''){
										            echo base_url('assets/images/product/'.$herb->product_img);
										        }
										        else{
										            echo base_url('assets/images/product.jpg');
										        }?>" height="230px" alt="">
									</div>
									<?php
										$value=($herb->price*100)/$herb->orignal_price;
										$off=100-$value;
									?>
									<div class="offer-text-dt">
										<div class="offer-top-text-banner">
											<p><?php echo substr($off, 0,2); ?>% Off</p>
											<div class="top-text-1"><?php echo$herb->name; ?></div>
											<!--<span><?php echo$herb->category; ?></span>-->
										</div>
										<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$herb->id)).'/'.strtolower(str_replace(' ', '-',$herb->name));?>" class="Offer-shop-btn hover-btn">Shop Now</a>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Offers End -->
		<!-- Categories Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>Shop By</span>
								<h2>Categories</h2>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel cate-slider owl-theme">
						<?php foreach($categories as $categories){ ?>
							<div class="item">
								<a href="<?php echo base_url('view-all/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>" class="category-item">
									<div class="cate-img">
										<img src="<?php if($categories->category_img==''){
											echo base_url('assets/images/category/icon-1.svg');
										}
										else{
											echo base_url('assets/images/category/'.$categories->category_img);
										}
										?>" alt="">
									</div>
									<h4><?php echo $categories->name; ?></h4>
								</a>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Categories End -->
		<!-- Featured Products Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2> Astrology Books</h2>
							</div>
							<a href="<?php echo base_url('product/astrology-books/');?>" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
						<?php foreach($astrology_books as $astrology_books){ ?>
							<div class="item">
								<div class="product-item">
									<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$astrology_books->id)).'/'.strtolower(str_replace(' ', '-',$astrology_books->name));?>" class="product-img">
										<img src="<?php if($astrology_books->product_img!==''){
										    echo base_url('assets/images/product/'.$astrology_books->product_img);
										 }
										 else
										 {
										    echo base_url('assets/images/product.jpg');
										 }?>" style="height:155px;" alt="">
										<?php
										$value=($astrology_books->price*100)/$astrology_books->orignal_price;
										$off=100-$value;
										?>
										<div class="product-absolute-options">
											<span class="offer-badge-1"><?php echo substr($off, 0,2); ?>% off</span>
											<!--<span class="like-icon" title="wishlist"></span>-->
										</div>
									</a>
									<div class="product-text-dt">
										<p><?php if($astrology_books->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
										<h4><?php echo $astrology_books->name; ?></h4>
										<div class="product-price">₹<?php echo $astrology_books->price; ?> <span>₹<?php echo $astrology_books->orignal_price; ?></span></div>
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$astrology_books->id).'/home/'; ?>" method="post">
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
		<!-- Best Values Offers Start -->
		<!--<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>Offers</span>
								<h2>Best Values</h2>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<a href="#" class="best-offer-item">
							<img src="assets/images/best-offers/offer-1.jpg" alt="">
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a href="#" class="best-offer-item">
							<img src="assets/images/best-offers/offer-2.jpg" alt="">
						</a>
					</div>
					<div class="col-lg-4 col-md-6">
						<a href="#" class="best-offer-item offr-none">
							<img src="assets/images/best-offers/offer-3.jpg" alt="">
							<div class="cmtk_dt">
								<div class="product_countdown-timer offer-counter-text" data-countdown="2021/01/06"></div>
							</div>
						</a>
					</div>
					<div class="col-md-12">
						<a href="#" class="code-offer-item">
							<img src="assets/images/best-offers/offer-4.jpg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>-->
		<!-- Best Values Offers End -->
<?php if($this->session->flashdata('cart_msg')){ ?>
<script>
swal({
		  text: "<?php echo $this->session->flashdata('cart_msg'); ?>",
		  icon: "success",
		  button: false,
		  timer:2500,
		});
</script>
<?php }?>
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2> Photos & Murtis </h2>
							</div>
							<a href="<?php echo base_url('product/').strtolower(str_replace(' ', '-',"Photos and murtis")).'/';?>" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
						<?php foreach($herbs as $herbs){ ?>
							<div class="item">
								<div class="product-item">
									<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$herbs->id)).'/'.strtolower(str_replace(' ', '-',$herbs->name));?>" class="product-img">
										<img src="<?php if($herbs->product_img!==''){
										    echo base_url('assets/images/product/'.$herbs->product_img);
										}
										else
										{
										    echo base_url('assets/images/product.jpg');
										}?>" alt="" style="height:150px;">
										<?php
										$value=($herbs->price*100)/$herbs->orignal_price;
										$off=100-$value;
										?>
										<div class="product-absolute-options">
											<span class="offer-badge-1"><?php echo substr($off, 0,2); ?>% off</span>
											<!--<span class="like-icon" title="wishlist"></span>-->
										</div>
									</a>
									<div class="product-text-dt">
										<p><?php if($herbs->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
										<h4><?php echo $herbs->name; ?></h4>
										<div class="product-price">₹<?php echo $herbs->price; ?> <span>₹<?php echo $herbs->orignal_price; ?></span></div>
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$herbs->id).'/home/'; ?>" method="post">
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
		<!-- Vegetables and Fruits Products End -->
		<!-- New Products Start -->
		<div class="section145">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>For You</span>
								<h2>Added New Products</h2>
							</div>
							<a href="<?php echo base_url('new-products/');?>" class="see-more-btn">See All</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="owl-carousel featured-slider owl-theme">
						<?php foreach($latest_product as $latest_products){ ?>
							<div class="item">
								<div class="product-item">
									<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>" class="product-img">
										<img style="height:155px;" src="<?php if($latest_products->product_img==''){
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
										<p><?php if($latest_products->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
										<h4><?php echo $latest_products->name; ?></h4>
										<div class="product-price">₹<?php echo $latest_products->price; ?> <span>₹<?php echo $latest_products->orignal_price; ?></span></div>
										<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$latest_products->id).'/home/'; ?>" method="post">
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
		<!-- New Products End -->
	</div>
	<!-- Body End -->
<?php if($this->session->userdata('userlogin')){
if($logged_user->number==''){ ?>
<script>
    swal("Enter Your Mobile Number:", {
  content: "input",
  button: "Confirm",
})
.then((value) => {
  $.ajax({
        type: "POST",
        url: "<?php echo base_url('Welcome_controller/update_number');?>",
        data: {number:value},
        success:function(data)
        {
			swal({
    		  title: "Thanku!",
    		  text: "Thanku for providing your contact number.",
    		  icon: "success",
    		  button: false,
    		  timer:2500,
    		});
        },
        error:function()
        {
            swal({
    		  title: "Sorry!",
    		  text: "Something went to wrong!",
    		  icon: "error",
    		  button: false,
    		  timer:2500,
    		});
        }
    });
});
</script>
<?php } }?>