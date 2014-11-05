<?php
/*
 * This file is part of wampi.
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

		return $this->getListFromDirectories();
	}

	private function getListFromDirectories()
	{
		if (null === $this->list)
		{
			$this->list = [];

			$finder = $this->app['finder']
				->directories()
				->depth('== 0');

			foreach (explode(PATH_SEPARATOR, $this->app['projects_dirs']) as $dir)
			{
				if (!is_dir($dir))
				{
					$this->app['persistentMessages']->error(
						sprintf($this->app['translator']->trans('error.missing.www'), $this->app['projects_dirs'])
					);

					continue;
				}

				$finder->in($dir);
			}

			foreach ($finder as $finded) {
				$this->list[] = $finded->getRealpath();
			}
		}

		return $this->list;
	}

}
