<?php
	
	if ($this->session->flashdata('berhasil')) {
		echo $this->session->flashdata('berhasil');
	}
?>
<div class="container">
	<h1 class="center-align">List Order</h1>
	<br>
	<?php print 'input nama : ';?>
	<br>
	<form action="<?php print site_url();?>admin/cariorder" method=POST>
	<input type=text name=cari> <input type=submit class="btn" value="cari">
	</form>
	<br>
	<table class="table">
		<thead>
			<tr>
                <th>No</th>
				<th>Nama Produk</th>
				<th>Nama Pelanggan</th>
                <th>Alamat</th>
                <td>Tanggal</td>
                <th>Email</th>
                <th>Jumlah</th>
				<th>Subtotal</th>
				<th>Kirim</th>
				<th>Bayar</th>
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
						<?php echo $post['title'];?>
					</td>
					<td>
						<?php echo $post['name'];?>
					</td>
					<th>
						<?php echo $post['alamat'];?>
                    </th>
                    <td>
                        <?php echo $post['Hari']."-".$post['Bulan']."-".$post['Tahun'];?>
                    </td>
					<td>
						<?php echo $post['email'];?>
                    </td>
                    <td>
                        <?php echo $post['qty'];?>
                    </td>
					<td>
						<?php echo $post['subtotal'];?>
					</td>
					<?php if ($post['kirim']<=0 && $post['kirim']==0):?>
					<td>					
						<div class="switch">
							<?php echo form_open('admin/statuskirim/'.$post['user_id']); ?>
								<label>
									<input type="hidden" id="custId" name="id_order" value="<?php echo $post['user_id'];?>">
									<input type="checkbox" name="kirim" onChange="this.form.submit()" />
									<span class="lever"></span>
								</label>
							<?php echo form_close(); ?>
						</div>
					</td>
					<?php else:?>
					<td>
					<div class="switch">
						<label>
							<input disabled checked type="checkbox">
							<span class="lever"></span>
						</label>
					</div>
					</td>
					<?php endif;?>
					<td>
					<?php if ($post['bayar']<=0 && $post['bayar']==0):?>
						Belum Bayar
					<?php else:?>
						Sudah Bayar
					<?php endif;?>
					</td>
				</tr>
                <?php $no += 1;?>
				<?php endforeach; ?>

		</tbody>
	</table>
</div>
