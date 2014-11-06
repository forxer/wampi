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

	protected $projects;

	protected $listFromDirectories;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function getProjects()
	{
		if (null == $this->projects)
		{
			$projects = $this->getProjectsFromDirectories();

			usort ($projects , function($a, $b){
				return strnatcmp($a['lower_name'], $b['lower_name']);
			});

			$this->projects = array_values($projects);
		}

		return $this->projects;
	}

	public function getProjectsFirstLetters()
	{
		$firstLettersList = [];

		foreach ($this->getProjectsFromDirectories() as $project) {
			$firstLettersList[] = $project['first_letter'];
		}

		$firstLettersList = array_unique($firstLettersList);

		natsort($firstLettersList);

		return $firstLettersList;
	}

	public function getProjectsFromDirectories()
	{
		if (null === $this->listFromDirectories)
		{
			$this->listFromDirectories = [];

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

			foreach ($finder as $finded)
			{
				$name = $finded->getFilename();
				$lower_name = strtolower($name);

				$this->listFromDirectories[] = [
					'path' => $finded->getRealpath(),
					'name' => $name,
					'lower_name' => $lower_name,
					'first_letter' => $lower_name[0]
				];
			}
		}

		return $this->listFromDirectories;
	}

}
