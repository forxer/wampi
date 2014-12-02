<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$view->extend('Layout');

$view['titleTag']->add($view['translator']->trans('update.title'));

$view['breadcrumb']->add($view['translator']->trans('update.title'), $view['router']->generate('update'));

?>

<div class="container">
    <h1><?php echo $view['translator']->trans('update.title') ?></h1>

    <form action="<?php echo $view['router']->generate('update_process') ?>" method="post" role="form">

        <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('update.finalize.update') ?></button></p>
    </form>
</div><!-- .container -->
