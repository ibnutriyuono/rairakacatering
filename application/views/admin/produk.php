<div class="container">
	<h1 class="center-align">List Produk</h1>

	<a href="<?php echo base_url(); ?>posts/create" class="btn btn-primary">Tambah Produk</a>
	<a href="<?php echo base_url(); ?>categories/create" class="btn btn-primary">Tambah Kategori</a>
	<?php
	
	if ($this->session->flashdata('update_sukses')) {
		echo $this->session->flashdata('update_sukses');
	}

	?>
	<br>
	<br>
	<table class="table">
		<thead>
			<tr>
                <th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Gambar</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
			<!-- ISI DATA AKAN MUNCUL DISINI -->
			<?php
			$no=1;
			 foreach($posts as $post) : ?>

				<tr>
                    <td>
                        <?php echo $no;?>
                    </td>
					<td>
						<?php echo $post->title;?>
					</td>
					<th>
						<?php echo $post->price;?>
                    </th>
                    <td>
                        <?php echo $post->body;?>
                    </td>
					<td>
						<?php echo $post->created_at;?>
                    </td>
                    <td>
                        <img width="180" height="100" src="<?php echo site_url(); ?>assets/img/posts/<?php echo $post->post_image; ?>">
                    </td>
                    <td>
						<!-- <a href="<?php echo base_url('admin/editimage/'.$post->id); ?>" class="btn">Edit Image</a>	 -->
                        <a href="<?php echo base_url('admin/edit/'.$post->id); ?>"class="btn btn-primary">Edit</a>
                        <a href="<?php echo base_url('admin/hapusdata/'.$post->id); ?>"class="btn btn-primary">Hapus</a>
                    </td>
				</tr>
                <?php $no += 1;?>
				<?php endforeach; ?>

		</tbody>
	</table>
</div>
