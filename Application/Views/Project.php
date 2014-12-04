<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('Projects'));

$view['breadcrumb']->add($view['translator']->trans('Projects'), $view['router']->generate('projects'));

$view['titleTag']->add($project['name']);

$view['breadcrumb']->add($project['name']);


?>

<div class="container">
    <h1><i class="fa fa-folder-open"></i> <?php echo $project['name'] ?></h1>

    <form action="<?php echo $view['router']->generate('project_process', ['path' => rawurlencode($project['path'])]) ?>" method="post" role="form">
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a aria-controls="tab-general" role="tab" data-toggle="tab" href="#tab-general"><?php echo $view['translator']->trans('project.tab.general') ?></a></li>
                <li role="presentation"><a aria-controls="tab-vhost" role="tab" data-toggle="tab" href="#tab-vhost"><?php echo $view['translator']->trans('project.tab.vhost') ?></a></li>
                <li role="presentation"><a aria-controls="tab-git" role="tab" data-toggle="tab" href="#tab-git"><?php echo $view['translator']->trans('project.tab.git') ?></a></li>
                <li role="presentation"><a aria-controls="tab-composer" role="tab" data-toggle="tab" href="#tab-composer"><?php echo $view['translator']->trans('project.tab.composer') ?></a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-general">
                    <h2><?php echo $view['translator']->trans('project.tab.general.title') ?></h2>
                    <div class="form-group">
                        <p><label for="project_name"><?php echo $view['translator']->trans('project.name') ?></label>
                        <?php echo $view['form']->text('project_name', 60, 255, $project['name'], 'form-control') ?></p>
                    </div>
                    <div class="form-group">
                        <p><label for="project_path"><?php echo $view['translator']->trans('project.path') ?></label>
                        <?php echo $view['form']->text('project_path', 60, 255, $project['path'], 'form-control') ?></p>
                    </div>
                </div><!-- #tab-general -->
                <div role="tabpanel" class="tab-pane fade" id="tab-vhost">
                    <h2><?php echo $view['translator']->trans('project.tab.vhost.title') ?></h2>
                    <div class="form-group">
                        <p><label for="project_name"><?php echo $view['translator']->trans('project.vhost.url') ?></label>
                        <?php echo $view['form']->text('project_name', 60, 255, 'foobar.local', 'form-control') ?></p>
                    </div>
                    <div class="form-group">
                        <p><label for="project_path"><?php echo $view['translator']->trans('project.vhost.path') ?></label>
                        <?php echo $view['form']->text('project_path', 60, 255, 'c:\wamp\www\bar', 'form-control') ?></p>
                    </div>
                </div><!-- #tab-vhost -->
                <div role="tabpanel" class="tab-pane fade" id="tab-git">
                    <h2><?php echo $view['translator']->trans('project.tab.git.title') ?></h2>
                    <div class="form-group">
                        <p><label for="project_path"><?php echo $view['translator']->trans('project.git.repository') ?></label>
                        <?php echo $view['form']->text('project_path', 60, 255, 'http://github.com/forxer/wampi', 'form-control') ?></p>
                    </div>
                </div><!-- #tab-composer -->
                <div role="tabpanel" class="tab-pane fade" id="tab-composer">
                    <h2><?php echo $view['translator']->trans('project.tab.composer.title') ?></h2>
                    <ul>
                        <li>dep 1</li>
                        <li>dep 2</li>
                        <li>dep 3</li>
                        <li>dep 4</li>
                    </ul>
                </div><!-- #tab-composer -->
            </div><!-- .tab-content -->
        </div>
        <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
    </form>
</div>
