<h2>Account activation</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.activate.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
				<input type="text" name="email" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputCode">Activation code</label>
			<div class="controls">
				<input type="text" name="activation_code" id="inputCode" placeholder="Code" required /> <span class="text-error">*</span>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" value="Activate" />
			</div>
		</div>
	</form>
</div>