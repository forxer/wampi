<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Configuration'));

$view['breadcrumb']->add($view['translator']->trans('Configuration'), $view['router']->generate('configuration'));

?>

<div class="container">
    <h1><?php echo $view['translator']->trans('Configuration') ?></h1>

    <form action="<?php echo $view['router']->generate('configuration_process') ?>" method="post" role="form">
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a aria-controls="tab-general" role="tab" data-toggle="tab" href="#tab-general"><?php echo $view['translator']->trans('config.tab.general') ?></a></li>
                <li role="presentation"><a aria-controls="tab-path" role="tab" data-toggle="tab" href="#tab-path"><?php echo $view['translator']->trans('config.tab.paths') ?></a></li>
                <li role="presentation"><a aria-controls="tab-database" role="tab" data-toggle="tab" href="#tab-database"><?php echo $view['translator']->trans('config.tab.db') ?></a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-general">
                    <h2><?php echo $view['translator']->trans('config.tab.general.title') ?></h2>
                    <div class="form-group">
                        <p><label for="app_name"><?php echo $view['translator']->trans('config.app.name') ?></label>
                        <?php echo $view['form']->text('app_name', 60, 255, $config['app_name'], 'form-control') ?></p>
                    </div>
                    <div class="form-group btn-group" data-toggle="buttons">
                        <label class="btn btn-warning<?php if (!empty($config['debug'])) : ?> active<?php endif ?>">
                            <input type="checkbox" name="debug" id="debug" value="1" autocomplete="off"<?php if (!empty($config['debug'])) : ?> checked="checked"<?php endif ?>>
                            <i class="fa fa-cogs"></i> <?php if (!empty($config['debug'])) : ?><?php echo $view['translator']->trans('config.disable.debug') ?><?php else : ?><?php echo $view['translator']->trans('config.enable.debug') ?><?php endif ?>
                        </label>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-path">
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
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-database">
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
                </div>
            </div>
        </div>
        <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
    </form>

</div>
