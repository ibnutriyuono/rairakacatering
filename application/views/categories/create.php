<div class="container">
	<div class="section">
		<div class="row">
		<h2><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" class="form-control" name="name" placeholder="Enter Kategori">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
		</div>
	</div>
</div>