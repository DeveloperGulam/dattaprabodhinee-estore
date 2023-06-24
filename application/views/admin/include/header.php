<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description-dattaprabodhinee" content="">
	<meta name="author-dattaprabodhinee" content="">
	<title>Dattaprabodhinee E-store::Admin</title>
	<link href="<?php echo base_url('assets/admin/css/styles.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/css/admin-style.css');?>" rel="stylesheet">
	
	<!-- Vendor Stylesheets -->
	<link href="<?php echo base_url('assets/admin/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
	
	<!-- froala Editor Stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/froala_editor.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/froala_style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/code_view.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/colors.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/emoticons.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/image_manager.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/image.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/line_breaker.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/table.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/char_counter.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/video.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/fullscreen.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/vendor/froala_editor_3.1.1/css/plugins/file.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/ajax/libs/codemirror/5.3.0/codemirror.min.css');?>">
	<script src="<?php echo base_url('assets/admin/js/jquery-3.4.1.min.js');?>"></script>
	<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"> 
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>	
</head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
            <a class="navbar-brand logo-brand" href="<?php echo base_url('admin/dashboard');?>">E-Store</a>
			<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a href="<?php echo base_url('admin/dashboard');?>" class="frnt-link"><i class="fas fa-external-link-alt"></i>Home</a>
            <ul class="navbar-nav ml-auto mr-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!--<a class="dropdown-item admin-dropdown-item" href="edit_profile.html">Edit Profile</a>
						<a class="dropdown-item admin-dropdown-item" href="change_password.html">Change Password</a>-->
                        <a class="dropdown-item admin-dropdown-item" href="<?php echo base_url('admin/logout');?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link active" href="<?php echo base_url('admin/dashboard');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
							</a>
							<a class="nav-link" href="<?php echo base_url('admin/orders/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                Orders
							</a>
							
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userReviews" aria-expanded="false" aria-controls="userReviews">
								<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Reviews
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="userReviews" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link sub_nav_link" href="<?php echo base_url('admin/users_review/');?>">User Reviews</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/pending_review/');?>">Pending Reviews</a>
								</nav>
                            </div>
                            
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
								<div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                                Group
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseLocations" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/groupList/');?>">View All Groups</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/createGroup/');?>">Create Group</a>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
								<div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseCategories" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/category/');?>">All Categories</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/add_category/');?>">Add Category</a>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubCategories" aria-expanded="false" aria-controls="collapseSubCategories">
								<div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Sub Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseSubCategories" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/sub_category/');?>">All Sub Categories</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/add_sub_category/');?>">Add Sub Category</a>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
								<div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/products/');?>">All Products</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/add_product/');?>">Add Product</a>
								</nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStocks" aria-expanded="false" aria-controls="collapseStocks">
								<div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Stocks
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseStocks" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link sub_nav_link" href="<?php echo base_url('admin/request_stocks/');?>">Request Stocks</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/stocks_history/');?>">Stock History</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/transfer_stock/');?>">Transfer Stock</a>
								</nav>
                            </div>
                            
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
								<div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Sales Transaction
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseSales" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link sub_nav_link" href="<?php echo base_url('admin/Audit/');?>">New Sale</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/getAudit/');?>">Sales History</a>
								</nav>
                            </div>
							<!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupons" aria-expanded="false" aria-controls="collapseCoupons">
								<div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                                Coupon
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseCoupons" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/products/');?>">All Coupons</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/add_coupon/');?>">Add Coupon</a>
								</nav>
                            </div>-->
							<a class="nav-link" href="<?php echo base_url('admin/customers/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customers
							</a>
							<a class="nav-link" href="<?php echo base_url('admin/contact/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                                Contact-us
							</a>
							<a class="nav-link" href="<?php echo base_url('admin/newsletter/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Newsletter
							</a>
                             <!--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                                Posts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="posts.html">All Posts</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('admin/add_post');?>">Add New</a>
									<a class="nav-link sub_nav_link" href="post_categories.html">Categories</a>
									<a class="nav-link sub_nav_link" href="post_tags.html">Tags</a>
								</nav>
                            </div>		
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
								<div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                                Locations
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseLocations" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="locations.html">All Locations</a>
									<a class="nav-link sub_nav_link" href="add_location.html">Add Location</a>
								</nav>
                            </div>		
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAreas" aria-expanded="false" aria-controls="collapseAreas">
								<div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div>
                                Areas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseAreas" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="areas.html">All Areas</a>
									<a class="nav-link sub_nav_link" href="add_area.html">Add Area</a>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShops" aria-expanded="false" aria-controls="collapseShops">
								<div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                                Shops
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseShops" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="shops.html">All Shops</a>
									<a class="nav-link sub_nav_link" href="add_shop.html">Add Shop</a>
								</nav>
                            </div>
							<a class="nav-link" href="offers.html">
								<div class="sb-nav-link-icon"><i class="fas fa-gift"></i></div>
                                Offers
							</a>
							<a class="nav-link" href="pages.html">
								<div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
							</a>
                            <a class="nav-link" href="menu.html">
								<div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                                Menu
							</a>
							<a class="nav-link" href="updater.html">
								<div class="sb-nav-link-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                Updater
							</a>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
								<div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Setting
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseSettings" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="general_setting.html">General Settings</a>
									<a class="nav-link sub_nav_link" href="payment_setting.html">Payment Settings</a>
									<a class="nav-link sub_nav_link" href="email_setting.html">Email Settings</a>
								</nav>
                            </div>
							<a class="nav-link" href="reports.html">
								<div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                                Reports
							</a>-->
                        </div>
                    </div>
                </nav>
            </div>