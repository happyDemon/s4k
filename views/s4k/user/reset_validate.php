<h2>Password reset</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.reset_valid.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputToken">Reset token</label>
			<div class="controls">
				<input type="text" name="code" id="inputToken" placeholder="Reset token" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">New Password</label>
			<div class="controls">
				<input type="password" name="password" id="inputPassword" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" value="Sign in" />
			</div>
		</div>
	</form>
</div>