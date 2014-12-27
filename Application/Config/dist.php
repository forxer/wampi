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

    # Relative path to the application URL from the hostname.
    # The value should always begin and end with a slash.
    #
    # ex.:
    # 	http://domain.tld 			: '/'
    # 	http://domain.tld/app 		: '/app/'
    # 	http://sub.domain.tld 		: '/'
    # 	http://sub.domain.tld/test 	: '/test/'
    # 	etc.
    'app_url' => '/',

    # Relative path to the assets URL
    # from the app_url configuration (see above).
    'assets_url' => 'Assets',

    # Relative path to the components URL
    # from the app_url configuration (see above).
    'components_url' => 'bower_components',

    # Database connexion configuration.
    'db_host'       => 'localhost',
    'db_name'       => 'wampi',
    'db_user' 		=> 'root',
    'db_password' 	=> '',

    # Search or not for pre-release update
    'pre_releases_update' => false,

    # Controllers namespace name
    'routing.controllers_namespace' => 'Application\Controllers',

    'vhosts_cache_ttl' => 3600
];
