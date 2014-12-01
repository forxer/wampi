<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Controllers;

use Doctrine\DBAL\Schema\Schema;

class Installation extends BaseController
{
    protected $config;

    public function form()
    {
        if (null === $this->config) {
            $this->config = $this->app['configuration']->getCustomizableFieldsFromConfig();
        }

        return $this->render('Installation', [
            'config' => $this->config,
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

        # if error on validation, redirect to form
        if ($this->app['messages']->hasError())
        {
            # populate config values with collected data merged with current values
            $this->config = $validated + $this->app['configuration']->getCustomizableFieldsFromConfig();

            # return to form view
            return $this->form();
        }

        # update config values with collected data here and in the app
        $this->config = $validated;
        foreach ($this->config as $k=>$v) {
            $this->app[$k] = $v;
        }

        # save custom config values
        $this->app['configuration']->save($validated);

        # update db schema
        $conn = $this->app['db'];

        $newSchema = new Schema();
        $projects = $newSchema->createTable('projects');
        $projects->addColumn('path', 'string', ['length' => 255]);
        $projects->addColumn('name', 'string', ['length' => 255]);
        $projects->addColumn('vhost', 'boolean');
        $projects->addColumn('vhost_file', 'string', ['length' => 255]);
        $projects->addColumn('vhost_url', 'string', ['length' => 255]);
        $projects->addColumn('composer', 'boolean');
        $projects->addColumn('composer_content', 'text');
        $projects->setPrimaryKey(['path']);

        $sql = $conn->getSchemaManager()->createSchema()->getMigrateToSql(
            $newSchema, $conn->getDatabasePlatform());

        foreach ($sql as $query) {
            $conn->query($query);
        }

        # create an "installed" file
        file_put_contents(__DIR__ . '/../Config/installed', time());

        $this->app['flashMessages']->success($this->app['translator']->trans('install.success'));

        return $this->redirectToRoute('projects');
    }
}
