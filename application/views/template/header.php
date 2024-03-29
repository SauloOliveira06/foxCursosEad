<!DOCTYPE html>
<html lang="en">

<head>
	<!-- tags necessarias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Fox Cursos</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/vendors/linericon/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/vendors/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/vendors/animate-css/animate.css">

	<!-- principal css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">

	<?php if(isset($styles)){
		foreach ($styles as $style_name){
			$href = base_url() . "public/css/" . $style_name; ?>
			<link href="<?=$href?>" rel="stylesheet">
		<?php }
	} ?>

	<!-- FONTE NUNITO -->
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
</head>

<!--================ Inicio Header =================-->
	<header class="header_area">
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-sm-6 col-4 header-top-left">
						<a href="#">
							<span class="lnr lnr-phone"></span>
							<span class="text">
								<span class="text">+55 92 99999-9999</span>
							</span>
						</a>
						<a href="#">
							<span class="lnr lnr-envelope"></span>
							<span class="text">
								<span class="text">email@fox.com</span>
							</span>
						</a>
					</div>
					<div class="col-lg-6 col-sm-6 col-8 header-top-right">
						<a href="<?php echo base_url(); ?>restrict" class="text-uppercase">Login</a>
					</div>
				</div>
			</div>
		</div>

		<div class="main_menu">
			<div class="search_input" id="search_input_box">
				<div class="container">
					<form class="d-flex justify-content-between" method="" action="">
						<input type="text" class="form-control" id="search_input" placeholder="Procurar">
						<button type="submit" class="btn"></button>
						<span class="lnr lnr-cross" id="close_search" title="Fechar procura"></span>
					</form>
				</div>
			</div>

			<nav class="navbar navbar-expand-lg navbar-shrink navbar-light">
				<div class="container">
					<!-- Marque e alterne para agrupar para melhor exibição em dispositivos móveis -->
					<a class="navbar-brand logo_h" href="<?php echo base_url(); ?>home"><img src="<?php echo base_url(); ?>public/img/logo1.png" width="150" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Colete os links de navegação, formulários e outros conteúdos para alternar -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="<?php echo base_url(); ?>public/index.html">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="#">Sobre</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Páginas</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="#">Cursos Livres</a></li>
									<li class="nav-item"><a class="nav-link" href="#">Cursos Pagos</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="#">Blog Detalhes</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
							<li class="nav-item">
								<a href="#" class="nav-link search" id="search">
									<i class="lnr lnr-magnifier"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================ Fim Header Menu Area =================-->

	