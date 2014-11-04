<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

class Projects
{
	protected $app;

	protected $list;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function getList()
	{
		if (null === $this->list)
		{
			$this->list = $this->app['finder']
				->directories()
				->in($this->app['wampserver.www.dir'])
				->depth('== 0');
		}

		return $this->list;
	}

}
