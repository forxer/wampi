<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Information'));

$view['breadcrumb']->add($view['translator']->trans('Information'), $view['router']->generate('information'));

?>

<div class="container">
	<h1 class="h2"><?php echo $view['translator']->trans('Information') ?></h1>

	<h2 class="h3"><?php echo $view['translator']->trans('infos.versions') ?> <small></small></h2>

	<div class="row">
		<div class="col-xs-6">
			<ul class="list-group">
				<li class="list-group-item"><?php echo $view['translator']->trans('infos.php.version') ?>
				<span class="badge"><?php echo $phpVersion ?></span></li>
				<li class="list-group-item"><?php echo $view['translator']->trans('infos.apache.version') ?>
				<span class="badge"><?php echo $apacheVersion ?></span></li>
				<li class="list-group-item"><?php echo $view['translator']->trans('infos.mysql.version') ?>
				<span class="badge"><?php echo $mysqlVersion ?></span></li>
				<li class="list-group-item"><?php echo $view['translator']->trans('infos.wampserver.version') ?>
				<span class="badge"><?php echo $wampserverVersion ?></span></li>
			</ul>
		</div>
		<div class="col-xs-6">

		</div>
	</div>

	<h2 class="h3"><?php echo $view['translator']->trans('infos.php.loaded.extensions') ?></h2>

	<ul class="row list-unstyled">
		<?php foreach ($phpExtensions as $extension) : ?>
		<li class="col-xs-6 col-md-3">
			<i class="fa fa-fw fa-puzzle-piece"></i>
			<?php echo $extension ?>
		</li>
		<?php endforeach ?>
	</ul>
</div>
