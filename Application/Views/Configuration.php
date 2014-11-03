<?php

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Configuration'));

$view['breadcrumb']->add($view['translator']->trans('Configuration'), $view['router']->generate('configuration'));

?>

<div class="container">

	<form role="form">
		<div class="form-group">
			<label for="app.name"><?php echo $view['translator']->trans('config.app.name') ?></label>
			<?php echo $view['form']->text('app.name', 60, 255, $app['app.name'], 'form-control') ?>
		</div>
		<div class="form-group">
			<label for="wampserver.www.dir"><?php echo $view['translator']->trans('config.wampserver.www.dir') ?></label>
			<?php echo $view['form']->text('wampserver.www.dir', 60, 255, $app['wampserver.www.dir'], 'form-control') ?>
		</div>
		<div class="checkbox">
			<label>
				<?php echo $view['form']->checkbox('debug', true, $app['debug']) ?> <?php echo $view['translator']->trans('config.enable.debug') ?>
			</label>
		</div>
		<button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button>
	</form>

</div>
