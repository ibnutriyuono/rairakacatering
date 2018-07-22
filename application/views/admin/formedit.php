<?php
	defined('BASEPATH') OR exit('Akses langsung tidak diperbolehkan');
	//echo validation_errors();
?>

<div class="container">
	<div class="section">

	<section class="container-fluid">
	<div class="row">
		<div class="form-input clearfix">
			<div class="col-md-12">

				<div class="panel panel-primary">
					<div class="teal panel-heading">Edit Data Produk</div>
					<div class="panel-body">
						<!-- <form action="<?php //echo base_url('home/tambahmobil'); ?>" method="post" class="form-horizontal"> -->
						
						<?php echo form_open('admin/updatemobil/'.$posts->id, ['class' => 'form-horizontal', 'method' => 'post']); ?>
							<div class="form-group <?php echo (form_error('id') != '') ? 'has-error has-feedback' : '' ?>">
								<label for="id" class=" disabled control-label col-sm-2">Kode Produk </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="id" value="<?php echo set_value('id', $posts->id); ?>" readonly>
									<?php echo (form_error('id') != '') ? '<span class="glyphicon glyphicon-remove form-control-feedback"></span>' : '' ?>
									<?php echo form_error('id'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="title" class="control-label col-sm-2">title </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" value="<?php echo set_value('title', $posts->title); ?>">
									<?php echo form_error('title'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="price" class="control-label col-sm-2">price </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="price" value="<?php echo set_value('price', $posts->price); ?>">
									<?php echo form_error('price'); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label for="userfile" class="control-label col-sm-2">Upload Image</label>
								<input type="file" name="userfile" size="20">
							</div>

							<div class="form-group">
								<div class="btn-form col-sm-12">
									<a href="<?php echo base_url('admin/produk'); ?>"><button type="button" class='btn btn-default'>Batal</button></a>
									<button type="submit" class='btn btn-primary'>Simpan</button>
								</div>
							</div>
						<?php echo form_close(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
	
	</div>
</div>