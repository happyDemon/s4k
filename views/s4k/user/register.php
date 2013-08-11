<h2>Register</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.register.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" value="<?=$email?>" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
				<input type="password" name="password" value="<?=$password?>" id="inputPassword" placeholder="Password" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputFirstname">First name</label>
			<div class="controls">
				<input type="text" name="first_name" value="<?=$first_name?>" id="inputFirstname" placeholder="first name" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputLastname">Last name</label>
			<div class="controls">
				<input type="text" name="last_name" value="<?=$last_name?>" id="inputLastname" placeholder="last name" />
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" value="Register" />
			</div>
		</div>
	</form>
</div>