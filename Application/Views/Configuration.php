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
            <?php foreach ($panels as $panel) : ?>
            <li role="presentation" class="<?php if ($activePanel == $panel['id']) echo 'active' ?>">
                <a aria-controls="tab-<?php echo $panel['id'] ?>" role="tab" data-toggle="tab" href="#tab-<?php echo $panel['id'] ?>">
                <?php echo $panel['title'] ?>
                </a>
            </li>
            <?php endforeach ?>
            </ul>
            <div class="tab-content">
            <?php foreach ($panels as $panel) : ?>
                <?php echo $panel['content'] ?>
            <?php endforeach ?>
            </div><!-- .tab-content -->
        </div><!-- .tabpanel -->
    </form>
</div>
