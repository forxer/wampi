<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Controllers;

class Home extends BaseController
{
	public function home()
	{
		$wwwDirectoriesList = $this->app['finder']
			->directories()
			->in($this->app['wampserver.www.dir'])
			->depth('== 0');

		return $this->render('Home', [
			'wwwDirectoriesList' => $wwwDirectoriesList
		]);
	}
}
