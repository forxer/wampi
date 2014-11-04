<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Projects'));

$view['breadcrumb']->add($view['translator']->trans('Projects'), $view['router']->generate('projects'));

?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
			<?php foreach ($projectsList as $dir) : ?>
				<li class="list-group-item">

					<i class="fa fa-folder"></i>
					<a href="<?php echo $view['router']->generate('project', ['id' => $dir->getFilename()]) ?>">
						<?php echo $dir->getFilename() ?>
					</a>
				</li>
			<?php endforeach ?>
			</ul>
		</div>


		<div class="col-md-9">

		</div>
	</div>
</div>
