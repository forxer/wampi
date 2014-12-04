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
        # not installed ?
        if (!$this->isInstalled()) {
            return $this->redirectToRoute('installation');
        }
        elseif (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }

        $projectPath = rawurldecode($this->app['request']->attributes->get('path'));

        $project = [];

        if ($this->app['projects']->projectExistsInDb($projectPath))
        {
            $project = $this->app['projects']->getProjectFromDatabase($projectPath);
        }

        $project += $this->app['projects']->getProjectFromDirectories($projectPath);

        return $this->render('Project', [
            'project' => $project
        ]);
    }
}
