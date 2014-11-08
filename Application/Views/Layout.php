<?php

$view['titleTag']->add($app['app_name'], true);

$view['breadcrumb']->add($app['app_name'], $view['router']->generate('projects'), true);

?><!DOCTYPE html>
<html lang="<?php echo $app['session']->getLanguage() ?>">
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php echo $view->render('Layout/Favicon') ?>

	<title><?php echo $view->escape($view['titleTag']->get(' - ')) ?></title>

	<link rel="stylesheet" type="text/css" href="/min/g=css">

	<!--[if lt IE 9]>
	<script src="<?php echo $view['assets']->getUrl('html5shiv/dist/html5shiv.min.js', 'components') ?>"></script>
	<script src="<?php echo $view['assets']->getUrl('respond/dest/respond.min.js', 'components') ?>"></script>
	<![endif]-->

	<?php $view['slots']->output('head') ?>
</head>
<body>
	<header id="main-header">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu">
						<span class="sr-only"><?php echo $view['translator']->trans('Menu') ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo $view['router']->generate('projects') ?>"><i class="fa fa-lg fa-desktop"></i>
					<?php echo $app['app_name'] ?></a>
				</div>

				<div class="collapse navbar-collapse" id="main-menu">
					<ul class="nav navbar-nav">
						<li<?php if (in_array($app['request']->attributes->get('_route'), ['projects','project'])) : ?> class="active"<?php endif ?>>
							<a href="<?php echo $view['router']->generate('projects') ?>"><?php
							echo $view['translator']->trans('Projects') ?></a>
						</li>
						<li<?php if ($app['request']->attributes->get('_route') == 'information') : ?> class="active"<?php endif ?>>
							<a href="<?php echo $view['router']->generate('information') ?>"><?php
							echo $view['translator']->trans('Information') ?></a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> <?php
							echo $view['translator']->trans('Tools') ?> <span class="caret"></span></a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="http://localhost/phpmyadmin/" target="_blank">phpMyAdmin</a></li>
								<li><a href="http://localhost/sqlbuddy/" target="_blank">SQL Buddy</a></li>
								<li><a href="http://localhost/phpsysinfo/" target="_blank">phpSysInfo</a></li>
								<li><a href="http://localhost/webgrind/" target="_blank">webgrind</a></li>
							</ul>
						</li>
						<li class="dropdown">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i> <?php
							echo $view['translator']->trans('Language') ?> <span class="caret"></span></a>

							<ul class="dropdown-menu" role="menu">
								<?php foreach ($app['translator.locales'] as $localeCode => $localeTitle) : ?>
								<li<?php if ($localeCode === $app['session']->getLanguage()) : ?> class="active"<?php endif ?>><a href="<?php
								echo $view['router']->generate('language', ['locale' => $localeCode]) ?>"><?php echo $localeTitle ?></a></li>
								<?php endforeach ?>
							</ul>
						</li>
						<li<?php if ($app['request']->attributes->get('_route') == 'configuration') : ?> class="active"<?php endif ?>>
							<a href="<?php echo $view['router']->generate('configuration') ?>"><i class="fa fa-cog"></i> <?php
							echo $view['translator']->trans('Configuration') ?></a>
						</li>
					</ul>
				</div><!-- #main-menu -->
			</div><!-- .container-fluid -->
		</nav>
		<div id="main-breadcrumb" class="container">
			<?php echo $view->render('Layout/Breadcrumb') ?>
		</div><!-- #main-breadcrumb -->

		<div id="main-messages" class="container">
		<?php # Affichage des éventuels messages
		echo $view->render('Common/messages') ?>
		</div><!-- #main-messages -->

	</header><!-- #main-header -->

	<section id="content">
		<?php # Affichage du contenu principal de la page
		$view['slots']->output('_content') ?>

	</section><!-- #content -->

	<footer id="main-footer" class="container text-center">
		<small><?php echo sprintf($view['translator']->trans('Powered by wampi'), $app::URL, $app::VERSION) ?></small>
	</footer><!-- #main-footer -->

	<script type="text/javascript" src="/min/g=js"></script>

	<?php $view['slots']->output('script') ?>

	<?php # Affichage des informations sur l'exécution de l'application
	if ($app['debug']) : ?>
		<?php echo $view->render('Layout/DebugInfos') ?>
	<?php endif ?>
</body>
</html>
