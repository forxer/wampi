<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Controllers;

class Project extends BaseController
{
	public function project()
	{

		return $this->render('Projects/Project', [
			'projectsList' => $this->app['projects']->getList()
		]);
	}
}
