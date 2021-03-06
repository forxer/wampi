<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

class Projects extends BaseController
{
    public function projectsList()
    {
        # not installed ?
        if (!$this->isInstalled()) {
            return $this->redirectToRoute('installation');
        }
        elseif (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }

        return $this->render('Projects', [
            'vhosts' => $this->app['virtualhosts']->getVirtualHosts(),
            'projectsList' => $this->app['projects']->getProjects(),
            'projectsFirstLetters' => $this->app['projects']->getProjectsFirstLetters(),
        ]);
    }
}
