 <!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url();?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="page-title text-center">Categories</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of breadcrumb area  ====================-->
        <!--====================  cart product area ====================-->
        <div class="cart-product-area">
		<?php //if($this->cart->total_items()!==0){
			foreach($categories as $categories){ ?>
            <div class="cart-product border-bottom--medium">
                <div class="cart-product__image" style="background:none;">
                    <a href="<?php echo base_url('shop-by-categories/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>">
                        <img src="<?php echo base_url('assets/images/category/'.$categories->category_img);?>" style="height:60px;" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="cart-product__content">
                    <h3 class="title"><a href="<?php echo base_url('view-all/'.$categories->id).'/'.strtolower(str_replace(' ', '-',$categories->name)).'/';?>"><?php echo $categories->name; ?></a></h3>
                </div>
                <div class="cart-product__counter">
                </div>
            </div>
		<?php }?>
        </div>