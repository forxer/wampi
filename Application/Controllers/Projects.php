<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Controllers;

class Projects extends BaseController
{
	public function projectsList()
	{

		return $this->render('Projects/List', [
			'projectsList' => $this->app['projects']->getList()
		]);
	}
}
