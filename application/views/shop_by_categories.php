<style>
.offer-badge-1{
  top:-850%;
}
.share-button{
  position:absolute;
  height:36px;
  top:6%;
  margin-top:-17px;
  width:35px;
  right:10%;
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
<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $category_name->name;?></li>
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
						<div class="product-top-dt">
							<div class="product-left-title">
								<h2><?php echo $category_name->name;?></h2>
							</div>
						</div>
					</div>
				</div>
<script>
    $(document).ready(function(){
        $("#insert_delivery_timing").submit(function(e){
            e.preventDefault();
            var delivery_timing = $("input[name='delivery_timing']:checked").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Welcome_controller/orders'); ?>",
                data: {delivery_timing:delivery_timing},
                success:function(data)
                {
                    alert('SUCCESS!!');
                },
                error:function()
                {
                    alert('fail');
                }
            });
        });
    });
	function Filter()
	{
		var value=$('#filterItem li').val();
		alert(value);
	}
</script>
				<div class="product-list-view">
					<div class="row">
					<?php $count=0;
					foreach($sub_categories as $sub_categories){
						$count++; 
						if($count>0){?>
						<div class="col-lg-3 col-md-6">
							<div class="product-item mb-30">
								<a href="<?php echo base_url('product-info/'.strtolower(str_replace(' ', '-',$sub_categories->id))).'/';?>" class="product-img">
									<img height="155px" src="<?php echo base_url('assets/images/sub_category/'.$sub_categories->sub_category_img);?>" alt="">
									<?php
									if($sub_categories->orignal_price!=='0'){
										$value=($sub_categories->price*100)/$sub_categories->orignal_price;
										$off=100-$value;
									}
									else{
										$off=0;
									}
										?>
									<div class="product-absolute-options">
										<span class="offer-badge-1"><?php echo substr($off, 0,2); ?>% off</span>
										<!--<span class="like-icon" title="wishlist"></span>-->
										<div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
									</div>
								</a>
								<div class="product-text-dt">
									 <p><?php if($sub_categories->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
									<h4><?php echo $sub_categories->sub_category_name; ?></h4>
									<div class="product-price">₹<?php echo $sub_categories->price; ?> <span>₹<?php echo $sub_categories->orignal_price; ?></span></div>
									
									<div class="product-price"><!--<a href="<?php //echo $sub_categories->youtube; ?>"><span style="font-size:35px;" class="fab fa-youtube text-danger" title="Watch YouTube Video"></span></a>--><a type="button" href="<?php echo $sub_categories->youtube;?>" style="padding-top:-10px;" class="order-btn hover-btn pt-2"> YouTube</a> <!--<a href="<?php //echo $sub_categories->blog; ?>" class="btn btn-outline-danger">Visit</a>--><a type="button" href="<?php echo $sub_categories->blog;?>" style="padding-top:-10px;" class="order-btn hover-btn pt-2"> Link</a></div>
									<p class="mt-3"><?php echo substr(strip_tags($sub_categories->description), 0, 350);?><a href="<?php echo $sub_categories->blog;?>">...read more</a></p>
									<form action="<?php echo base_url('Welcome_controller/add_to_cart2/'.$sub_categories->id).'/shop-by-categories/14/utara-upaay/'; ?>" method="post">
										<div class="qty-cart">
											<div class="quantity buttons_added">
												<input type="button" value="-" class="minus minus-btn">
												<input type="number" step="1" name="qty" value="1" class="input-text qty text">
												<input type="button" value="+" class="plus plus-btn">
											</div>
											<button style="border:none;background:none;" class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></button>
										</div>
										
									<div class="product-price mt-3"><button style="padding-top:-5px;" class="add-cart-btn hover-btn form-control"> <i class="uil uil-shopping-cart-alt"></i> Add to cart (for buy)</button><a class="a2a_dd" href="https://www.addtoany.com/share">Share</a></div>
									</form>
								</div>
							</div>
						</div>
					<?php }
					else{
						echo"data not found";
					}
					}?>
						<div class="col-md-12">
						<?php //echo $this->pagination->create_links(); ?>
							<div class="more-product-btn">
								<p class="" onclick="click_count()" id="data" style="display:none;">Show More</p>
								<!--<button class="show-more-btn hover-btn" onclick="click_count()" id="offset">Show More</button>-->
								<!--<button class="show-more-btn hover-btn" onclick="window.location.href = '<?php echo base_url("shop-by-categories/".strtolower(str_replace(' ', '-',$latest_products->category))); ?>';">Show More</button>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	var clicks = 0;
	function click_count(){
		clicks += 1;
		$('#data').show();
		$('#offset').hide();
		document.getElementById("data").innerHTML = 'No more data found.';
	}
	// $(document).ready(function(){
		// var limit=1;
		// var start=0;
		// var action='inactive';
		// function load_country_data(limit,start)
		// {
			// $.ajax({
				// url:"<?php echo base_url('Welcome_controller/fetchdata'); ?>",
				// method:"POST",
				// data{limit:limit, start:start},
				// cache:false,
				// success:function(data)
				// {
					// $('#load_data').append($data);
					// if(data=='')
					// {
						// $('#load_data_msg').html('No More');
					// }
				// }
			// });
		// }
		// if(action=='inactive'){
			// action='active';
			// load_country_data(limit,start);
		// }
		// $(window).scroll(function(){
			// alert('ok');
			// if($(window).scrollTop() + $(window).height() > $('#load_data').height() && action=='inactive')
			// {
				// action='active';
				// start=start+limit;
				// setTimeout(function(){
					// load_country_data(limit,start);
				// }, 1000);
			// }
		// })
	// });
	</script>
	<script>
var a2a_config = a2a_config || {};
a2a_config.onclick = 1;
</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
	<!-- Body End -->


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