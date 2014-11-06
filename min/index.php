<?php

$min_customConfigPaths = [
	'base'   => __DIR__ . '/config.php',
	'groups' => __DIR__ . '/groupsConfig.php'
];

require __DIR__ . '/../vendor/mrclay/minify/min/index.php';
