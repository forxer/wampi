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

    protected $listFromDatabase;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getProjects()
    {
        if (null == $this->projects)
        {
            $filesProjects = $this->getProjectsFromDirectories();
            $dbProjects = $this->getProjectsFromDatabase();

            $projects = $dbProjects + $filesProjects;

            foreach ($projects as $path => $project)
            {
                $lower_name = strtolower($project['name']);

                $projects[$path] = [
                    'lower_name' => $lower_name,
                    'first_letter' => $lower_name[0]
                ] + $project;
            }

            usort($projects , function($a, $b){
                return strnatcmp($a['lower_name'], $b['lower_name']);
            });

            $this->projects = array_values($projects);
        }

        return $this->projects;
    }

    public function getProjectsFirstLetters()
    {
        $firstLettersList = [];

        foreach ($this->getProjects() as $project) {
            $firstLettersList[] = $project['first_letter'];
        }

        $firstLettersList = array_unique($firstLettersList);

        natsort($firstLettersList);

        return $firstLettersList;
    }

    protected function getProjectsFromDirectories()
    {
        if (null === $this->listFromDirectories)
        {
            $this->listFromDirectories = [];

            $finder = $this->app['finder']
                ->directories()
                ->depth('== 0')
            ;

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
                $path = $finded->getRealpath();

                $this->listFromDirectories[$path] = [
                    'path' => $path,
                    'name' => $finded->getFilename(),
                    'in_db' => false
                ];
            }
        }

        return $this->listFromDirectories;
    }

    protected function getProjectsFromDatabase()
    {
        if (null === $this->listFromDatabase)
        {
            $projects = $this->app['db']->fetchAll('SELECT * FROM projects');

            $this->listFromDatabase = [];

            foreach ($projects as $project)
            {
                $project['in_db'] = true;

                $this->listFromDatabase[$project['path']] = $project;
            }
        }

        return $this->listFromDatabase;
    }

    public function getProjectFromDb($projectPath)
    {
        return $this->app['db']->fetchAssoc(
            'SELECT * FROM projects WHERE path = :path',
            [ 'path' => $projectPath ]
        );
    }

    public function projectExistsInDb($projectPath)
    {
        return (boolean)$this->app['db']->fetchColumn(
            'SELECT COUNT(path) FROM projects WHERE path = :path',
            [ 'path' => $projectPath ]
        );
    }
}
