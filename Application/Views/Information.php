<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Information'));

$view['breadcrumb']->add($view['translator']->trans('Information'), $view['router']->generate('information'));

?>

<div class="container">
    <h1 class="h2"><?php echo $view['translator']->trans('Information') ?></h1>

    <div class="row">
        <div class="col-xs-6">
            <h2 class="h3"><?php echo $view['translator']->trans('infos.versions') ?> <small></small></h2>
            <ul class="list-group">
                <li class="list-group-item"><?php echo $view['translator']->trans('infos.php.version') ?>
                <span class="badge"><?php echo $phpVersion ?></span></li>
                <li class="list-group-item"><?php echo $view['translator']->trans('infos.apache.version') ?>
                <span class="badge"><?php echo $apacheVersion ?></span></li>
                <li class="list-group-item"><?php echo $view['translator']->trans('infos.mysql.version') ?>
                <span class="badge"><?php echo $mysqlVersion ?></span></li>
                <li class="list-group-item"><?php echo $view['translator']->trans('infos.wampserver.version') ?>
                <span class="badge"><?php echo $wampserverVersion ?></span></li>
            </ul>
        </div>
        <div class="col-xs-6">
            <h2 class="h3"><?php echo $view['translator']->trans('infos.docs') ?> <small></small></h2>
            <div class="list-group">
                <a class="list-group-item" href="<?php echo $view['translator']->trans('infos.php.doc.url') ?>" target="_blank"><?php
                echo $view['translator']->trans('infos.php.doc') ?></a>
                <a class="list-group-item" href="<?php echo $view['translator']->trans('infos.apache.doc.url') ?>" target="_blank"><?php
                echo $view['translator']->trans('infos.apache.doc') ?></a>
                <a class="list-group-item" href="<?php echo $view['translator']->trans('infos.mysql.doc.url') ?>" target="_blank"><?php
                echo $view['translator']->trans('infos.mysql.doc') ?></a>
                <a class="list-group-item" href="<?php echo $view['translator']->trans('infos.wampserver.doc.url') ?>" target="_blank"><?php
                echo $view['translator']->trans('infos.wampserver.doc') ?></a>
            </div>
        </div>
    </div>

    <h2 class="h3"><?php echo $view['translator']->trans('infos.php.loaded.extensions') ?></h2>

    <ul class="row list-unstyled">
        <?php foreach ($phpExtensions as $extension) : ?>
        <li class="col-xs-6 col-md-3">
            <i class="fa fa-fw fa-puzzle-piece"></i>
            <?php echo $extension ?>
        </li>
        <?php endforeach ?>
    </ul>
</div>
