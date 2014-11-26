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

$view['titleTag']->add($project_id);

$view['breadcrumb']->add($project_id);

?>



<div class="container">
    <h1 class="h2"><i class="fa fa-folder-open"></i> <?php echo $project_id ?></h1>


    <p><i>wampi v2 feature...</i>
</div>
