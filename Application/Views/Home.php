<?php

$view->extend('Layout');

?>

<div class="container">

<ul class="list-group">
<?php foreach ($wwwDirectoriesList as $dir) : ?>
	<li class="list-group-item"><i class="fa fa-folder"></i>
	<strong><?php echo $dir->getFilename() ?></strong>
	<?php echo$dir->getRealpath() ?>
	</li>
<?php endforeach ?>
</ul>

</div>
