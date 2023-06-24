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
		
		<link rel="stylesheet" href="<?php echo base_url('assets/mobile/css/vendor.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/mobile/css/plugins/plugins.min.css'); ?>">
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		
		
		<!-- Vendor Stylesheets -->
		<link rel="stylesheet" href="<?php echo base_url('assets/mobile/css/style.css');?>">
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
	<!-- Share Icons Start-->
	<!--<div class="icon-bar">
	  <a href="#" class="facebook" title="Share"><i class="fab fa-facebook-f"></i></a> 
	  <a href="#" class="twitter" title="Share"><i class="fab fa-twitter"></i></a> 
	  <a href="#" class="google" title="Share"><i class="fab fa-google"></i></a> 
	  <a href="#" class="linkedin" title="Share"><i class="fab fa-linkedin-in"></i></a>
	  <a href="#" class="whatsapp" title="Share"><i class="fab fa-whatsapp"></i></a> 
	</div>-->
	<!-- Share Icons End-->
	<!--====================  preloader area ====================-->
    <div class="preloader-activate preloader-active">
        <div class="preloader-area-wrap">
            <div class="spinner d-flex justify-content-center align-items-center h-100">
                <div class="img-loader"></div>
            </div>
        </div>
    </div>
    <!--====================  End of preloader area  ====================-->
    <div class="body-wrapper space-pt--70 space-pb--120">
        <!--====================  header area ====================-->
        <header>
            <div class="header-wrapper border-bottom">
                <div class="container space-y--15">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- header logo -->
                            <div class="header-logo">
                                <a href="<?php echo base_url();?>">
                                    <img src="<?php echo base_url('assets/images/dattaprabodhinee-estore.png');?>" style="height:42px"  class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <!-- header search -->
                            <div class="header-search">
                                <form action="<?php echo base_url('search-product'); ?>" method="post">
                                    <input type="text" id="headerSearchInput" name="input_value" placeholder="Search Product" autocomplete="off">
                                    <img src="<?php echo base_url('assets/mobile/img/icons/search.svg');?>" class="injectable" alt="">
                                </form>
                            </div>
                        </div>
<script>
$(document).ready(function(){
	$('#headerSearchInput').keyup(function(){
		var query=$(this).val();
		if(query!='')
		{
			$.ajax({
				url: "<?php echo base_url('Welcome_controller/get_data'); ?>",
				method: 'POST',
				data: { query: query },
				success:function(data){
					$('#searchList').fadeIn();
					// var suggestions = JSON.parse(data);
					// $('#'+inputId+'_list').html('')
					// for(let i=0; i<data.length; i++){
						// value = "'"+data[i].name+"'";
						// $('#searchList').append('<div>'+suggestions[i].name+'</div>')
						// $('#searchList').html('<li class="border-bottom">'+data+'</li>');
					// }
					$('#searchList').html('<li class="border-bottom">'+data+'</li>');
				}
			})
		}
		
	});
})
// function  searchData()
// {
	// var value=$('#SearchData').val();
	// alert(value);
