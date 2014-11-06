<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Projects'));

$view['breadcrumb']->add($view['translator']->trans('Projects'), $view['router']->generate('projects'));

$view['titleTag']->add($project_id);

$view['breadcrumb']->add($project_id);

?>

<div class="container">
	<div class="row">
		<div class="col-md-9 col-md-push-3">
			<h1 class="h2"><?php echo $project_id ?></h1>

		</div>
		<div class="col-md-3 col-md-pull-9">
			<ul class="list-group">
			<?php foreach ($projects_list as $project) : ?>
				<li class="list-group-item">

					<?php if ($project_id == $project['name']) : ?>
					<i class="fa fa-folder-open"></i>
					<?php else : ?>
					<i class="fa fa-folder"></i>
					<?php endif ?>

					<a href="<?php echo $view['router']->generate('project', ['id' => $project['name']]) ?>">
						<?php echo $project['name'] ?>
					</a>

					<?php if ($project_id == $project['name']) : ?>
					<span class="pull-right"><i class="fa fa-chevron-right"></i></span>
					<?php endif ?>
				</li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
