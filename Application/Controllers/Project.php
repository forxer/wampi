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
        if (!file_exists(__DIR__ . '/../Config/installed')) {
            return $this->redirectToRoute('installation');
        }

        $projectPath = rawurldecode($this->app['request']->attributes->get('path'));

        if ($this->app['projects']->projectExistsInDb($projectPath))
        {
            $project = $this->app['projects']->getProjectFromDb($projectPath);
        }

        return $this->render('Project', [
            'project' => $project
        ]);
    }
}
