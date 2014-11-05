<?php

$view->extend('Layout');

?>


<?php $view['slots']->start('script') ?>
<script type="text/javascript">
$('.visit-project').tooltip();
</script>
<?php $view['slots']->stop() ?>

<div class="container">
	<div class="row">
		<?php foreach ($projectsList as $dir) : ?>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">

					<i class="fa fa-folder"></i>
					<a href="<?php echo $view['router']->generate('project', ['id' => basename($dir)]) ?>">
						<?php echo basename($dir) ?>
					</a>

					<a href="" class="pull-right visit-project" target="_blank" data-toggle="tooltip" title="<?php
					echo $view['translator']->trans('visit %site%', ['%site%' => basename($dir)]) ?>">
						<i class="fa fa-lg fa-external-link"></i>
						<span class="sr-only"><?php echo $view['translator']->trans('visit') ?></span>
					</a>
				</div>
				<div class="panel-body">

					<small class="text-muted"><?php echo $dir ?></small>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>

<?php


$db = $app['db'];

/*
$sql =
'CREATE TABLE projects(
	path            TEXT PRIMARY KEY,
	name            TEXT    NOT NULL,
	scanned         DATETIME
);';

$db->query($sql);


foreach ($projectsList as $dir)
{
	$db->insert('projects', array(
		'path' => $dir,
		'name' =>  basename($dir),
		'scanned' => date('Y-m-d H:i:s')
	));
}

*/

