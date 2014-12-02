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

        $latestRelease = $this->getLatestRelease();

        return $this->render('Configuration', [
            'config' => $this->config,
            'latestRelease' => $latestRelease,
            'uptodate' => version_compare($this->app->getVersion(), $latestRelease['tag_name'], '>=')
        ]);
    }

    public function process()
    {
        # populate an array with request values
        $newConfig = [];
        foreach ($this->app['configuration']->getCustomizableFieldsNames() as $fieldName) {
            $newConfig[$fieldName] =  $this->app['request']->request->get($fieldName);
        }

        # validate values
        $validated = $this->app['configuration']->validate($newConfig);

        # if no value or error on validation, redirect to form
        if (empty($validated) || $this->app['messages']->hasError())
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

    protected function getLatestRelease()
    {
        $client = new GithubClient(
            new GithubCache(['cache_dir' => $this->app->utilities->getApplicationPath() . '/Storage/Cache/Github'])
        );

        $releases = $client->api('repo')->releases()->all('forxer', 'wampi');

        # remove pre-release
        foreach ($releases as $k => $v) {
            if ($v['prerelease']) {
                unset($releases[$k]);
            }
        }

        # sort release by published date
        usort($releases, function($a, $b){
            return (strtotime($a['published_at']) > strtotime($b['published_at'])) ? -1 : 1;
        });

        return $releases[0];
    }
}
