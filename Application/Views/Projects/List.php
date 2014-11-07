<?php

$view->extend('Layout');

?>

<?php $view['slots']->start('script') ?>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('mixitup/build/jquery.mixitup.min.js', 'components') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('select2/select2_locale_' . $app['session']->getLanguage() . '.js', 'components') ?>"></script>
<script type="text/javascript">

//$('.visit-project').tooltip();

$(document).ready(function() {
	$("#select-project").select2({
		placeholder: "<?php echo $view['translator']->trans('Search') ?>"
	});

	$("#select-project").on("select2-selecting", function(e) {
		window.location.href = e.val;
	});

	$('#projects').mixItUp({
		selectors: {
			target: '.project',
			filter: '.filter-btn',
			sort: '.sort-btn'
		},
		load: {
			sort: 'order:asc'
		}
	});
});
</script>
<?php $view['slots']->stop() ?>


<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-10">
			<p class="btn-group btn-group-sm">
				<button type="button" class="btn btn-default filter-btn" data-filter="all"><?php echo $view['translator']->trans('All') ?></button>
				<?php foreach ($projectsFirstLetters  as $letter) : ?>
				<button type="button" class="btn btn-default filter-btn" data-filter=".first-letter-<?php echo $letter ?>"><?php echo strtoupper($letter) ?></button>
				<?php endforeach ?>
			</p>
			<!--
			<div class="btn-group btn-group-sm">
				<button type="button" class="btn btn-default sort-btn" data-sort="order:asc"><i class="fa fa-sort-alpha-asc"></i>
				<span class="sr-only"><?php echo $view['translator']->trans('Ascending') ?></span></button>
				<button type="button" class="btn btn-default sort-btn" data-sort="order:desc"><i class="fa fa-sort-alpha-desc"></i>
				<span class="sr-only"><?php echo $view['translator']->trans('Descending') ?></span></button>
			</div>
			-->
		</div>
		<div class="col-sm-3 col-md-2 form-group pull-right">
			<p><select id="select-project" name="project" class="form-control" style="width: 100%">
			<option></option>
			<?php foreach ($projectsList as $i => $project) : ?>
				<option value="<?php echo $view['router']->generate('project', ['id' => $project['name']]) ?>"><?php echo $project['name'] ?></option>
			<?php endforeach ?>
			</select></p>
		</div>
	</div>
	<hr>
</div>
<div class="container">
	<div class="row" id="projects">
		<?php foreach ($projectsList as $i => $project) : ?>
		<div class="project first-letter-<?php echo $project['first_letter'] ?> col-xs-6 col-sm-4 col-md-3" data-order="<?php echo $i ?>">
			<div class="panel panel-default">
				<div class="panel-heading">

					<i class="fa fa-folder"></i>
					<a href="<?php echo $view['router']->generate('project', ['id' => $project['name']]) ?>">
						<?php echo $project['name'] ?>
					</a>

					<a href="#" class="pull-right visit-project" target="_blank" data-toggle="tooltip" title="<?php
					echo $view['translator']->trans('visit %site%', ['%site%' => $project['name']]) ?>">
						<i class="fa fa-lg fa-external-link"></i>
						<span class="sr-only"><?php echo $view['translator']->trans('visit') ?></span>
					</a>
				</div>
				<div class="panel-body">

					<small class="text-muted"><?php echo $project['path'] ?></small>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>

<?php

/*
$db = $app['db'];

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

