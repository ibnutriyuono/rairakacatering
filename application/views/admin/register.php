<div class="container">
	<div class="section">

		<?php echo validation_errors(); ?>
		<?php echo form_open('admin/register'); ?>
		<div class="row">
			<div class="col s12 m6 offset-m3">

				<div class="card">

					<div class="card-action teal lighten-2 white-text center-align">
						<h3>Daftar Admin</h3>
					</div>

					<div class="card-content">
						<div class="form-field">
							<label for="name">Name</label>
							<input type="text" name="name" id="name">
						</div>
						<div class="form-field">
							<label for="username">Username</label>
							<input type="text" name="username" id="username">
						</div>
						<br>
						<div class="form-field">
							<label for="password">Password</label>
							<input type="password" name="password" id="password">
						</div>
						<br>
						<div class="form-field">
							<label for="password2">Re-type Password</label>
							<input type="password" name="password2" id="email1">
						</div>
						<br>
						<div class="form-field">
							<label for="admin_name">Admin Name</label>
							<input type="text" name="admin_name" id="name">
						</div>
						<br>
						<div class="form-field">
							<input type="submit" value="Daftar !" class="btn-large waves-effect waves-dark white-text" style="width: 100%;">
						</div>
						<br>
					</div>

				</div>

			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
</div>
</div>
