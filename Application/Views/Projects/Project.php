<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Projects'));

$view['breadcrumb']->add($view['translator']->trans('Projects'), $view['router']->generate('projects'));

$view['titleTag']->add($project_id);

$view['breadcrumb']->add($project_id);

?>



<div class="container">
	<h1 class="h2"><i class="fa fa-folder-open"></i> <?php echo $project_id ?></h1>


	<p><i>wampi v2 feature...</i>
</div>
