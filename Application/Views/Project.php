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

        <h2>Configuration</h2>
        <div class="form-group">
            <p><label for="project_name"><?php echo $view['translator']->trans('project.name') ?></label>
            <?php echo $view['form']->text('project_name', 60, 255, $project['name'], 'form-control') ?></p>
        </div>

        <h2>Virtual host</h2>

            <ul>
                <li>bar.local</li>
                <li>c:\wamp\www\bar</li>
            </ul>

        <h2>Composer</h2>

            <ul>
                <li>dep 1</li>
                <li>dep 2</li>
                <li>dep 3</li>
                <li>dep 4</li>
            </ul>

        <h2>GIT</h2>

            <ul>
                <li>Repository : http://github.com/forxer/wampi</li>
            </ul>

        <h2>SVN</h2>

            <p>...</p>

        <h2>Laravel</h2>

            <p>...</p>

        <h2>Symphony</h2>

            <p>...</p>

        <p><button type="submit" class="btn btn-primary"><?php echo $view['translator']->trans('Save') ?></button></p>
    </form>
</div>
