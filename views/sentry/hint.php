<?php foreach($messages as $hint): ?>
<div class="alert alert-<?=strtolower($hint['type']);?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?=$hint['text'];?>
</div>
<?php endforeach; ?>