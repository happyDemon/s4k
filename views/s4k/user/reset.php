<a href="<?=Route::url('S4K.users.reset_valid', null, true);?>" class="pull-right">Reset password</a><h2>Forgotten password</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.reset.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" value="Request reset token" />
			</div>
		</div>
	</form>
</div>