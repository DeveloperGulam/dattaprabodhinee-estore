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
  right:-10%;
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
<!--====================  shop header ====================-->
        <div class="shop-header bg-color--grey">
            <div class="container space-y--15">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url();?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="category-title text-center">Products</h1>
                    </div>
                    <!--<div class="col-3 text-right">
                        <button class="filter-trigger" id="filter-trigger">Filter</button>
                    </div>-->
                </div>
            </div>
            <div class="shop-filter space-pt--15 space-pb--50" id="shop-filter-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-filter-block space-mb--25">
                                <h4 class="shop-filter-block__title space-mb--5">Price</h4>
                                <div class="shop-filter-block__content">
                                    <div class="widget-price-range">
                                        <input type="text" id="price-range-slider">
                                    </div>
                                </div>
                            </div>
                            <div class="shop-filter-block space-mb--25">
                                <h4 class="shop-filter-block__title space-mb--15">Size</h4>
                                <div class="shop-filter-block__content">
                                    <ul class="shop-filter-block__size">
                                        <li><button class="active">XS</button></li>
                                        <li><button>S</button></li>
                                        <li><button>M</button></li>
                                        <li><button>L</button></li>
                                        <li><button>XL</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-filter-block">
                                <button class="shop-filter-btn apply-btn">APPLY</button>
                                <button class="shop-filter-btn cancel-btn" id="shop-filter-slideup">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of shop header  ====================-->
        <!--====================  products area ====================-->
        <div class="shop-products-area">
            <!-- shop grid products -->
            <div class="shop-grid-products-wrapper space-mt--30 space-mb-m--20">
                <div class="container">
                    <div class="row row-10" id="postList">
					<?php foreach($cart_products as $products){ }?>
					<?php $count=0;
					foreach($new_products as $latest_products){
						$count++; 
						if($count>0){?>
                        <div class="col-6">
                            <div class="grid-product space-mb--20">
                                <div class="grid-product__image">
                                    <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>">
                                        <img src="<?php if($latest_products->product_img==''){
                                            echo base_url('assets/images/product.jpg');
                                        }
                                        else{
                                            echo base_url('assets/images/product/'.$latest_products->product_img);
                                        }?>" class="img-fluid" alt="">
                                    </a>
                                    <!--<button class="icon"><img src="assets/img/icons/heart-dark.svg" class="injectable" alt=""></button>-->
									<div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
                                </div>
                                <div class="grid-product__content">
                                    <h3 class="title" style="font-size:15px;"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>"><?php echo $latest_products->name; ?></a></h3>
                                    <span class="category"><?php if($latest_products->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "<span class='text-danger'>Out Of Stock</span>";
											}
											?></span>
                                    <div class="price mb-1">
                                        <span class="main-price">₹<?php echo $latest_products->orignal_price; ?></span>
                                        <span class="discounted-price">₹<?php echo $latest_products->price; ?></span>
                                    </div>
								<?php if(!empty($products['sub_category_image'])){
									echo "";
								}
								else{?>
									<form method="post" action="<?php echo base_url('Welcome_controller/add_to_cart/'.$latest_products->id).'/home/'; ?>">
									<input type="hidden" name="qty" value="1"/>
                                        <button class="btn btn-outline-success form-control btn-sm" style="font-size:12px;">Add To Cart (Buy)</button>
									</form>
								<?php }?>
                                </div>
                            </div>
                        </div>
						<?php }
					else{
						echo"data not found";
					}
					}?>
					<div class="show_more_main ml-3" id="show_more_main<?php echo $latest_products->id; ?>">
						    <button class="btn btn-outline-success show_more" id="<?php echo $latest_products->id; ?>" title="Load more posts">Load more post</button>
                            <button class="btn btn-outline-success loding" style="display: none;"><span class="loding_txt">Loading...</span></button>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:"<?php echo base_url('Welcome_controller/ajax_more');?>",
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('#postList').append(html);
            }
        });
    });
});
</script>
        <!--====================  End of products area  ====================-->
		<script>
var a2a_config = a2a_config || {};
a2a_config.onclick = 1;
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>