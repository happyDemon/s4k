<div class="row">
	<div class="span2 offset6">
		<p>
			<a href="<?=Route::url('S4K.users.manage.add', null, true);?>" class="btn btn-success"><i class="icon-plus-sign"></i> Create user</a>
		</p>
	</div>
</div>
<div class="row">
	<div class="span6 offset2">
		<table class="table table-bordered table-striped">
			<thead>
			<tr>
				<th class="span1">ID</th>
				<th>Email</th>
				<th class="span2">Options</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<td><?=$user->id;?></td>
				<td><?=$user->email;?></td>
				<td><a href="<?=Route::url('S4K.users.manage.edit', array('id' => $user->id), true);?>" class="btn btn-warning">Edit</a> <a href="<?=Route::url('S4K.users.manage.delete', array('id' => $user->id), true);?>" onclick="return confirm('are you sure you want to delete user #<?=$user->id;?>')" class="btn btn-danger">Delete</a></td>
			</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
