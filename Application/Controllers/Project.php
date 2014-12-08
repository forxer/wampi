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
    protected $projectPath;

    protected $project;

    public function project()
    {
        # not installed ?
        if (!$this->isInstalled()) {
            return $this->redirectToRoute('installation');
        }
        # need an update ?
        elseif (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }

        $this->setProject();

        return $this->render('Project', [
            'project' => $this->project
        ]);
    }

    public function process()
    {
        $this->setProject();

        $this->project['name'] = $this->app['request']->request->get('name');

        if ($this->project['in_db'])
        {
            $this->app['db']->update(
                'projects',
                [
                    'name' => $this->project['name']
                ],
                [
                    'path' => $this->projectPath
                ]
            );
        }
        else
        {
            $this->app['db']->insert(
                'projects',
                [
                    'path' => $this->projectPath,
                    'name' => $this->project['name']
                ]
            );
        }

        $this->app['flashMessages']->success($this->app['translator']->trans('project.success'));

        return $this->redirectToRoute('project', ['path' => rawurlencode($this->projectPath)]);
    }

    protected function setProject()
    {
        $this->projectPath = rawurldecode($this->app['request']->attributes->get('path'));

        if (null === $this->project)
        {
            $this->project = [];

            if ($this->app['projects']->projectExistsInDb($this->projectPath))
            {
                $this->project = $this->app['projects']->getProjectFromDatabase($this->projectPath);

                $this->project['in_db'] = true;
            }
            else {
                $this->project['in_db'] = false;
            }

            $this->project += $this->app['projects']->getProjectFromDirectories($this->projectPath);
        }
    }
}
