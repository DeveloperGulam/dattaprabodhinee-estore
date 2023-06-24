<style>
.title_name{
	color:#f74919;
}
.buy_btn{
	color: #ffffff;
	background-color: #d11402;
	font-size: 16px;
	font-weight: 500;
	line-height: 1;
	display: block;
	-webkit-flex-basis: 50%;
	-ms-flex-preferred-size: 50%;
	flex-basis: 50%;
	padding: 15px;
	text-align:center;
	border: none;
}
</style>
<!--====================  product image slider ====================-->
        <div class="product-image-slider-wrapper space-pb--30 space-mb--30">
            <div class="product-image-single">
                <img src="<?php if($product_details->product_img=='')
                {
                    echo base_url('assets/images/product.jpg');
                }
                else
                {
                    echo base_url('assets/images/product/'.$product_details->product_img);
                }?>" style="height:200px;" class="img-fluid" alt="">
            </div>
            <!--<div class="product-image-single">
                <img src="assets/img/product-slider/product2.png" class="img-fluid" alt="">
            </div>
            <div class="product-image-single">
                <img src="assets/img/product-slider/product3.png" class="img-fluid" alt="">
            </div>-->
        </div>
        <!--====================  End of product image slider  ====================-->
        <!--====================  product content ====================-->
        <!-- product content header -->
        <div class="product-content-header-area border-bottom--thick space-pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-content-header">
                            <div class="product-content-header__main-info">
                                <h3 class="title"><?php echo $product_details->name; ?></h3>
								<div>Product No: 
                                    <span><?php echo $product_details->product_no; ?></span>
                                </div>
								<div><span><?php if($product_details->stock>'0'){
												echo"Available<span>(<span class='text-danger font-weight-bold'>".$product_details->stock."</span> In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></span>
                                </div>
                                <div class="price">
                                    <span class="main-price">₹<?php echo $product_details->orignal_price; ?></span>
                                    <span class="discounted-price">₹<?php echo $product_details->price; ?></span>
                                </div>
                                <!--<div class="rating">
                                    <ul class="rating__stars">
                                        <li><img src="assets/img/icons/star.svg" class="injectable" alt=""></li>
                                        <li><img src="assets/img/icons/star.svg" class="injectable" alt=""></li>
                                        <li><img src="assets/img/icons/star.svg" class="injectable" alt=""></li>
                                        <li><img src="assets/img/icons/star.svg" class="injectable" alt=""></li>
                                        <li><img src="assets/img/icons/star.svg" class="injectable" alt=""></li>
                                    </ul>
                                    <span class="rating__text">6</span>
                                </div>-->
                            </div>
                            <!--<div class="product-content-header__wishlist-info text-center">
                                <img src="assets/img/icons/heart-dark.svg" class="injectable" alt="">
                                <span class="count">10</span>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product content description -->
        <div class="product-content-description border-bottom--thick space-pt--25 space-pb--25">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="space-mb--25"><?php echo $product_details->description; ?></p>
                        <h4 class="space-mb--5">Free Shipping</h4>
                        <p>To your Address from seller. Shipping <br> method online.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- product content safety -->
        <div class="product-content-safety border-bottom--thick space-pt--15 space-pb--15">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4><img src="<?php echo base_url('assets/img/icons/security.svg');?>" class="injectable" alt=""> Secure Payment Method.
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- product color picker -->
        <!--<div class="product-color-picker border-bottom--thick space-pt--25 space-pb--25">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="space-mb--20">Color Select</h3>
                        <form>
                            <ul class="color-picker">
                                <li>
                                    <input id="black" type="radio" name="color" value="black" checked>
                                    <label class="black" for="black"></label>
                                </li>
                                <li>
                                    <input id="blue" type="radio" name="color" value="blue">
                                    <label class="blue" for="blue"></label>
                                </li>
                                <li>
                                    <input id="pink" type="radio" name="color" value="pink">
                                    <label class="pink" for="pink"></label>
                                </li>
                                <li>
                                    <input id="brown" type="radio" name="color" value="brown">
                                    <label class="brown" for="brown"></label>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- product content description -->
        <div class="product-content-description space-pt--25 space-pb--25">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="space-mb--5">Description</h4>
                        <p><?php echo $product_details->long_description; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->session->flashdata('cmsg')){ ?>
		<div class="alert alert-success fade show" role="alert">
			<?php echo $this->session->flashdata('cmsg'); ?>
		</div>
	<?php } ?>
        <!-- shop product button -->
		<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$product_details->id); ?>" method="post">
		<input type="hidden" name="qty" value="1">
        <div class="shop-product-button">
            <button class="cart">ADD TO CART (Buy)</button>
            <a href="<?php echo base_url('cart/'); ?>" class="buy buy_btn">VISIT CART</a>
        </div>
		</form>
        <!--====================  End of product content  ====================-->
        <?php if($this->session->flashdata('cmsg')){ ?>
<script>
swal({
		  text: "<?php echo $this->session->flashdata('cmsg'); ?>",
		  icon: "success",
		  button: false,
		  timer:2500,
		});
</script>
<?php }?>