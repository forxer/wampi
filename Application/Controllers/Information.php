<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

class Information extends BaseController
{
    public function infos()
    {
        # not installed ?
        if (!$this->isInstalled()) {
            return $this->redirectToRoute('installation');
        }
        elseif (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }

        return $this->render('Information', [
            'apacheVersion' => $this->app['informations']->getApacheVersion(),
            'mysqlVersion' => $this->app['informations']->getMysqlVersion(),
            'wampserverVersion' => $this->app['informations']->getWampserverVersion(),
            'phpVersion' => $this->app['informations']->getPhpVersion(),
            'phpVersion' => $this->app['informations']->getPhpVersion(),
            'phpExtensions' => $this->app['informations']->getPhpExtensions()
        ]);
    }
}
