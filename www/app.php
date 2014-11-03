<?php
/*
 * This file is part of myTinyLocalHost.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

# Chargement  de l'autoload de composer
$loader = require __DIR__ . '/../vendor/autoload.php';

# Chargement de la configuration de l'application
$config_filename = __DIR__ . '/../Application/Config/config.php';
if (file_exists($config_filename)) {
	$config = require $config_filename;
}
else {
	$config = require __DIR__ . '/../Application/Config/dist.php';
}

# Initialisation de l'application
$app = new Application\Application($loader, $config);

# Exécution de l'application
$app->run();
