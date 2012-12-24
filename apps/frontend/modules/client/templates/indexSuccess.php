<h3 class="list_title">Clients List</h3>

<?php if ($sf_user->hasFlash('notice')): ?>
<div class="alert alert-success">
    <strong>Success!</strong> <?php echo $sf_user->getFlash('notice') ?>
</div>
<?php endif; ?>

<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('global/paginate', array('pager' => $pager, 'model' => $this->getModuleName())) ?>
<?php endif ?>

<table class="table-striped">
    <thead>
    <tr style="text-align: left;">

        <?php if ($pager->count() > 0) { ?>
        <th>Id</th>
        <th><a
            href="<?php echo url_for('client/index?sort=NAME' . (($sort == "NAME" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Name</a><?php echo (($sort == "NAME") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Created by</th>
        <th>Updated at</th>
        <th><a
            href="<?php echo url_for('client/index?sort=CREATED_AT' . (($sort == "CREATED_AT" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Created at</a><?php echo (($sort == "CREATED_AT") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>

        <?php } else { ?>
        <th>Id</th>
        <th>Name</th>
        <th>Created by</th>
        <th>Updated at</th>
        <th>Created at</th>
        <?php }?>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($pager->getResults() as $Client): ?>
    <tr>
        <td><a href="<?php echo url_for('client/show?id=' . $Client->getId()) ?>"><?php echo $Client->getId() ?></a>
        </td>
        <td><?php echo $Client->getName() ?></td>
        <td><?php echo $Client->getCreatedBy() ?></td>
        <td><?php echo $Client->getUpdatedAt() ?></td>
        <td><?php echo $Client->getCreatedAt() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('client/show?id=') . $Client->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin')) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('client/edit?id=') . $Client->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'project/delete?id=' . $Client->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('client/new') ?>">
    <button class="btn btn-primary">New</button>
</a>
