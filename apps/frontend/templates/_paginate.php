<div class="pagination" style="text-align: center;">
    <ul>
        <li><a href="<?php echo url_for($model . '/index?page=' . $pager->getFirstPage()) ?>"> << </a></li>

        <li><a href="<?php echo url_for($model . '/index?page=' . $pager->getPreviousPage()) ?>"> < </a></li>

        <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
            <li class="disabled"><a href="<?php echo url_for($model . '/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php else: ?>
            <li><a href="<?php echo url_for($model . '/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <li><a href="<?php echo url_for($model . '/index?page=' . $pager->getNextPage()) ?>"> > </a></li>

        <li><a href="<?php echo url_for($model . '/index?page=' . $pager->getLastPage()) ?>"> >> </a></li>
    </ul>
</div>