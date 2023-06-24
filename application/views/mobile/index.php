<style>
.title_name{
	color:#f74919;
}
</style>
<style>
.offer-badge-1{
  top:-850%;
}
.share-button{
  position:absolute;
  height:36px;
  top:7%;
  margin-top:-17px;
  width:35px;
  right:-6%;
  margin-left:-65px;
  // background:#368b8b;
  background-color: rgba(246,151,51,0.9);
  border-radius:20px;
  overflow:hidden;
  line-height:36px;
  user-select: none;
}
.lid{
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  //cursor: pointer;
    background-color: rgba(246,151,51,0.2);
    display: block;
    height: 35px;
    width: 35px;
    line-height: 37px;
    border-radius: 30px;
    transition: all 0.4s;
 // border-radius:20px;
  color:#fff;
}
</style>
<!--====================  hero slider ====================-->
        <div class="hero-slider bg-color--grey space-y--10">
            <div class="container">
                <div class="row row-10">
                    <div class="col-12">
                        <div class="hero-slider-wrapper">
                        	<?php foreach($banner_category as $banner_category){ ?>
						<a href="<?php echo base_url('shop-by-categories/'.$banner_category->id).'/'.strtolower(str_replace(' ', '-',$banner_category->name)).'/';?>">
                            <div class="hero-slider-item d-flex bg-img" data-bg="<?php echo base_url('assets/images/category/'.$banner_category->category_img); ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- hero slider content -->
                                            <div class="hero-slider-content">
                                                <h1 class="hero-slider-content__title space-mb--10 title_name"><?php echo $banner_category->name; ?> </h1>
                                                <p class="hero-slider-content__text">Category</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <?php } ?>
						<?php foreach($herb as $herb){ ?>
						<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$herb->id)).'/'.strtolower(str_replace(' ', '-',$herb->name));?>">
                            <div class="hero-slider-item d-flex bg-img" data-bg="<?php if($herb->product_img!==''){
										            echo base_url('assets/images/product/'.$herb->product_img);
										        }
										        else{
										            echo base_url('assets/images/product.jpg');
										        }?>">
									<?php
										$value=($herb->price*100)/$herb->orignal_price;
										$off=100-$value;
									?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- hero slider content -->
                                            <div class="hero-slider-content">
                                                <h1 class="hero-slider-content__title space-mb--10 title_name"><?php echo $herb->name; ?> </h1>
                                                <p class="hero-slider-content__text">GET <?php echo substr($off, 0,2); ?>% OFF</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of hero slider  ====================-->
        <!--====================  category slider ====================-->
        <div class="category-slider-area bg-color--grey space-pb--25 space-mb--25">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title -->
                        <h2 class="section-title space-mt--10 space-mb--20">Categories</h2>
                        <!-- category slider -->
                        <div class="category-slider-wrapper">
							<?php foreach($categories as $categories){ ?>
                            <div class="category-item">
                                <div class="category-item__image">
                                    <a href="<?php echo base_url('view-all/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>">
                                        <img src="<?php echo base_url('assets/images/category/'.$categories->category_img);?>" style="height:40px;" class="injectable" alt="">
                                    </a>
                                </div>
                                <div class="category-item__title">
                                    <a href="<?php echo base_url('view-all/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>"><?php echo $categories->name; ?></a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of category slider  ====================-->
        
        <!--====================  Astrology Books products area ====================-->
        <div class="products-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title -->
                        <h2 class="section-title space-mb--20">Astrology Books <a href="<?php echo base_url('product/astrology-books/');?>">VIEW ALL <span><img src="<?php echo base_url('assets/mobile/img/icons/arrow-right.svg'); ?>" class="injectable" alt=""></span></a></h2>
                        <!-- all products -->
                        <div class="all-products-wrapper space-mb-m--20">
                            <div class="row row-10">
							<?php foreach($astrology_books as $astrology_books){ ?>
                                <div class="col-6">
                                    <div class="grid-product space-mb--20">
                                        <div class="grid-product__image">
                                            <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$astrology_books->id)).'/'.strtolower(str_replace(' ', '-',$astrology_books->name));?>">
                                                <img src="<?php if($astrology_books->product_img!==''){
                                                    echo base_url('assets/images/product/'.$astrology_books->product_img);
                                                }
                                                else{
                                                    echo base_url('assets/images/product.jpg');
                                                }?>" style="height:130px;" class="img-fluid" alt="">
                                            </a>
                                            <!--<button class="icon"><img src="assets/img/icons/heart-dark.svg"
                                                    class="injectable" alt=""></button>-->
                                            <div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
                                        </div>
                                        <div class="grid-product__content">
                                            <h3 class="title"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$astrology_books->id)).'/'.strtolower(str_replace(' ', '-',$astrology_books->name));?>"><?php echo $astrology_books->name; ?></a></h3>
                                            <?php if($astrology_books->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?>
                                            <div class="price">
                                                <span class="main-price">₹<?php echo $astrology_books->orignal_price; ?></span>
                                                <span class="discounted-price">₹<?php echo $astrology_books->price; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of Astrology Books products area  ====================-->
		<!--====================  Astrology Herbs area ====================-->
        <div class="products-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title -->
                        <h2 class="section-title space-mb--20"> Photos & Murtis <a href="<?php echo base_url('product/Photos-and-murtis/');?>">VIEW ALL <span><img src="<?php echo base_url('assets/mobile/img/icons/arrow-right.svg'); ?>" class="injectable" alt=""></span></a> </h2>
                        <!-- all products -->
                        <div class="all-products-wrapper space-mb-m--20">
                            <div class="row row-10">
							<?php foreach($herbs as $herbs){ ?>
                                <div class="col-6">
                                    <div class="grid-product space-mb--20">
                                        <div class="grid-product__image">
                                            <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$herbs->id)).'/'.strtolower(str_replace(' ', '-',$herbs->name));?>">
                                                <img src="<?php if($herbs->product_img!==''){
                                                        echo base_url('assets/images/product/'.$herbs->product_img);
                                                    }
                                                    else{
                                                        echo base_url('assets/images/product.jpg');
                                                    }?>" style="height:130px;" class="img-fluid" alt="">
                                            </a>
                                            <!--<button class="icon"><img src="assets/img/icons/heart-dark.svg"
                                                    class="injectable" alt=""></button>-->
                                            <div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
                                        </div>
                                        <div class="grid-product__content">
                                            <h3 class="title"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$herbs->id)).'/'.strtolower(str_replace(' ', '-',$herbs->name));?>"><?php echo $herbs->name; ?></a></h3>
                                            <?php if($herbs->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?>
                                            <div class="price">
                                                <span class="main-price">₹<?php echo $herbs->orignal_price; ?></span>
                                                <span class="discounted-price">₹<?php echo $herbs->price; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of Herbs products area  ====================-->
		<!--====================  products area ====================-->
        <div class="products-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title -->
                        <h2 class="section-title space-mb--20">Latest Products <a href="<?php echo base_url('all-products/');?>">VIEW ALL <span><img src="<?php echo base_url('assets/mobile/img/icons/arrow-right.svg'); ?>" class="injectable" alt=""></span></a></h2>
                        <!-- all products -->
                        <div class="all-products-wrapper space-mb-m--20">
                            <div class="row row-10">
							<?php foreach($latest_product as $latest_products){ ?>
                                <div class="col-6">
                                    <div class="grid-product space-mb--20">
                                        <div class="grid-product__image">
                                            <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>">
                                                <img src="<?php if($latest_products->product_img!=='')
                                                {
                                                    echo base_url('assets/images/product/'.$latest_products->product_img);
                                                }
                                                else
                                                {
                                                    echo base_url('assets/images/product.jpg');
                                                }?>" style="height:130px;" class="img-fluid" alt="">
                                            </a>
                                            <!--<button class="icon"><img src="assets/img/icons/heart-dark.svg"
                                                    class="injectable" alt=""></button>-->
                                            <div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
                                        </div>
                                        <div class="grid-product__content">
                                            <h3 class="title"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>"><?php echo $latest_products->name; ?></a></h3>
                                            <?php if($latest_products->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?>
                                            <div class="price">
                                                <span class="main-price">₹<?php echo $latest_products->orignal_price; ?></span>
                                                <span class="discounted-price">₹<?php echo $latest_products->price; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of products area  ====================-->
        <script>
var a2a_config = a2a_config || {};
a2a_config.onclick = 1;
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
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