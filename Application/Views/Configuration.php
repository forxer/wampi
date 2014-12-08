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
                <li role="presentation"><a aria-controls="tab-version" role="tab" data-toggle="tab" href="#tab-version">
                    <?php if ($uptodate) : ?>
                        <i class="fa fa-check text-success"></i>
                    <?php else : ?>
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                    <?php endif ?>
                    <?php echo $view['translator']->trans('config.tab.version') ?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-general">
                    <h2><?php echo $view['translator']->trans('config.tab.general.title') ?></h2>
                    <div class="form-group">
                        <p><label for="app_name"><?php echo $view['translator']->trans('config.app.name') ?></label>
                        <?php echo $view['form']->text('app_name', 60, 255, $config['app_name'], 'form-control') ?></p>
                    </div>

                    <p><?php if ($app['debug']) : ?>
                    <a href="<?php echo $view['router']->generate('configuration_switch_debug') ?>" class="btn btn-danger"><i class="fa fa-cogs"></i> <?php
                    echo $view['translator']->trans('config.disable.debug') ?></a></p>
                    <?php else : ?>
                    <a href="<?php echo $view['router']->generate('configuration_switch_debug') ?>" class="btn btn-warning"><i class="fa fa-cogs"></i> <?php
                    echo $view['translator']->trans('config.enable.debug') ?></a></p>
                    <?php endif ?>

                    <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
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
                    <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
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
                    <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-version">
                    <h2><?php echo $view['translator']->trans('config.tab.version.title') ?></h2>

                    <div class="row">
                        <div class="col-sm-6">
                            <h3><?php echo $view['translator']->trans('config.your.version', ['%release%' => $app->getVersion()]) ?></h3>
                            <?php if ($uptodate) : ?>
                                <p><i class="fa fa-check text-success"></i> <?php echo $view['translator']->trans('config.your.version.uptodate') ?></p>
                            <?php else : ?>
                                <p><i class="fa fa-exclamation-triangle text-danger"></i> <?php echo $view['translator']->trans('config.your.version.expired') ?></p>
                                <p><a href="<?php echo $latestRelease['assets'][0]['browser_download_url']?>" class="btn btn-success"><i class="fa fa-download"></i>
                                <?php echo $view['translator']->trans('config.download.latest.release') ?></a></p>
                            <?php endif ?>

                            <p><a href="<?php echo $view['router']->generate('update_switch_releases_type') ?>" class="btn btn-primary"><?php
                            if ($app['pre_releases_update']) : ?>
                            <?php echo $view['translator']->trans('config.check.stables.release') ?>
                            <?php else : ?>
                            <?php echo $view['translator']->trans('config.check.dev.release') ?>
                            <?php endif ?></a></p>
                        </div>
                        <div class="col-sm-6">
                            <h3><?php echo $view['translator']->trans('config.latest.release', ['%release%' => $latestRelease['name']]) ?></h3>

                            <ul class="fa-ul">
                                <?php if (isset($latestRelease['assets'][0]) && strpos($latestRelease['assets'][0]['browser_download_url'], '.zip')) : ?>
                                <li><strong><i class="fa-li fa fa-download"></i><?php echo $view['translator']->trans('config.tab.latest.release.zip', ['%url%' => $latestRelease['assets'][0]['browser_download_url']]) ?></strong></li>
                                <?php endif ?>
                                <li><i class="fa-li fa fa-github"></i><?php echo $view['translator']->trans('config.tab.latest.release.show.github', ['%url%' => $latestRelease['html_url']]) ?></li>
                                <li><i class="fa-li fa fa-file-archive-o"></i><?php echo $view['translator']->trans('config.latest.release.sources', ['%zip%' => $latestRelease['zipball_url'], '%tar%' => $latestRelease['tarball_url']]) ?></li>
                            </ul>
                        </div>
                    </div><!-- .row -->
                </div><!-- #tab-version -->
            </div><!-- .tab-content -->
        </div><!-- .tabpanel -->
    </form>

</div>
