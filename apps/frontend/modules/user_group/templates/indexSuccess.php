<h3 class="list_title">Groups List</h3>

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
            href="<?php echo url_for('user_group/index?sort=NAME' . (($sort == "NAME" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Name</a><?php echo (($sort == "NAME") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Description</th>
        <?php } else { ?>

        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <?php }?>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($pager->getResults() as $sfGuardGroup): ?>
    <tr>
        <td><a
            href="<?php echo url_for('user_group/show?id=' . $sfGuardGroup->getId()) ?>"><?php echo $sfGuardGroup->getId() ?></a>
        </td>
        <td><?php echo $sfGuardGroup->getName() ?></td>
        <td><?php echo $sfGuardGroup->getDescription() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('user_group/show?id=') . $sfGuardGroup->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin')) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('user_group/edit?id=') . $sfGuardGroup->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'user_group/delete?id=' . $sfGuardGroup->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('user_group/new') ?>">
    <button class="btn btn-primary">New</button>
</a>
