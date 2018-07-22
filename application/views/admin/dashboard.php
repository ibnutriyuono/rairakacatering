<div class="container">
	<div class="section">
		<div class="row">

			<?php foreach($posts as $post) : ?>
			<div class="col s12 m4">
				<div class="card">
					<div class="card-image waves-effect waves-block waves-light">
						<img class="activator" src="<?php echo site_url(); ?>assets/img/posts/<?php echo $post['post_image']; ?>">
					</div>
					<div class="card-content">
						<span class="card-title activator grey-text text-darken-4">
							<?php echo $post['title']; ?>
							<i class="material-icons right">more_vert</i>
						</span>
						<p>
						</p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4">
							<?php echo $post['title']; ?>
							<i class="material-icons right">close</i>
						</span>
						<p>
							<?php echo word_limiter($post['body'], 60); ?>.</p>
						<p>Harga Produk ini <?php echo $post['price']; ?></p>	
					</div>
				</div>
				
            </div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
