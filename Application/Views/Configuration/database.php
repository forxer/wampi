
<div role="tabpanel" class="tab-pane fade<?php if ($activePanel == 'database') echo ' in active' ?>" id="tab-database">
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
