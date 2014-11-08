<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

class Project extends BaseController
{
	public function project()
	{
		$projectId = $this->app['request']->attributes->get('id');

		return $this->render('Projects/Project', [
			'project_id' => $projectId

		]);
	}
}
