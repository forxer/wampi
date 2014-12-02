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
        # need an update ?
        if (!$this->isUpToDate()) {
            return $this->redirectToRoute('update');
        }
        # or allready installed ?
        if ($this->isInstalled()) {
            return $this->redirectToRoute('projects');
        }

        if (null === $this->config) {
            $this->config = $this->app['configuration']->getCustomizableFieldsFromConfig();
        }

        return $this->render('Installation', [
            'config' => $this->config,
        ]);
    }

    public function process()
    {
        if (!$this->handleRequestConfigValues()) {
            return $this->form();
        }

        $this->createDatabaseIfNotExists();

        $this->databaseSchema();

        $this->installedFile();

        $this->app['flashMessages']->success($this->app['translator']->trans('install.success'));

        return $this->redirectToRoute('projects');
    }

    protected function handleRequestConfigValues()
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

        # live update of config values with validated data
        $this->config = $validated;
        foreach ($this->config as $k => $v) {
            $this->app[$k] = $v;
        }

        # save custom config values
        $this->app['configuration']->save($validated);

        return true;
    }

    protected function createDatabaseIfNotExists()
    {
        $connectionParams = [
            'driver'    => 'pdo_mysql',
            'host'      => $this->app['db_host'],
            'user'      => $this->app['db_user'],
            'password'  => $this->app['db_password'],
            'charset'   => 'utf8'
        ];

        $driverClass = $this->app['class']['database.driver_manager'];

        $conn = $driverClass::getConnection($connectionParams, $this->app['db.config']);

        $databases = $conn->getSchemaManager()->listDatabases();

        if (!in_array($this->app['db_name'], $databases)) {
            $conn->query('CREATE DATABASE `' . $this->app['db_name'] . '`');
        }
    }

    protected function databaseSchema()
    {
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
    }

    protected function installedFile()
    {
        file_put_contents(self::$installedFile, $this->app->getVersion());
    }
}
