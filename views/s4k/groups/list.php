<div class="row">
	<div class="span2 offset6">
		<p>
			<a href="<?=Route::url('S4K.groups.add', null, true);?>" class="btn btn-success"><i class="icon-plus-sign"></i> Create group</a>
		</p>
	</div>
</div>
<div class="row">
	<div class="span6 offset2">
		<table class="table table-bordered table-striped">
			<thead>
			<tr>
				<th class="span1">ID</th>
				<th>Name</th>
				<th class="span2">Options</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($groups as $group): ?>
			<tr>
				<td><?=$group->id;?></td>
				<td><?=$group->name;?></td>
				<td><a href="<?=Route::url('S4K.groups.edit', array('id' => $group->id), true);?>" class="btn btn-warning">Edit</a> <a href="<?=Route::url('S4K.groups.delete', array('id' => $group->id), true);?>" onclick="return confirm('are you sure you want to delete group #<?=$group->id;?>')" class="btn btn-danger">Delete</a></td>
			</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
