<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description-dattaprabodhinee" content="">
	<meta name="author-dattaprabodhinee" content="">
	<title>Dattaprabodhinee E-store::Seller Panel</title>
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
            <a class="navbar-brand logo-brand" href="<?php echo base_url('seller/dashboard');?>">E-Store</a>
			<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a href="<?php echo base_url('seller/dashboard');?>" class="frnt-link"><i class="fas fa-external-link-alt"></i>Home</a>
            <ul class="navbar-nav ml-auto mr-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item admin-dropdown-item" href="<?php echo base_url('seller/edit_profile/');?>">Edit Profile</a>
						<!--<a class="dropdown-item admin-dropdown-item" href="change_password.html">Change Password</a>-->
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
                            <a class="nav-link active" href="<?php echo base_url('seller/dashboard');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
							</a>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStocks" aria-expanded="false" aria-controls="collapseStocks">
								<div class="sb-nav-link-icon"><i class="fas fa-bar-chart"></i></div>
                                Stocks
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseStocks" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('seller/stocks/');?>">Available Stocks</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('seller/products/');?>">Request New Stock</a>
								</nav>
                            </div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
								<div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
									<a class="nav-link sub_nav_link" href="<?php echo base_url('seller/products/');?>">All Products</a>
									<!--<a class="nav-link sub_nav_link" href="<?php echo base_url('seller/add_product/');?>">Add Product</a>-->
								</nav>
                            </div>
							<a class="nav-link" href="<?php echo base_url('seller/orders/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                Orders
							</a>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
								<div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Sales Transaction
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
                            <div class="collapse" id="collapseSales" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link sub_nav_link" href="<?php echo base_url('seller/Audit/');?>">New Sale</a>
									<a class="nav-link sub_nav_link" href="<?php echo base_url('seller/getAudit/');?>">Sales History</a>
								</nav>
                            </div>
							<a class="nav-link" href="<?php echo base_url('seller/payment_gateway/');?>">
								<div class="sb-nav-link-icon"><i class="fas fa-money"></i></div>
                                Payment Gateway
							</a>
                        </div>
                    </div>
                </nav>
            </div>