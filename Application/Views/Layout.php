<?php

$view['titleTag']->add($app['app.name'], true);

$view['breadcrumb']->add($view['translator']->trans('Home'), $view['router']->generate('home'), true);

?><!DOCTYPE html>
<html lang="<?php echo $app['session']->getLanguage() ?>">
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
					<a class="navbar-brand" href="<?php echo $view['router']->generate('home') ?>"><?php echo $app['app.name'] ?></a>
				</div>

				<div class="collapse navbar-collapse" id="main-menu">
					<ul class="nav navbar-nav">
						<li<?php if ($app['request']->attributes->get('_route') == 'home') : ?> class="active"<?php endif ?>>
							<a href="<?php echo $view['router']->generate('home') ?>"><?php
							echo $view['translator']->trans('Home') ?></a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li<?php if ($app['request']->attributes->get('_route') == 'configuration') : ?> class="active"<?php endif ?>>
							<a href="<?php echo $view['router']->generate('configuration') ?>"><i class="fa fa-cog"></i> <?php
							echo $view['translator']->trans('Configuration') ?></a>
						</li>
						<li class="dropdown">

							<?php foreach ($app['translator.locales'] as $localeCode => $localeTitle) : ?>
							<?php if ($localeCode == $app['session']->getLanguage()) : ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $localeTitle ?> <span class="caret"></span></a>
							<?php endif ?>
							<?php endforeach ?>


							<ul class="dropdown-menu" role="menu">
								<?php foreach ($app['translator.locales'] as $localeCode => $localeTitle) : ?>
								<?php if ($localeCode != $app['session']->getLanguage()) : ?>
								<li><a href="<?php echo $localeCode ?>"><?php echo $localeTitle ?></a></li>
								<?php endif ?>
								<?php endforeach ?>
							</ul>
						</li>
					</ul>
				</div><!-- #main-menu -->
			</div><!-- .container-fluid -->
		</nav>
		<div id="main-breadcrumb" class="container">
			<?php echo $view->render('Layout/Breadcrumb') ?>
		</div><!-- #main-breadcrumb -->
	</header><!-- #main-header -->

	<div id="main-messages">
	<?php echo $view->render('Common/messages') ?>
	</div><!-- #main-messages -->

	<section id="content">

		<div id="main-messages">
		<?php # Affichage des éventuels messages
		echo $view->render('Common/messages') ?>
		</div><!-- #main-messages -->

		<?php # Affichage du contenu principal de la page
		$view['slots']->output('_content') ?>

	</section><!-- #content -->

	<footer id="main-footer" class="container text-center">
		Copyright <?php echo date('Y') ?>
	</footer><!-- #main-footer -->

	<script type="text/javascript" charset="utf8" src="/min/g=js"></script>

	<?php $view['slots']->output('script') ?>

	<?php # Affichage des informations sur l'exécution de l'application
	if ($app['debug']) : ?>
		<?php echo $view->render('Layout/DebugInfos') ?>
	<?php endif ?>
</body>
</html>
