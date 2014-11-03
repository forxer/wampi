
	<?php # affichage des éventuels messages d'erreurs
	if ($app['messages']->hasError()) :
		echo $view->render('Common/message', [
			'type'        => 'danger',
			'messages'    => $app['messages']->getError()
		]);
	endif; ?>

	<?php # affichage des éventuels messages d'avertissements
	if ($app['messages']->hasWarning()) :
		echo $view->render('Common/message', [
			'type'        => 'warning',
			'messages'    => $app['messages']->getWarning()
		]);
	endif; ?>

	<?php # affichage des éventuels messages de confirmation
	if ($app['messages']->hasSuccess()) :
		echo $view->render('Common/message', [
			'type'        => 'success',
			'messages'    => $app['messages']->getSuccess()
		]);
	endif; ?>

	<?php # affichage des éventuels messages d'information
	if ($app['messages']->hasInfo()) :
		echo $view->render('Common/message', [
			'type'        => 'info',
			'messages'    => $app['messages']->getInfo()
		]);
	endif; ?>
