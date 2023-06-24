<!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url('my-orders/'); ?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="page-title text-center">My Orders</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of breadcrumb area  ====================-->
        <!--====================  order product area ====================-->
        <div class="order-product-area">
            <?php foreach($sub_category_order_details as $sub_category_order_details){ ?>
            <div class="cart-product border-bottom--medium">
                <div class="cart-product__image">
                    
                        <img src="<?php if($sub_category_order_details->sub_category_img=='')
                        {
                            echo base_url('assets/images/product.jpg');
                        }
                        else{
                            echo base_url('assets/images/sub_category/'.$sub_category_order_details->sub_category_img);
                        } ?>" class="img-fluid" alt="">
                    
                </div>
                <div class="cart-product__content">
                    <h3 class="title"><?php echo $sub_category_order_details->product_name;?></h3>
                    <span class="category">Category</span>
                    <div class="price">
                        <span class="discounted-price">₹<?php echo $sub_category_order_details->subtotal/$sub_category_order_details->qty;?></span>
                    </div>
                </div>
                <div class="cart-product__status">
                    <p><span><i class="fa fa-shopping-cart"></i></span> <?php echo $sub_category_order_details->qty;?> Items</p>
                </div>
            </div>
            <?php } ?>
			<?php foreach($order_details as $order_details){ ?>
            <div class="cart-product border-bottom--medium">
                <div class="cart-product__image">
                    <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$order_details->id)).'/'.strtolower(str_replace(' ', '-',$order_details->name));?>">
                        <img src="<?php if($order_details->product_img)
                        {
                            echo base_url('assets/images/product.jpg');
                        }
                        else{
                            echo base_url('assets/images/product/'.$order_details->product_img);
                        } ?>" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="cart-product__content">
                    <h3 class="title"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$order_details->id)).'/'.strtolower(str_replace(' ', '-',$order_details->name));?>"><?php echo $order_details->name;?></a></h3>
                    <span class="category"><?php echo $order_details->category;?></span>
                    <div class="price">
                        <span class="discounted-price">₹<?php echo $order_details->subtotal/$order_details->qty;?></span>
                    </div>
                </div>
                <div class="cart-product__status">
                    <p><span><i class="fa fa-shopping-cart"></i></span> <?php echo $order_details->qty;?> Items</p>
                </div>
            </div>
            <?php } ?>
        </div>
        <!--====================  End of order product area  ====================-->