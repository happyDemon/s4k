<h2>Create user</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.users.manage.add.complete', null, true);?>">
		<fieldset>
			<legend>General</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Email</label>
				<div class="controls">
					<input type="text" name="email" value="" id="inputEmail" placeholder="Email" required /> <span class="text-error">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">Password</label>
				<div class="controls">
					<input type="password" name="password" value="" id="inputPassword" placeholder="Password" required /> <span class="text-error">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputFirstname">First name</label>
				<div class="controls">
					<input type="text" name="first_name" value="" id="inputFirstname" placeholder="First name" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputLastname">Last name</label>
				<div class="controls">
					<input type="text" name="last_name" value="" id="inputLastname" placeholder="Last name" />
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Group & permissions</legend>
			<div class="control-group">
				<label class="control-label">Groups</label>
				<div class="controls">
					<div class="row-fluid" id="groups">
						<div class="row-fluid">
							<div class="span5">
								<div class="input-append span12">
									<input type="text" id="move-group-filter-base" class="appendedInput"/>
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
							<div class="span2"></div>
							<div class="span5">
								<div class="input-append span12 pull-right">
									<input type="text" id="move-group-filter-container" class="appendedInput"/>
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span5">
								<select multiple="multiple" class="span12" id="move-group-base" size="8">
									<?php foreach($groups as $group):?>
										<option value="<?=$group->id;?>"><?=$group->name;?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="span2 pagination-centered" style="padding-top: 60px;">
								<a class="btn btn-small btn-primary" id="move-group-in">>></a><br />
								<a class="btn btn-small btn-primary" id="move-group-out"><<</a>
							</div>
							<div class="span5">
								<select multiple="multiple" class="span12" id="move-group-container" size="8" name="groups[]">
								</select>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span5"><a href="#" class="btn btn-mini btn-success" id="move-group-fill">Move all</a></div>
							<div class="span2" style="padding-top: 20px; padding-left: 15px"></div>
							<div class="span5"><a href="#" class="btn btn-mini btn-danger pull-right" id="move-group-empty">Remove all</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Permissions</label>
				<div class="controls">
					<div class="row-fluid" id="permissions">
						<div class="row-fluid">
							<div class="span5">
								<div class="input-append span12">
									<input type="text" id="move-select-filter-base" class="appendedInput"/>
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
							<div class="span2"></div>
							<div class="span5">
								<div class="input-append span12 pull-right">
									<input type="text" id="move-select-filter-container" class="appendedInput"/>
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span5">
								<select multiple="multiple" class="span12" id="move-select-base" size="8">
									<?php foreach($permissions as $id => $perm):?>
									<option value="<?=$perm;?>"><?=$perm;?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="span2 pagination-centered" style="padding-top: 60px;">
								<a class="btn btn-small btn-primary" id="move-select-in">>></a><br />
								<a class="btn btn-small btn-primary" id="move-select-out"><<</a>
							</div>
							<div class="span5">
								<select multiple="multiple" class="span12" id="move-select-container" size="8" name="permissions[]">
								</select>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span5"><a href="#" class="btn btn-mini btn-success" id="move-select-fill">Move all</a></div>
							<div class="span2" style="padding-top: 20px; padding-left: 15px"></div>
							<div class="span5"><a href="#" class="btn btn-mini btn-danger pull-right" id="move-select-empty">Remove all</a></div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" id="group-save" value="Create user" />
			</div>
		</div>
	</form>
</div>
<div id="push"></div>