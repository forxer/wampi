<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('install.title'));

$view['breadcrumb']->add($view['translator']->trans('install.title'), $view['router']->generate('installation'));

?>
