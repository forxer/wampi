<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

#===========================================================
#
# 	/!\ WARNING
#
# 	Do not edit configuration data below,
# 	use the config.php dedicated files instead.
#
#===========================================================

return [

	# Wampserver www directory path
	'wampserver_www_dir' => 'c:\wamp\www',

	# The application name
	'app_name' => 'LocalHost',

	# The application identifier (used internally)
	'app_id' => 'wampi',

	# Enable/disable debug mode
	'debug' => false,

	# Database connexion configuration.
	'database.connection' => [
		'driver' 	=> 'pdo_mysql',
		'host' 		=> 'localhost',
		'dbname' 	=> 'wampi',
		'user' 		=> 'root',
		'password' 	=> '',
		'charset' 	=> 'utf8'
	],

	# Controllers namespace name
	'routing.controllers_namespace' => 'Application\Controllers',
];
