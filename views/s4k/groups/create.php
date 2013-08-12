<h2>Create group</h2>

<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="<?=Route::url('S4K.groups.add.complete', null, true);?>">
		<div class="control-group">
			<label class="control-label" for="inputName">Name</label>
			<div class="controls">
				<input type="text" name="name" value="" id="inputName" placeholder="Name" required /> <span class="text-error">*</span>
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
						<div class="span5"><select multiple="multiple" class="span12" id="move-select-container" size="8" name="permissions[]"></select></div>
					</div>
					<div class="row-fluid">
						<div class="span5"><a href="#" class="btn btn-mini btn-success" id="move-select-fill">Move all</a></div>
						<div class="span2" style="padding-top: 20px; padding-left: 15px"></div>
						<div class="span5"><a href="#" class="btn btn-mini btn-danger pull-right" id="move-select-empty">Remove all</a></div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-success" id="group-save" value="Create group" />
			</div>
		</div>
	</form>
</div>