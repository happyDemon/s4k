<h2>Sign in</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.login.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
				<input type="password" name="password" id="inputPassword" placeholder="Password" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<?php
					if(!empty($throttle))
						echo '<p class="muted">'.$throttle.'</p>';
				?>
				<label class="checkbox">
					<input type="checkbox" name="remember"> Remember me
				</label>
				<input type="submit" class="btn btn-success" value="Sign in" />
			</div>
		</div>
	</form>
</div>