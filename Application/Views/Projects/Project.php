<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Projects'));

$view['breadcrumb']->add($view['translator']->trans('Projects'), $view['router']->generate('projects'));

?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
			<?php foreach ($projects_list as $project) : ?>
				<li class="list-group-item">

					<?php if ($project_id == $project->getFilename()) : ?>
					<i class="fa fa-folder-open"></i>
					<?php else : ?>
					<i class="fa fa-folder"></i>
					<?php endif ?>

					<a href="<?php echo $view['router']->generate('project', ['id' => $project->getFilename()]) ?>">
						<?php echo $project->getFilename() ?>
					</a>

					<?php if ($project_id == $project->getFilename()) : ?>
					<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					<?php endif ?>
				</li>
			<?php endforeach ?>
			</ul>
		</div>


		<div class="col-md-9">

		</div>
	</div>
</div>
