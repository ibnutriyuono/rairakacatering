<div class="container">
	<div class="section">
	
		<?php echo form_open('users/login'); ?>
		<div class="row">
			<div class="col s12 m6 offset-m3">

				<div class="card">

					<div class="card-action teal lighten-2 white-text center-align">
						<h3>Masuk</h3>
					</div>

					<div class="card-content">
						<div class="form-field">
							<label for="username">Username</label>
							<input type="text" class="form-control" placeholder="Enter Username" required autofocus name="username" id="username">
						</div>
						<br>
						<div class="form-field">
							<label for="password">Password</label>
							<input type="password" class="form-control" placeholder="Enter Username" required autofocus name="password" id="password">
						</div>
						<br>
						<div class="form-field">
							<label>
								<input type="checkbox" />
								<span>Remember Me</span>
							</label>
						</div>
						<br>
						<div class="form-field">
							<input type="submit" value="Masuk !" class="btn-large waves-effect waves-dark white-text" style="width: 100%;">
						</div>
						<br>
					</div>

				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>
