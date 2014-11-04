<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Controllers;

class Configuration extends BaseController
{
	public function form()
	{


		return $this->render('Configuration', [
		]);
	}

	public function process()
	{
		$config = [
			'app_name' => $this->app['request']->request->get('app_name'),
			'wampserver_www_dir' => $this->app['request']->request->get('wampserver_www_dir'),
			'debug' => $this->app['request']->request->get('debug'),
		];

		$validated = $this->app['configuration']->validate($config);

		if (empty($validated) || $this->app['messages']->hasError())
		{
			return $this->form();
		}

		$this->app['configuration']->save($validated);

		$this->app['flashMessages']->success('youpi');

		return $this->redirectToRoute('configuration');
	}
}
