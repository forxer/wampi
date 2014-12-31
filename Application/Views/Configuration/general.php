
<div role="tabpanel" class="tab-pane fade<?php if ($activePanel == 'general') echo ' in active' ?>" id="tab-general">
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
