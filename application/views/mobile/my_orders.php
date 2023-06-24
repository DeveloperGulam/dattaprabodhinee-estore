<!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url(); ?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
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
			<?php foreach($order_details as $order_details){ ?>
            <div class="cart-product border-bottom--medium">
                <div class="cart-product__image">
                    <a href="<?php echo base_url('product-details/'.$order_details->id.'/');?>">
                        <img src="<?php echo base_url('assets/images/groceries.svg');?>" style="height:85px;padding:13px;" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="cart-product__content">
                    <h3 class="title"><a href="<?php echo base_url('product-details/'.$order_details->id.'/');?>">Locality: <?php echo $order_details->locality;?></a></h3>
                    <span class="category"><a href="<?php echo base_url('product-details/'.$order_details->id.'/');?>">Product Details <span class="fa fa-arrow-right"></span></a></span>
                    <div class="price">
                        <span class="discounted-price">₹<?php echo $order_details->total_amount;?></span>
                    </div>
                </div>
                <div class="cart-product__status">
                    <p><span><i class="fa fa-check-circle-o"></i></span> <?php if($order_details->status==0){ echo "Placed";}
														if($order_details->status==1){ echo "Packed";}
														if($order_details->status==2){ echo "On the way";}
														if($order_details->status==4){ echo "Delivered";}
														?></p>
                </div>
            </div>
            <?php } ?>
        </div>
        <!--====================  End of order product area  ====================-->