<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Proyectos y Sistemas</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/slick-theme.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/nouislider.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/font-awesome.min.css">

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/style.css" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/tienda.jpg" type="image/x-icon">
</head>

<body>
	<header>
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> <?php echo $perfil[4]; ?></a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> <?php echo $perfil[3]; ?> </a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $perfil[5]; ?> - <?php echo $perfil[6]; ?> </a></li>
				</ul>
				<ul class="header-links pull-right">
					<!-- <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li> -->
					<li><a href="<?php echo base_url(); ?>login"><i class="fa fa-user-o"></i> Login</a></li>
				</ul>
			</div>
		</div>

		<div id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="header-logo">
							<a class="logo">
								<img src="<?php echo base_url(); ?>public/img/Tecno.png" alt="Tecno.png" height="75" width="275" style="border-radius: 25px;">
							</a>
						</div>
					</div>

					<div class="col-md-6"> 
					</div>

					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<div class="qty">3</div>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">
										<div class="product-widget">
											<div class="product-img">
												<img src="<?php echo base_url(); ?>public/tienda/img/product01.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>

										<div class="product-widget">
											<div class="product-img">
												<img src="<?php echo base_url(); ?>public/tienda/img/product02.png" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
											</div>
											<button class="delete"><i class="fa fa-close"></i></button>
										</div>
									</div>
									<div class="cart-summary">
										<small>3 Item(s) selected</small>
										<h5>SUBTOTAL: $2940.00</h5>
									</div>
									<div class="cart-btns">
										<a href="#">View Cart</a>
										<a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
							<!-- /Cart -->

							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<nav id="navigation">
		<div class="container">
			<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="<?php echo base_url(); ?>">Inicio</a></li>
					<li><a href="#">Sobre mí</a></li>
				</ul>
			</div>
		</div>
	</nav>
