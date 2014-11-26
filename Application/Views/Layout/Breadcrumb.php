<?php
/*
 * This file is part of wampi.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>

<?php if ($view['breadcrumb']->getNumItems() > 1) : ?>
<ul class="breadcrumb">
<?php foreach ($view['breadcrumb']->getAll() as $breadcrumbItem) : ?>
    <li<?php if ($breadcrumbItem['isLast']) : ?> class="active"<?php endif ?>>
        <?php if ($breadcrumbItem['isLast']) : ?>
        <?php echo $view->escape($breadcrumbItem['label']) ?>
        <?php else : ?>
        <a href="<?php echo $view->escape($breadcrumbItem['url']) ?>"><?php echo $view->escape($breadcrumbItem['label']) ?></a>
        <?php endif ?>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
