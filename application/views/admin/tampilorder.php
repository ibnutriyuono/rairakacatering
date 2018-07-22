<div class="container">
	<div class="section">
		<div class="row">
			<h1 class='center-align'> Hasil Pencarian Order</h1>
			<a href="<?php print site_url();?>/admin/load" class="btn">
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
			 foreach($tampil as $u) : ?>

						<tr>
							<td>
								<?php echo $u->user_id;?>
							</td>
							<td>
								<?php echo $u->title ?>
							</td>
							<th>
								<?php echo $u->name ?>
							</th>
							<td>
								<?php echo $u->alamat ?>
							</td>
							<td>
								<?php echo $u->register_date?>
							</td>
							<td>
								<?php echo $u->email?>
                            </td>
                            <td>
								<?php echo $u->qty?>
                            </td>
                            <td>
								<?php echo $u->subtotal?>
                            </td>
                            <td>
                                <?php if($u->kirim == 1) {
                                    echo "Sudah bayar";
                                }else{
                                    echo "Belum Bayar";
                                }?>
                            </td>
                            <td>
                                <?php if($u->bayar == 1) {
                                    echo "Sudah bayar";
                                }else{
                                    echo "Belum Bayar";
                                }?>
							</td>
						</tr>
						<?php $no += 1;?>
						<?php endforeach; ?>

				</tbody>
			</table>

		</div>
	</div>
</div>
