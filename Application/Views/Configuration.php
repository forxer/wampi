<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Configuration'));

$view['breadcrumb']->add($view['translator']->trans('Configuration'), $view['router']->generate('configuration'));

?>

<div class="container">
	<h1 class="h2"><?php echo $view['translator']->trans('Configuration') ?></h1>

	<form action="<?php echo $view['router']->generate('configuration_process') ?>" method="post" role="form">
		<div class="form-group">
			<label for="app_name"><?php echo $view['translator']->trans('config.app.name') ?></label>
			<?php echo $view['form']->text('app_name', 60, 255, $config['app_name'], 'form-control') ?>
		</div>
		<div class="form-group">
			<label for="wampserver_dir"><?php echo $view['translator']->trans('config.wampserver.dir') ?></label>
			<?php echo $view['form']->text('wampserver_dir', 60, 255, $config['wampserver_dir'], 'form-control') ?>
		</div>
		<div class="form-group">
			<label for="wampserver_www_dir"><?php echo $view['translator']->trans('config.wampserver.www.dir') ?></label>
			<?php echo $view['form']->text('wampserver_www_dir', 60, 255, $config['wampserver_www_dir'], 'form-control') ?>
		</div>
		<div class="checkbox">
			<label>
				<?php echo $view['form']->checkbox('debug', true, $config['debug']) ?> <?php echo $view['translator']->trans('config.enable.debug') ?>
			</label>
		</div>
		<button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button>
	</form>

</div>
