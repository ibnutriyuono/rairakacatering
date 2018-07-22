<div class="container">
	<h1 class="center-align">
		<?php echo(ucwords('Selamat Datang di RaiRaka '.$sessionid));?>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo base_url()?>">Home</a>
		</li>
		<li class="active">Profil</li>
	</ol>
	<div class="section">
		<div class="row">
			<?php
	
            if ($this->session->flashdata('berhasilbayar')) {
                echo $this->session->flashdata('berhasilbayar');
            }

            ?>
            <h2>History Order</h2>
            <?php if (count(($posts)>0)):?>
				<table class="table striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Email</th>
							<th>Alamat</th>
                            <th>Tanggal Order</th>
                            <th>Jumlah Produk</th>
                            <th>Jumlah</th>
                            <th>Status Pengiriman</th>
                            <th>Status Pembayaran</th>
						</tr>
					</thead>
					<tbody>
						<!-- ISI DATA AKAN MUNCUL DISINI -->
						<?php
                        $no=1;
                        foreach($posts as $post) : 
                        ?>

					<tr>
                        <td>
                            <?php echo $no;?>
                        </td>
                        <td>
                            <?php echo $post['title'];?>
                        </td>
                        <td>
                            <?php echo $post['email'];?>
                        </td>
                        <th>
                            <?php echo $post['alamat'];?>
                        </th>
                        <td>
                            <?php echo $post['Hari']." - ".$post['Bulan']." - ".$post['Tahun'];?>
                        </td>
                        <td>
                            <?php echo $post['qty'];?>
                        </td>
                        <td>
                            <?php echo $post['subtotal'];?>
                        </td>
                        <?php if ($post['kirim']<=0 && $post['kirim']==0):?>
                        <td>					
                            Belum Dikirim
                        </td>
                        <?php else:?>
                        <td>
                            Sudah Dikirim
                        </td>
                        <?php endif;?>
                        <td>
                        <?php if ($post['bayar']<=0 && $post['bayar']==0):?>
                        <?php echo form_open('users/statusbayar/'.$post['id_order']); ?>
								<label>
									<input type="hidden" id="custId" name="id_order" value="<?php echo $post['id_order'];?>">
									<input type="submit" name="kirim" class="btn-small" value="Bayar" />
								</label>
						<?php echo form_close(); ?>
                        <?php else:?>
                            Sudah Bayar
                        <?php endif;?>
                        </td>
			    	</tr>
					<?php $no += 1;?>
					<?php endforeach; ?>
					</tbody>
                </table>
                <?php else:?>
                  <h2>Anda Belum Pernah Berbelanja di RaiRaka</h2>
                <?php endif;?>
		</div>
	</div>
</div>
