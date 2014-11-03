<?php

$execTime = $app->utilities->getExecutionTime();

$mem = $app->utilities->getMemoryUsage();

$iNumQueries = 0;

$fExec = 0;

$queries = $app['db']->getConfiguration()->getSQLLogger()->queries;

foreach ($queries as $dbLog) {
	$iNumQueries++;
	$fExec += $dbLog['executionMS'];
}

?>

<div class="container">
	<div id="debug-panel" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" data-toggle="collapse" data-target="#debug">
				<a class="collapsed" data-toggle="collapse" href="#debug-body"><i class="fa"></i> Informations sur l’exécution de l’application</a>
				<span class="pull-right"><?php echo $view['modifier']->number($execTime, 4) ?> s - <?php echo $mem ?></span>
			</h3>
		</div>
		<div class="panel-body collapse" id="debug-body">
			<ul class="list-group">
				<li class="list-group-item">
					Temps d’exécution de l’application
					<strong class="pull-right <?php
					if ($execTime < 0.05) {
						echo 'text-success';
					}
					elseif ($execTime < 0.5) {
						echo 'text-info';
					}
					elseif ($execTime > 0.5 && $execTime < 1) {
						echo 'text-warning';
					}
					elseif ($execTime > 1) {
						echo 'text-danger';
					}
					?>"><?php echo $view['modifier']->number($execTime, 4) ?> s</strong>
				</li>
				<li class="list-group-item">
					Temps d’execution des requêtes à la base de données
					<strong class="pull-right <?php
					if ($fExec < 0.005) {
						echo 'text-success';
					}
					elseif ($fExec < 0.05) {
						echo 'text-info';
					}
					elseif ($fExec > 0.05 && $fExec < 0.1) {
						echo 'text-warning';
					}
					elseif ($fExec > 0.1) {
						echo 'text-danger';
					}
					?>"><?php echo $view['modifier']->number($fExec, 4) ?> s</strong>
				</li>
				<li class="list-group-item">
					Nombre total de requêtes à la base de données
					<strong class="pull-right <?php
					if ($fExec < 5) {
						echo 'text-success';
					}
					elseif ($fExec < 10) {
						echo 'text-info';
					}
					elseif ($fExec > 10 && $fExec < 20) {
						echo 'text-warning';
					}
					elseif ($fExec > 20) {
						echo 'text-danger';
					}
					?>"><?php echo $iNumQueries ?></strong>
				</li>
				<li class="list-group-item">
					Quantité de mémoire utilisée par l’application
					<strong class="pull-right <?php
					if ($fExec < 5) {
						echo 'text-success';
					}
					elseif ($fExec < 10) {
						echo 'text-info';
					}
					elseif ($fExec > 10 && $fExec < 20) {
						echo 'text-warning';
					}
					elseif ($fExec > 20) {
						echo 'text-danger';
					}
					?>"><?php echo $mem ?></strong>
				</li>
				<li class="list-group-item">
					Version PHP <strong class="pull-right"><?php echo PHP_VERSION ?></strong></li>
				</li>
			</ul>

			<ul class="list-group">
				<li class="list-group-item">
					Route <code>$app['request']->attributes->get('_route')</code>
					<strong class="pull-right"><?php echo $app['request']->attributes->get('_route') ?></strong>
				</li>
				<li class="list-group-item">
					Controller <code>$app['request']->attributes->get('_controller')</code>
					<strong class="pull-right"><?php echo $app['request']->attributes->get('_controller') ?></strong>
				</li>
				<li class="list-group-item">
					Controller class <code>$app['request']->attributes->get('controller_class')</code>
					<strong class="pull-right"><?php echo $app['request']->attributes->get('controller_class') ?></strong>
				</li>
				<li class="list-group-item">
					Controller method <code>$app['request']->attributes->get('controller_method')</code>
					<strong class="pull-right"><?php echo $app['request']->attributes->get('controller_method') ?></strong>
				</li>
			</ul>

			<?php if ($iNumQueries > 0) : ?>
			<table class="table table-striped" role="grid">
				<thead>
					<tr>
						<th scope="col">Requête</th>
						<th scope="col">Temps d’execution</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($queries as $dbLog) : ?>
					<tr>
						<td><?php echo SqlFormatter::format($dbLog['sql']) ?></td>
						<td><?php echo $view['modifier']->number($dbLog['executionMS'], 4) ?> s</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php endif ?>
		</div><!-- .panel-body -->
	</div><!-- .panel -->
</div>
