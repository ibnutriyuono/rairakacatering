<div class="container">
	<div class="section">
		<div class="row">
			<h1 class='center-align'> Hasil Pencarian User</h1>
			<a href="<?php print site_url();?>/admin/list_user" class="btn">
				<b>Kembali</b>
			</a>
            <?php
	
            if ($this->session->flashdata('berhasil')) {
                echo $this->session->flashdata('berhasil');
            }
            ?>
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pelanggan</th>
						<th>Email</th>
						<th>Alamat</th>
						<th>Tanggal Buat Akun</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- ISI DATA AKAN MUNCUL DISINI -->
					<?php
			$no=1;
			 foreach($tampil as $u) : ?>

						<tr>
							<td>
								<?php echo $u->user_id;?>
							</td>
							<td>
								<?php echo $u->name ?>
							</td>
							<th>
								<?php echo $u->email ?>
							</th>
							<td>
								<?php echo $u->alamat ?>
							</td>
							<td>
								<?php echo $u->register_date?>
							</td>
							<td>
								<a href="<?php echo base_url('admin/edit/'.$u->user_id); ?>" class="btn btn-primary">Edit</a>
								<a href="<?php echo base_url('admin/hapusdata/'.$u->user_id); ?>" class="btn btn-primary">Hapus</a>
							</td>
						</tr>
						<?php $no += 1;?>
						<?php endforeach; ?>

				</tbody>
			</table>

		</div>
	</div>
</div>
