<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

# Chargement  de l'autoload de composer
$loader = require __DIR__ . '/../vendor/autoload.php';

# Initialisation de l'application
$app = new Application\Application($loader);

# Exécution de l'application
$app->run();
