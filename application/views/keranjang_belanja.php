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

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
		<h2 align="center">KERANJANG BELANJA</h2>
		<br>
		<br>
		<br>
		<form action="<?php echo site_url('Shopping_cart/ubah'); ?>" method="post" enctype="multipart/form-data">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Gambar</th>
						<th>Nama Produk</th>
						<th>Harga Produk</th>
						<th width="150">QTY</th>
						<th>Subtotal</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
            $total = 0;
            if(count($cart) > 0){
            foreach($cart as $item){
              $total += $item['subtotal'];
          ?>
						<tr>
							<td>
								<img src="<?php echo base_url('assets/img/posts/'.$item['gambar']) ?>" width="100">
							</td>
							<td>
								<?php echo $item['name']; ?>
							</td>
							<td>Rp
								<?php echo number_format($item['price'],0,',','.'); ?>
							</td>
							<td>
								<input type="hidden" name="cart[<?php echo $item['id'];?>][id]" value="<?php echo $item['id'];?>" />
								<input type="hidden" name="cart[<?php echo $item['id'];?>][rowid]" value="<?php echo $item['rowid'];?>" />
								<input type="hidden" name="cart[<?php echo $item['id'];?>][name]" value="<?php echo $item['name'];?>" />
								<input type="hidden" name="cart[<?php echo $item['id'];?>][price]" value="<?php echo $item['price'];?>" />
								<input type="hidden" name="cart[<?php echo $item['id'];?>][gambar]" value="<?php echo $item['gambar'];?>" />
								<input type="text" disabled name="cart[<?php echo $item['id'];?>][qty]" class="form-control" value="<?php echo $item['qty']; ?>">
							</td>
							<td>Rp
								<?php echo number_format($item['subtotal'],0,',','.'); ?>
							</td>
							<td>
								<a href="<?php echo site_url('Shopping_cart/hapus/'.$item['rowid']); ?>" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
							</td>
						</tr>
						<?php }}else{echo'<tr><td colspan="6" align="center"><h3>Keranjang Belanja Kosong.</h3></td></tr>'; } ?>
				</tbody>
			</table>
			<hr>
			<br>
			<h4>Total Yang Harus Dibayar : Rp
				<?php echo number_format($total,0,',','.'); ?>
			</h4>

			<?php
			
			if ($this->session->flashdata('berhasil')) {
				echo $this->session->flashdata('berhasil');
			}elseif($this->session->flashdata('hapus')){
				echo $this->session->flashdata('hapus');
			}
			
			?>
				<!-- <button type="submit" class="btn btn-default">Refresh</button> -->
				<?php if (count($cart) > 0) :?>
				<a href="<?php echo site_url('Shopping_cart/hapus/semua'); ?>" class="btn btn-danger">Kosongkan</a>
				<a href="<?php echo site_url('Shopping_cart/bayar'); ?>" class="btn btn-primary">Bayar</a>
				<?php else:?>
				<a href="<?php echo site_url('Shopping_cart/hapus/semua'); ?>" class="btn btn-danger disabled">Kosongkan</a>
				<a href="<?php echo site_url('Shopping_cart/bayar'); ?>" class="btn btn-primary disabled">Bayar</a>
				<?php endif;?>
				<!-- <?php echo $this->session->userdata('user_id');?>a -->
		</form>
	</div>
	<!-- /container -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	crossorigin="anonymous"></script>

</body>

</html>
