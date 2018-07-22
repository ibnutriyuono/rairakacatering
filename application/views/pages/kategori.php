<div class="container">
	<div class="section">
		<div class="row">

			<ul class="collection with-header">
				<li class="collection-header">
					<h4>List Kategori</h4>
				</li>
				<?php foreach($categories as $category) : ?>
				<li class="collection-item">
					<div>
						<?php echo $category['name']; ?>
						<a href="<?php echo site_url('/kategori/produk/'.$category['category_id']); ?>" class="secondary-content">
							<i class="material-icons">send</i>
						</a>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>

		</div>
	</div>
</div>
