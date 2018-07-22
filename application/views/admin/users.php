<div class="container">
	<h1 class="center-align">List Pelanggan</h1>

	<a href="<?php echo base_url(); ?>users/register" class="btn btn-primary">Tambah User</a>
	<?php
	
	if ($this->session->flashdata('update_sukses')) {
		echo $this->session->flashdata('update_sukses');
	}elseif ($this->session->flashdata('gagal')) {
		echo $this->session->flashdata('gagal');
	}

	?>
	<br>
	<br>
	<br>
	<?php print 'input nama : ';?>
	<br>
	<form action="<?php print site_url();?>admin/cari" method=POST>
	<input type=text name=cari> <input type=submit class="btn" value="cari">
	</form>
	<br>
	<table class="table">
		<thead>
			<tr>
                <th>No</th>
				<th>Nama Pelanggan</th>
				<th>Email</th>
                <th>Alamat</th>
                <th>Tanggal Buat Akun</th>
			</tr>
		</thead>
		<tbody>
			<!-- ISI DATA AKAN MUNCUL DISINI -->
			<?php
			$no=1;
			 foreach($user as $u) : ?>

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
				</tr>
                <?php $no += 1;?>
				<?php endforeach; ?>
        
		</tbody>
	</table>
    <div class="row">
        <div class="col md6 offset-md6">
            <div class="center-align">
            <?php 
            echo $this->pagination->create_links();
            ?>
            </div>
        </div>
    </div>
</div>
