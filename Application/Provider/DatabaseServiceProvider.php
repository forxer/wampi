<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['db.config'] = function() use ($app) {
            $config = new $app['class']['database.config']();

            if ($app['debug']) {
                $config->setSQLLogger($app['db.logger']);
            }

            return $config;
        };

        $app['db.logger'] = function() use ($app) {
            return new $app['class']['database.logger']();
        };

        $app['db'] = function() use ($app) {
            $connectionParams = [
                'driver'    => 'pdo_mysql',
                'host'      => $app['db_host'],
                'dbname'    => $app['db_name'],
                'user'      => $app['db_user'],
                'password'  => $app['db_password'],
                'charset'   => 'utf8'
            ];
            return $app['class']['database.driver_manager']::getConnection($connectionParams, $app['db.config']);
        };

        $app['qb'] = $app->factory(function ($app) {
            return new $app['class']['database.query_builder']($app['db']);
        });
    }
}
