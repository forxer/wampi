<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application;

class Project
{
    protected $app;

    protected $project = [
        'path' => null,
        'name' => null,
        'vhost' => false,
        'vhost_file' => null,
        'vhost_url' => null,
        'composer' => false,
        'composer_content' => null
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getProjectFromDirectories($projectPath)
    {
        $project = $this->project;

        if (file_exists($projectPath))
        {
            $project['path'] = $projectPath;
            $project['name'] = basename($projectPath);
        }

        return $project;
    }

    public function getProjectFromDatabase($projectPath)
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
