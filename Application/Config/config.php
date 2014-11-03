<?php
/*
 * Customize configuration in this file.
 *
 */

$config = [

	# Enable/disable debug mode
	'debug' 				=> true,

	# Wampserver www directory path
	'wampserver.www.dir' => 'e:\www',

];


# DO NOT EDIT BELLOW
$distConfig = require __DIR__ . '/dist.php';

return $config + $distConfig;
