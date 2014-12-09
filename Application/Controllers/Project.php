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

        # if project is not store in DB, store it now, immediatly
        if (!$this->project['in_db']) {
            return $this->addProject();
        }

        return $this->render('Project', [
            'project' => $this->project
        ]);
    }

    public function process()
    {
        $this->setProject();

        $this->project['name'] = $this->app['request']->request->get('name');
        $this->project['vhost_url'] = $this->app['request']->request->get('vhost_url');
        $this->project['vhost_file'] = $this->app['request']->request->get('vhost_file');

        $this->app['db']->update(
            'projects',
            [
                'name' => $this->project['name']
            ],
            [
                'path' => $this->projectPath
            ]
        );

        $this->app['flashMessages']->success($this->app['translator']->trans('project.success'));

        return $this->redirectToRoute('project', ['path' => rawurlencode($this->projectPath)]);
    }

    protected function addProject()
    {
        // retrieve project data

        // store project data
        $this->app['db']->insert(
            'projects',
            [
                'path' => $this->projectPath,
                'name' => $this->project['name']
            ]
        );

        // redirect to project stored
        $this->app['flashMessages']->success($this->app['translator']->trans('project.added'));

        return $this->redirectToRoute('project', ['path' => rawurlencode($this->projectPath)]);
    }

    protected function setProject()
    {
        $this->projectPath = rawurldecode($this->app['request']->attributes->get('path'));

        if (null === $this->project)
        {
            $this->project = [];

            if ($this->app['project']->projectExistsInDb($this->projectPath))
            {
                $this->project = $this->app['project']->getProjectFromDatabase($this->projectPath);

                $this->project['in_db'] = true;
            }
            else {
                $this->project['in_db'] = false;
            }

            $this->project += $this->app['project']->getProjectFromDirectories($this->projectPath);
        }
    }
}
