<?php slot('body_id') ?>class="users" id="users-index"<?php end_slot(); ?>
<div><h3 class="list_title">Users List</h3></div>

<?php if ($sf_user->hasFlash('notice')): ?>
<div class="alert alert-success">
    <strong>Success!</strong> <?php echo $sf_user->getFlash('notice') ?>
</div>
<?php endif; ?>

<?php if ($pager->haveToPaginate()): ?>
<?php include_partial('global/paginate', array('pager' => $pager, 'model' => $this->getModuleName())) ?>
<?php endif ?>

<table>
  <thead>
    <tr style="text-align:left;">
        <?php if ($pager->count() > 0) { ?>

        <th>Id</th>
        <th><a
            href="<?php echo url_for('user/index?sort=USERNAME' . (($sort == "USERNAME" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Username</a><?php echo (($sort == "USERNAME") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th><a
            href="<?php echo url_for('user/index?sort=CREATED_AT' . (($sort == "CREATED_AT" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Created at</a><?php echo (($sort == "CREATED_AT") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th><a
            href="<?php echo url_for('user/index?sort=LAST_LOGIN' . (($sort == "LAST_LOGIN" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Last login</a><?php echo (($sort == "LAST_LOGIN") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Is active</th>
        <th>Is super admin</th>

    <?php } else { ?>
      <th>Id</th>
      <th>Username</th>
      <th>Created at</th>
      <th>Last login</th>
      <th>Is active</th>
      <th>Is super admin</th>
        <?php }?>
        <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($pager->getResults() as $sfGuardUser): ?>
    <tr>
      <td><a href="<?php echo url_for('user/show?id='.$sfGuardUser->getId()) ?>"><?php echo $sfGuardUser->getId() ?></a></td>
      <td><?php echo $sfGuardUser->getUsername() ?></td>
      <td><?php echo $sfGuardUser->getCreatedAt() ?></td>
      <td><?php echo $sfGuardUser->getLastLogin() ?></td>
      <td><?php echo $sfGuardUser->getIsActive() ?></td>
      <td><?php echo $sfGuardUser->getIsSuperAdmin() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('user/show?id=') . $sfGuardUser->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin')) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('user/edit?id=') . $sfGuardUser->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'user/delete?id=' . $sfGuardUser->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('user/new') ?>">
    <button class="btn btn-primary">New</button>
</a>
