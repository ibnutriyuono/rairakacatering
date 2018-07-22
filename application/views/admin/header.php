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
	 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous"> -->

	<link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
</head>

<body>
	<nav class="white" role="navigation">
		<div class="nav-wrapper container">
			<a id="logo-container" href="<?php echo base_url(); ?>admin" class="brand-logo">RaiRakaAdmin</a>
			<ul class="right hide-on-med-and-down">
				<?php if($this->session->userdata('admin_username')):?>
				<li>
					<a href="<?php echo base_url(); ?>posts/create">Tambah Menu</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>categories/create">Tambah Kategori</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>admin/register">Tambah Admin</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>admin/produk">List Produk</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>admin/load">List Order</a>
				</li>
				<li>
					<a href="<?php echo site_url(); ?>admin/list_user">List User</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>admin/logout">Logout</a>
				</li>

				<?php else: ?>
				
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
