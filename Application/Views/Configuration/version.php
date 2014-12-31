
<div role="tabpanel" class="tab-pane fade<?php if ($activePanel == 'version') echo ' in active' ?>" id="tab-version">
    <h2><?php echo $view['translator']->trans('config.tab.version.title') ?></h2>

    <div>
        <a href="<?php echo $view['router']->generate('update_switch_releases_type') ?>" class="btn btn-primary"><?php
        if ($app['pre_releases_update']) : ?>
        <?php echo $view['translator']->trans('config.check.stables.release') ?>
        <?php else : ?>
        <?php echo $view['translator']->trans('config.check.dev.release') ?>
        <?php endif ?>
        </a>
    </div>

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
