
<div role="tabpanel" class="tab-pane fade<?php if ($activePanel == 'paths') echo ' in active' ?>" id="tab-paths">
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
