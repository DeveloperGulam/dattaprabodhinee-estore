<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Dattaprabodhinee E-Store">
		<meta name="author" content="Dattaprabodhinee E-Store">		
		<title>Dattaprabodhinee :: E-Store</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/fav.png'); ?>">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/unicons-2.0.1/css/unicons.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/responsive.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/night-mode.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/step-wizard.css');?>" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/OwlCarousel/assets/owl.carousel.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/OwlCarousel/assets/owl.theme.default.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/vendor/semantic/semantic.min.css');?>" rel="stylesheet">
		
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179570495-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-179570495-1');
		</script>
	</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<!-- Share Icons Start-->
	<!--<div class="icon-bar">
	  <a href="#" class="facebook" title="Share"><i class="fab fa-facebook-f"></i></a> 
	  <a href="#" class="twitter" title="Share"><i class="fab fa-twitter"></i></a> 
	  <a href="#" class="google" title="Share"><i class="fab fa-google"></i></a> 
	  <a href="#" class="linkedin" title="Share"><i class="fab fa-linkedin-in"></i></a>
	  <a href="#" class="whatsapp" title="Share"><i class="fab fa-whatsapp"></i></a> 
	</div>-->
	<!-- Share Icons End-->
	<!-- Category Model Start-->
	<div id="category_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog category-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content" id="show_default"> 
					<div class="cate-header">
						<h4>Select Category</h4>
					</div>
                    <ul class="category-by-cat">
					<?php foreach($nine_categories as $nine_categories){ ?>
						<li>
							<a href="<?php echo base_url('view-all/'.$nine_categories->id).'/'.strtolower(str_replace(' ', '-',$nine_categories->name)).'/';?>" class="single-cat-item">
								<div class="icon">
									<img src="<?php echo base_url('assets/images/category/'.$nine_categories->category_img);?>" alt="">
								</div>
								<div class="text"> <?php echo $nine_categories->name; ?> </div>
							</a>
						</li>
					<?php } ?>
                    </ul>
					<a href="javascript:;" id="more_btn" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a>
                </div>
                <div class="category-model-content modal-content" id="show_more" style="display:none;"> 
					<div class="cate-header">
						<h4>Select Category</h4>
					</div>
                    <ul class="category-by-cat">
					<?php foreach($categories as $categories){ ?>
						<li>
							<a href="<?php echo base_url('view-all/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>" class="single-cat-item">
								<div class="icon">
									<img src="<?php echo base_url('assets/images/category/'.$categories->category_img);?>" alt="">
								</div>
								<div class="text"> <?php echo $categories->name; ?> </div>
							</a>
						</li>
					<?php } ?>
                    </ul>
					<a href="javascript:;" id="hide_more_btn" class="morecate-btn"><i class="uil uil-apps"></i>Hide Categories</a>
                </div>
            </div>
        </div>
    </div>
	<!-- Category Model End-->
	<!-- Search Model Start-->
	<div id="search_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog search-ground-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="search-header">
						<form action="#">
							<input type="text" placeholder="Search for products...!" >
							<button type="submit"><i class="uil uil-search"></i></button>
						</form>
					</div>
					<div class="search-by-cat">
                        <!--<a href="#" class="single-cat">
                            <div class="icon">
								<img src="images/category/icon-1.svg" alt="">
                            </div>
                            <div class="text">
                                Fruits and Vegetables
                            </div>
                        </a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-2.svg" alt="">
							</div>
							<div class="text"> Grocery & Staples </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-3.svg" alt="">
							</div>
							<div class="text"> Dairy & Eggs </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-4.svg" alt="">
							</div>
							<div class="text"> Beverages </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-5.svg" alt="">
							</div>
							<div class="text"> Snacks </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-6.svg" alt="">
							</div>
							<div class="text"> Home Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-7.svg" alt="">
							</div>
							<div class="text"> Noodles & Sauces </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-8.svg" alt="">
							</div>
							<div class="text"> Personal Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="images/category/icon-9.svg" alt="">
							</div>
							<div class="text"> Pet Care </div>
						</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Search Model End-->
	<!-- Cart Sidebar Offset Start-->
	<div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100">
		<div class="bs-canvas-header side-cart-header p-3 ">
			<div class="d-inline-block  main-cart-title">My Cart <span>(<?php echo $this->cart->total_items(); ?> Items)</span></div>
			<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
		</div> 
		<div class="bs-canvas-body">
			<!--<div class="cart-top-total">
				<div class="cart-total-dil">
					<h4>Gambo Super Market</h4>
					<span>$34</span>
				</div>
				<div class="cart-total-dil pt-2">
					<h4>Delivery Charges</h4>
					<span>$1</span>
				</div>
			</div>-->
			<div class="side-cart-items" style="margin-bottom:100px;">
			<?php $weight=0;
			if($this->cart->total_items()!==0){
			foreach($cart_products as $products){
			    if($products['packing_type']=='gm')
                {
                    $packing_weight=$products['packing_size']*$products['qty']*1000;
                }
                if($products['packing_type']=='kg')
                {
                    $packing_weight=$products['packing_size']*$products['qty']*1000000;
                }
                if($products['packing_type']=='l')
                {
                    $packing_weight=$products['packing_size']*$products['qty']*1000;
                }
                $weight+=$packing_weight;
			?>
				<div class="cart-item">
					<div class="cart-product-img">
						<img src="<?php if(!empty($products['image'])){
											echo base_url('assets/images/product/'.$products['image']);
									}
									if(!empty($products['sub_category_image'])){
												echo base_url('assets/images/sub_category/'.$products['sub_category_image']);
									}
									?>" alt="">
						<div class="offer-badge">6% OFF</div>
					</div>
					<div class="cart-text">
						<h4><?php echo $products['name']; ?></h4>
						<div class="cart-radio"> Product No: <?php echo $products['product_no']; ?>
						</div>
						<div class="qty-group">
							<form action="" method="post">
							<div class="quantity buttons_added">
								<input type="hidden" value="<?php echo $products['rowid']; ?>" name="rowid">
								<button class="minus minus-btn" onclick="decCartItem('<?php echo $products['rowid']; ?>','qty')">-</button>
								<input type="number" step="1" id="qty" name="qty" value="<?php echo $products['qty']; ?>" onclick="updateCartItem('<?php echo $products['rowid']; ?>')" class="input-text qty text">
								<button class="plus plus-btn" onclick="updateCartItem('<?php echo $products['rowid']; ?>','qty')">+</button>
							</div>
							</form>
							<div class="cart-item-price">₹<?php echo $products['price']; ?> <span>₹<?php echo $products['orignal_price']; ?></span></div>
						</div>
						
						<a href="<?php echo base_url('Welcome_controller/removeItem/'.$products['rowid']); ?>" type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></a>
					</div>
				</div>
			<?php }} ?>
			</div>
		</div>
		<?php
		if($weight<=1000000)
        {
            $delivery_charges=150;
        }
        if($weight>1000000 and $weight<=2000000)
        {
            $delivery_charges=200;
        }
        if($weight>2000000 and $weight<=3000000)
        {
            $delivery_charges=300;
        }
        if($weight>3000000 and $weight<=4000000)
        {
            $delivery_charges=400;
        }
        if($weight>4000000 and $weight<=5000000)
        {
            $delivery_charges=500;
        }
        if($weight>5000000 and $weight<=6000000)
        {
            $delivery_charges=600;
        }
        if($weight>6000000 and $weight<=7000000)
        {
            $delivery_charges=700;
        }
        if($weight>7000000 and $weight<=8000000)
        {
            $delivery_charges=800;
        }
        if($weight>8000000 and $weight<=9000000)
        {
            $delivery_charges=900;
        }
        if($weight>9000000)
        {
            $delivery_charges=1000;
        }
		if($this->cart->total_items()!==0){
			$discount_price=$products['price']*$products['qty'];
			$orignal_price=$products['orignal_price']*$products['qty'];
			$total_saving=$orignal_price-$discount_price;
			$gst=($this->cart->total()*8)/100;
			$total_price=$this->cart->total()+$delivery_charges+20;
		?>
		<div class="bs-canvas-footer" style="margin-top:500px;">
		    <div class="cart-total-dil saving-total ">
				<h4>Shiping Charges</h4>
				<span>₹20</span>
			</div>
			<div class="cart-total-dil saving-total ">
				<h4>Delivery Charges</h4>
				<span>₹<?php echo $delivery_charges; ?></span>
			</div>
			<div class="cart-total-dil saving-total ">
				<h4>Sub-Total</h4>
				<span>₹<?php echo $this->cart->format_number($this->cart->total()); ?></span>
			</div>
			<!--<div class="cart-total-dil saving-total ">
				<span style="font-size:12px;margin-top:-15px;">GST:<?php echo $gst; ?></span>
			</div>-->
			<div class="main-total-cart">
				<h2>Grand Total</h2>
				<span>₹<?php echo $total_price; ?></span>
			</div>
			<!--<form action="<?php echo base_url('Welcome_controller/applyPromocode/').'home/'; ?>" class="" method="post" style="display:none;" id="promocode_form">
			<div class="checkout-cart">
				
					<input type="text" name="promocode" id="promocode_name" class="form-control pr-5 mr-2 text-center" placeholder="Enter Your Promocode">
				
					<button class="chck-btn hover-btn" role="button" data-toggle="collapse" href="#otp-verifaction" style="border:none;">Apply</button>
				
				</div>
			</form>-->
			<?php if($this->session->flashdata('error')){ ?>
				<div class="text-danger pt-3 ml-4">
					<?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<div class="checkout-cart" id="id_default">
				<?php if($this->session->userdata('promocode_success')){ ?>
					<div class="promo-code">
						<div class="text-success">
							<?php echo $this->session->userdata('promocode_success'); ?><span class="text-danger"><a href="<?php echo base_url('Welcome_controller/removePromocode/').'home/'; ?>"> Remove</a></span>
						</div>
					</div>
					<?php }
					else{ ?>
						<!--<a href="javascript:;" id="promocode" class="promo-code">
								Have a promocode?</a>-->
					<?php } ?>
				<p id="sub_total" style="display:none;"><?php echo $this->cart->total(); ?></p>
				<a href="javascript:;" id="checkout_btn" class="cart-checkout-btn hover-btn">Proceed to Checkout</a>
			</div>
		</div>
		<?php }?>
	</div>
				<script>
				$(document).ready(function(){
					$('#promocode').click(function(){
						$('#promocode_form').show();
						$('#promocode').hide();
					});
				})
				</script>
	<!-- Cart Sidebar Offsetl End-->
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="top-header-group">
			<div class="top-header">
				<div class="res_main_logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/dattaprabodhinee-estore.png');?>" alt=""></a>
				</div>
				<div class="main_logo" id="logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/logo2.png');?>" alt=""></a>
					<a href="<?php echo base_url();?>"><img class="logo-inverse" src="<?php echo base_url('assets/images/dark-logo.png');?>" alt=""></a>
				</div>
				<div class="select_location">
					<!--<div class="ui inline dropdown loc-title">
						<div class="text">
						  <i class="uil uil-location-point"></i>
						  Gurugram
						</div>
						<i class="uil uil-angle-down icon__14"></i>
						<div class="menu dropdown_loc">
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Gurugram
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								New Delhi
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Bangaluru
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Mumbai
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Hyderabad
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Kolkata
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Ludhiana
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Chandigrah
							</div>
						</div>
					</div>-->
				</div>
				
				<div class="search120">
				    <form action="<?php echo base_url('search-product/'); ?>" method="post">
					<div class="ui search">
					  <div class="ui left icon input swdh10">
						<input class="prompt srch10" type="text" placeholder="Search for products.." id="productSearch" name="input_value" autocomplete="off">
						<i class='uil uil-search-alt icon icon1'></i>
					  </div>
					</div>
					
				</div>
				<div class="search120">
				    <button class="add-cart-btn hover-btn">Search</button>
				</div>
				</form>
				<div class="header_right">
					<ul>
						<li>
							<a href="#" class="offer-link"><i class="uil uil-phone-alt"></i>+91 9324358115</a>
						</li>
						<!--<li>
							<a href="offers.php" class="offer-link"><i class="uil uil-gift"></i>Offers</a>
						</li>-->
						<li>
							<a href="<?php echo base_url('assets/pdf/estore-guide.pdf');?>" class="offer-link"><i class="uil uil-question-circle"></i>Help</a>
						</li>
						<!--<li>
							<a href="dashboard_my_wishlist.php" class="option_links" title="Wishlist"><i class='uil uil-heart icon_wishlist'></i><span class="noti_count1">3</span></a>
						</li>	-->
						<li class="ui dropdown">
							<a href="#" class="opts_account">
								<img src="<?php echo base_url('assets/images/avatar/img-5.jpg');?>" alt="">
								<span class="user__name">Account</span>
								<i class="uil uil-angle-down"></i>
							</a>
							<div class="menu dropdown_account">
								<div class="night_mode_switch__btn">
									<a href="#" id="night-mode" class="btn-night-mode">
										<i class="uil uil-moon"></i> Night mode
										<span class="btn-night-mode-switch">
											<span class="uk-switch-button"></span>
										</span>
									</a>
								</div>	
								<!--<a href="dashboard_my_wishlist.php" class="item channel_item"><i class="uil uil-heart icon__1"></i>My Wishlist</a>
								<a href="dashboard_my_wallet.php" class="item channel_item"><i class="uil uil-usd-circle icon__1"></i>My Wallet</a>
								<a href="dashboard_my_addresses.php" class="item channel_item"><i class="uil uil-location-point icon__1"></i>My Address</a>
								<a href="offers.php" class="item channel_item"><i class="uil uil-gift icon__1"></i>Offers</a>
								<a href="faq.php" class="item channel_item"><i class="uil uil-info-circle icon__1"></i>Faq</a>
								<a href="sign_in.php" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>-->
								<?php if($this->session->userdata('userlogin')){ ?>
								<a href="<?php echo base_url('dashboard/');?>" class="item channel_item"><i class="uil uil-apps icon__1"></i>Dashbaord</a>
								<a href="<?php echo base_url('my-orders/');?>" class="item channel_item"><i class="uil uil-box icon__1"></i>My Orders</a>
								<a href="<?php echo base_url('Welcome_controller/logout');?>" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>
								
								<?php }
								else{
								?>
								<a href="<?php echo base_url('login');?>" class="item channel_item"><i class="uil uil-unlock-alt icon__1"></i>Sign In</a>
								<a href="<?php echo base_url('signup');?>" class="item channel_item"><i class="uil uil-user icon__1"></i>Sign up</a>
								<?php }?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="sub-header-group">
			<div class="sub-header">
				<div class="ui dropdown">
					<a href="#" class="category_drop hover-btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i><span class="cate__icon">Select Category</span></a>
				</div>
				<nav class="navbar navbar-expand-lg navbar-light py-3">
					<div class="container-fluid">
						<button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
						<div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
							<ul class="navbar-nav main_nav align-self-stretch">
								<li class="nav-item"><a href="<?php echo base_url();?>" class="nav-link active" title="Home">Home</a></li>
								<li class="nav-item"><a href="<?php echo base_url('new-products');?>" class="nav-link new_item" title="New Products">New Products</a></li>
								<!--<li class="nav-item"><a href="shop_grid.php" class="nav-link" title="Featured Products">Featured Products</a></li>-->
								<li class="nav-item"><a href="<?php echo base_url('contact-us');?>" class="nav-link" title="Contact">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="catey__icon">
					<a href="#" class="cate__btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i></a>
				</div>
				<div class="header_cart order-1">
				<?php if($weight>10000000){
				    echo "<span class='text-danger'>You can't proceed with this order beacause your order weight exceed 10kg.</span>";
				}?>	<a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins><?php echo $this->cart->total_items(); ?></ins><i class="uil uil-angle-down"></i></a>
				</div>
				<div class="search__icon order-1">
					<a href="#" class="search__btn hover-btn" data-toggle="modal" data-target="#search_model" title="Search"><i class="uil uil-search"></i></a>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
				<script>
				$(document).ready(function(){
					$('#more_btn').click(function(){
						$('#show_more').show();
						$('#show_default').hide();
					})
					$('#hide_more_btn').click(function(){
						$('#show_more').hide();
						$('#show_default').show();
					})
				})
				</script>
	<script>
	function updateCartItem(rowid,qty){
		var search = $('#'+qty).val();
		var add=1;
		var qty=parseInt(search)+parseInt(add);
		$.ajax({
		url: "<?php echo base_url('Welcome_controller/updateItemQty/'); ?>",
		method: 'POST',
		data: { rowid:rowid,qty:qty },
		success:function(response){
			if(resp=='ok'){
				location.reload();
			}
			else{
				alert('Cart Update failed, please try again.');
			}
		}
	})
			
	}
	</script>
	<script>
	function decCartItem(rowid,qty){
		var search = $('#'+qty).val();
		var add=1;
		var qty=parseInt(search)-parseInt(add);
		$.ajax({
		url: "<?php echo base_url('Welcome_controller/updateItemQty/'); ?>",
		method: 'POST',
		data: { rowid:rowid,qty:qty },
		success:function(response){
			if(resp=='ok'){
				location.reload();
			}
			else{
				alert('Cart Update failed, please try again.');
			}
		}
	})
			
	}
	$(document).ready(function(){
	$('#checkout_btn').click(function(){
		    var subtotal = $("#sub_total").text()
		    if(subtotal < 499){
	                swal({
            		  title: "Sorry!",
            		  text: "Can't place order need minimum cart value of Rs.500 !",
            		  icon: "error",
            		  button: false,
            		  timer:2500,
            		});
	        }
	        else{
	            window.location.href="<?php echo base_url('checkout/'); ?>";
	        }
		})
	})
	</script>
	<!--<script>
	function updateCartItem(obj, rowid){
		$.get("<?php echo base_url('Welcome_controller/updateItemQty/'); ?>" {rowid:rowid,qty:obj.value}, function(resp){
			if(resp=='ok'){
				location.reload();
			}
			else{
				alert('Cart Update failed, please try again.');
			}
		})
	}
	</script>-->