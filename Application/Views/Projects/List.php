<?php

$view->extend('Layout');

?>

<div class="container">
	<div class="row">
		<?php foreach ($projectsList as $dir) : ?>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">

					<i class="fa fa-folder"></i>
					<a href="<?php echo $view['router']->generate('project', ['id' => $dir->getFilename()]) ?>">
						<?php echo $dir->getFilename() ?>
					</a>

				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>
