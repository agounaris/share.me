<h3 class="list_title">Archived Projects</h3>

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
            href="<?php echo url_for('project/index?sort=CLIENT_ID' . (($sort == "CLIENT_ID" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Client</a><?php echo (($sort == "CLIENT_ID") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th><a
            href="<?php echo url_for('project/index?sort=NAME' . (($sort == "NAME" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Name</a><?php echo (($sort == "NAME") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Created by</th>
        <th><a
            href="<?php echo url_for('project/index?sort=ARCHIVED' . (($sort == "ARCHIVED" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Archived</a><?php echo (($sort == "ARCHIVED") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Updated at</th>
        <th>Created at</th>

        <?php } else { ?>

        <th>Id</th>
        <th>Client</th>
        <th>Name</th>
        <th>Created by</th>
        <th>Archived</th>
        <th>Updated at</th>
        <th>Created at</th>
        <?php }?>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($pager->getResults() as $Project): ?>
    <tr>
        <td><a href="<?php echo url_for('project/show?id=' . $Project->getId()) ?>"><?php echo $Project->getId() ?></a>
        </td>
        <td><?php echo $Project->getClient()->getName()  ?></td>
        <td><?php echo $Project->getName() ?></td>
        <td><?php echo $Project->getsfGuardUser()->getUsername() ?></td>
        <td><?php echo ($Project->getArchived() == 0) ? "No" : "<a class='archive-link' title='Click here to activate the project.' href='".url_for('project/unarchiveit')."?id=".$Project->getId()."'>Yes</a>" ?></td>
        <td><?php echo $Project->getUpdatedAt() ?></td>
        <td><?php echo $Project->getCreatedAt() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('project/show?id=') . $Project->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin') || $sf_user->hasCredential('manage_project') ) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('project/edit?id=') . $Project->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'project/delete?id=' . $Project->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('project/index') ?>">
    <button class="btn btn-primary">Back to all</button>
</a>
