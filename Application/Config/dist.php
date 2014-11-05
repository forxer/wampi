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

	# The application name
	'app_name' => 'LocalHost',

	# The application identifier (used internally)
	'app_id' => 'wampi',

	# Wampserver directory path
	'wampserver_dir' => 'c:\wamp',

	# Projects directories path
	'projects_dirs' => 'c:\wamp\www',

	# Enable/disable debug mode
	'debug' => false,

	# Database connexion configuration.
	'database.connection' => [
		'driver' 	=> 'pdo_sqlite',
		//'user' 		=> '',
		//'password' 	=> '',
		'path' 	    => __DIR__ . '/../Storage/Database/wampi.db'
	],

	# Controllers namespace name
	'routing.controllers_namespace' => 'Application\Controllers',
];
