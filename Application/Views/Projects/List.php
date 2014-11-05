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
					<a href="<?php echo $view['router']->generate('project', ['id' => basename($dir)]) ?>">
						<?php echo basename($dir) ?>
					</a><br>
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

