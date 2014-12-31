<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

use Github\Client as GithubClient;
use Github\HttpClient\CachedHttpClient as GithubCache;

class Configuration extends BaseController
{
    protected $config;

    public function form()
    {
        # not installed ?
        if (!$this->isInstalled()) {
            return $this->redirectToRoute('installation');
        }
        elseif (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }

        if (null === $this->config) {
            $this->config = $this->app['configuration']->getCustomizableFieldsFromConfig();
        }

        $latestRelease = $this->getLatestRelease($this->app['pre_releases_update']);

        $uptodate = version_compare($this->app->getVersion(), $latestRelease['tag_name'], '>=');

        $activePanel = $this->app['request']->query->get('tab', 'general');

        $tplData = [
            'config' => $this->config,
            'latestRelease' => $latestRelease,
            'uptodate' => $uptodate,
            'activePanel' => $activePanel
        ];

        $panels = new \ArrayObject([
            10 => [
                'id' => 'general',
                'title' => $this->app['translator']->trans('config.tab.general'),
                'content' => $this->renderView('Configuration/general', $tplData)
            ],
            20 => [
                'id' => 'paths',
                'title' => $this->app['translator']->trans('config.tab.paths'),
                'content' => $this->renderView('Configuration/paths', $tplData)
            ],
            30 => [
                'id' => 'database',
                'title' => $this->app['translator']->trans('config.tab.db'),
                'content' => $this->renderView('Configuration/database', $tplData)
            ],
            40 => [
                'id' => 'version',
                'title' => ($uptodate ? '<i class="fa fa-check text-success"></i> ' : '<i class="fa fa-exclamation-triangle text-danger"></i> ') . $this->app['translator']->trans('config.tab.version'),
                'content' => $this->renderView('Configuration/version', $tplData)
            ]
        ]);

        $tplData['panels'] = $panels;

        return $this->render('Configuration', $tplData);
    }

    public function process()
    {
        # populate an array with request values
        $newConfig = [];
        foreach ($this->app['configuration']->getCustomizableFieldsNames() as $fieldName) {
            $newConfig[$fieldName] = $this->app['request']->request->get($fieldName);
        }

        # validate values
        $validated = $this->app['configuration']->validate($newConfig);

        # if error on validation, redirect to form
        if ($this->app['messages']->hasError())
        {
            # populate config values with collected data merged with current values
            $this->config = $validated + $this->app['configuration']->getCustomizableFieldsFromConfig();

            # return to form view
            return $this->form();
        }

        # save custom values, success message and redirect to form
        $this->app['configuration']->save($validated);

        $this->app['flashMessages']->success($this->app['translator']->trans('config.success'));

        return $this->redirectToRoute('configuration');
    }

    public function switchDebug()
    {
        $validated = $this->app['configuration']->validate([
            'debug' => $this->app['debug'] ? false : true
        ]);

        $this->app['configuration']->save($validated);

        return $this->redirectToRoute('configuration');
    }

    protected function getLatestRelease($bPreReleases = false)
    {
        $client = new GithubClient(
            new GithubCache(['cache_dir' => $this->app->utilities->getApplicationPath() . '/Storage/Cache/Github'])
        );

        $releases = $client->api('repo')->releases()->all('Tao-php', 'wampi');

        if (!$bPreReleases)
        {
            # remove pre-releases from list
            foreach ($releases as $k => $v)
            {
                if ($v['prerelease']) {
                    unset($releases[$k]);
                }
            }
        }

        # sort release by published date
        usort($releases, function($a, $b){
            return (strtotime($a['published_at']) > strtotime($b['published_at'])) ? -1 : 1;
        });

        return $releases[0];
    }
}