// }
</script>
                        <div class="col-auto">
                            <!-- header menu trigger -->
                            <button class="header-menu-trigger" id="header-menu-trigger">
                                <img src="<?php echo base_url('assets/mobile/img/icons/menu.svg');?>" class="injectable" alt="">
                            </button>
                        </div>
                    </div>
                    <ul class="text-center" id="searchList"></ul>
                </div>
            </div>
            <!-- search keywords -->
            <div class="search-keyword-area space-xy--15 bg-color--grey2" id="search-keyword-box">
                <div class="search-keyword-header space-mb--20">
                    <h4 class="search-keyword-header__title">Top Categories</h4>
                </div>
                <ul class="search-keywords">
                    <?php foreach($nine_categories as $nine_categories){ ?>
                    <li><a href="<?php echo base_url('shop-by-categories/'.$nine_categories->id).'/'.strtolower(str_replace(' ', '-',$nine_categories->name)).'/';?>"><?php echo $nine_categories->name; ?></a></li>
					<?php } ?>
					<li><a href="<?php echo base_url('categories/'); ?>" style="border:none;background:none;color:#f55d2c;">Show More</a></li>
                </ul>
            </div>
        </header>
        <!--====================  End of header area  ====================-->
        <!--====================  mobile menu overlay ====================-->
        <div class="offcanvas-menu" id="offcanvas-menu">
		<?php if($this->session->userdata('userlogin')){ ?>
            <div class="profile-card text-center">
                <div class="profile-card__image space-mb--10">
                    <img src="<?php if($logged_user->customer_img==''){
									echo base_url('assets/images/avatar/img-5.jpg');
								}
								else{
								    if($logged_user->login_oauth_uid!==''){
								        echo $logged_user->customer_img;
								    }
								    else{
									    echo base_url('assets/images/avatar/'.$logged_user->customer_img);
								    }
								}?>" class="img-fluid" alt="">
                </div>
                <div class="profile-card__content">
                    <p class="name"><?php echo $logged_user->name;?> <span class="id"><?php echo $logged_user->number;?></span></p>
                    <p><i class="fa fa-sign-out text-danger"></i> <a class="text-danger font-weight-bold" href="<?php echo base_url('Welcome_controller/logout');?>">Logout</a></p>
                </div>
            </div>
		<?php }
		else{ ?>
			<div class="profile-card text-center">
                <div class="profile-card__image space-mb--10">
                    <img src="<?php echo base_url('assets/images/avatar/img-5.jpg');?>" class="img-fluid" alt="">
                </div>
                <div class="profile-card__content">
                    <a href="<?php echo base_url('login/');?>">Hello, Sign in</a>
                </div>
            </div>
		<?php } ?>
            <div class="offcanvas-navigation-wrapper space-mt--40">
                <ul class="offcanvas-navigation">
				<?php if($this->session->userdata('userlogin')){ ?>
					<li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/profile-two.svg');?>" class="injectable" alt=""></span><a href="<?php echo base_url('profile/');?>">My Profile</a></li>
					<li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/cart-two.svg');?>" class="injectable" alt=""></span><a href="<?php echo base_url('my-orders/');?>">My Order</a></li>
				<?php }
				else{?>
                    <li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/profile.svg');?>" class="injectable" alt=""></span><a
                            href="<?php echo base_url('login/');?>">Login / Sign up</a></li>
				<?php } ?>
                    <!--<li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/notification.svg');?>" class="injectable"
                                alt=""></span><a href="notification.html">Notification</a></li>-->
                    <li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/product.svg');?>" class="injectable" alt=""></span><a
                            href="<?php echo base_url('all-products/');?>">New Products</a></li>
                    <li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/cart-three.svg');?>" class="injectable" alt=""></span><a href="<?php echo base_url('cart/');?>">Cart</a></li>
                    <!--<li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/wishlist.svg');?>" class="injectable" alt=""></span><a
                            href="wishlist.html">Wishlist</a></li>-->
				<?php if($this->session->userdata('userlogin')){ ?>
                    <li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/gear-two.svg');?>" class="injectable" alt=""></span><a href="<?php echo base_url('edit-profile/');?>">Settings</a></li>
				<?php } ?>
                    <li><span class="icon"><img src="<?php echo base_url('assets/mobile/img/icons/profile.svg');?>" class="injectable" alt=""></span><a href="<?php echo base_url('contact-us/');?>">Contact Us</a></li>
                    <li><span class="icon"><i class="fa fa-question-circle"></i></span><a href="<?php echo base_url('assets/pdf/estore-guide.pdf');?>">Help</a></li>
				<!--<?php if($this->session->userdata('userlogin')){ ?>
                    <li><span class="icon"><i class="fa fa-lock"></i></span><a href="<?php echo base_url('Welcome_controller/logout');?>">Logout</a></li>
				<?php } ?>-->
                </ul>
            </div>
        </div>
        <!--====================  End of mobile menu overlay  ====================-->