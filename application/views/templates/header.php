<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>RaiRaka</title>

	<!-- CSS  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.css">
	<link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
	
</head>

<body>
	<nav class="white" role="navigation">
		<div class="nav-wrapper container">
			<a id="logo-container" href="<?php echo base_url(); ?>" class="brand-logo">RaiRaka</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="<?php echo base_url(); ?>about">About</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>produk">Detail Produk</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>kategori">Kategori</a>
				</li>
				<?php if($this->session->userdata('username')):?>
				<li>
					<a href="<?php echo site_url('list')?>">List Produk</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>keranjang">Keranjang Belanja</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>profil">Profil</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>users/logout">Logout</a>
				</li>

				<?php else: ?>
				<li>
					<a href="<?php echo base_url(); ?>users/login">Login</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>users/register">Register</a>
				</li>
				<?php endif;?>



				<ul id="nav-mobile" class="sidenav">
					<li>
						<a href="about.html">About</a>
					</li>
					<li>
						<a href="kategori.html">Kategori</a>
					</li>
					<li>
						<a href="login.html">Login</a>
					</li>
					<li>
						<a href="login.html">Logout</a>
					</li>
				</ul>
				<a href="#" data-target="nav-mobile" class="sidenav-trigger">
					<i class="material-icons">menu</i>
				</a>
		</div>
	</nav>
