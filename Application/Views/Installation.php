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

<div class="container">
    <h1><?php echo $view['translator']->trans('install.title') ?></h1>

    <form action="<?php echo $view['router']->generate('installation_process') ?>" method="post" role="form">
        <h2><?php echo $view['translator']->trans('config.tab.paths.title') ?></h2>
        <div class="form-group">
            <p><label for="wampserver_dir"><?php echo $view['translator']->trans('config.wampserver.dir') ?></label>
            <?php echo $view['form']->text('wampserver_dir', 60, 255, $config['wampserver_dir'], 'form-control') ?></p>
        </div>
        <div class="form-group">
            <p><label for="projects_dirs"><?php echo $view['translator']->trans('config.projects.dirs') ?></label>
            <?php echo $view['form']->textarea('projects_dirs', 60, 2, $config['projects_dirs'], 'form-control') ?>
            <span class="help-block"><?php echo sprintf($view['translator']->trans('config.projects.dirs.note'), PATH_SEPARATOR) ?></span></p>
        </div>

        <h2><?php echo $view['translator']->trans('config.tab.db.title') ?></h2>
        <div class="form-group">
            <p><label for="db_host"><?php echo $view['translator']->trans('config.db.host') ?></label>
            <?php echo $view['form']->text('db_host', 60, 255, $config['db_host'], 'form-control') ?></p>
        </div>
        <div class="form-group">
            <p><label for="db_name"><?php echo $view['translator']->trans('config.db.name') ?></label>
            <?php echo $view['form']->text('db_name', 60, 255, $config['db_name'], 'form-control') ?></p>
        </div>
        <div class="form-group">
            <p><label for="db_user"><?php echo $view['translator']->trans('config.db.user') ?></label>
            <?php echo $view['form']->text('db_user', 60, 255, $config['db_user'], 'form-control') ?></p>
        </div>
        <div class="form-group">
            <p><label for="db_password"><?php echo $view['translator']->trans('config.db.password') ?></label>
            <?php echo $view['form']->text('db_password', 60, 255, $config['db_password'], 'form-control') ?></p>
        </div>
        <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
    </form>
</div><!-- .container -->
