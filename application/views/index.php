<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>RaiRaka</title>

	<!-- CSS  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous">

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
					<li class="">
						<a href="<?php echo site_url('list')?>">List Produk</a>
					</li>
				</li>
				<li>
					<li>
						<a href="<?php echo site_url('keranjang')?>">Keranjang Belanja (
							<?php echo count($cart); ?>)</a>
					</li>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>profil">Profil</a>
				</li>
				<!-- <li>
					<a href="<?php echo base_url(); ?>posts/create">Create Post</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>categories/create">Create Category</a>
				</li> -->
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

	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<?php foreach($product as $p){ ?>
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="kotak">
					<a href="#"></a>
					<a href="#">
						<img class="img-thumbnail" src="<?php echo base_url() . 'assets/img/posts/'.$p->post_image  ?>" />
					</a>
					<div class="card-body">
						<h1 class="card-title">
							<a href="#">
								<?php echo $p->title; ?>
							</a>
						</h1>
						<h4>Rp.
							<?php echo number_format($p->price,0,",","."); ?>
						</h4>
					</div>
					<form method="post" action="<?php echo site_url('Shopping_cart/beli'); ?>">
						<input type="hidden" name="id" value="<?php echo $p->id; ?>" />
						<input type="hidden" name="nama" value="<?php echo $p->title; ?>" />
						<input type="hidden" name="harga" value="<?php echo $p->price; ?>" />
						<input type="hidden" name="gambar" value="<?php echo $p->post_image; ?>" />
						<input type="hidden" name="qty" value="1" />
						<div class="card-footer">
							<button type="submit" class="btn btn-sm btn-primary">
								<i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
						</div>
					</form>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>
	<!-- /container -->
