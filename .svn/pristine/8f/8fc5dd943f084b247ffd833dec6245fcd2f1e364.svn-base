<h3 class="list_title">Images List</h3>

<script type="text/javascript">

    $(function () {

        var deleteCheckbox = $('.delete-checkbox');

    });

</script>

<div id="image-pop-up" class="shadow"></div>

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
        <th>Image file</th>
        <th>Preview</th>
        <th><a
            href="<?php echo url_for('image/index?sort=PROJECT_ID' . (($sort == "PROJECT_ID" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Project</a><?php echo (($sort == "PROJECT_ID") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>
        <th>Created by</th>
        <th>Archived</th>
        <th>Updated at</th>
        <th><a
            href="<?php echo url_for('image/index?sort=CREATED_AT' . (($sort == "CREATED_AT" && !empty($sortType)) ? '&' . $sortType : '')) ?>"
            style="margin-right: 4px; float: left; ">Created at</a><?php echo (($sort == "CREATED_AT") ? "<span class=\"ui-icon $sortIcon\">&nbsp;</span>" : '') ?>
        </th>

    <?php } else { ?>
      <th>Id</th>
      <th>Image file</th>
      <th>Preview</th>
      <th>Project</th>
      <th>Created by</th>
      <th>Archived</th>
      <th>Updated at</th>
      <th>Created at</th>
        <?php }?>
        <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $Image): ?>
    <tr>
      <td><a href="<?php echo url_for('image/show?id='.$Image->getId()) ?>"><?php echo $Image->getId() ?></a></td>
      <td><?php echo $Image->getImageFile() ?></td>
      <td><img class="image-list-thumb" src="/uploads/images/<?php echo $Image->getImageFile() ?>" alt="" width="25px" height="30px"></td>
      <td><?php echo $Image->getProject()->getName() ?></td>
      <td><?php echo $Image->getsfGuardUser()->getUsername() ?></td>
      <td><?php echo ( $Image->getArchived() == 0 ) ? "No":"Yes" ?></td>
      <td><?php echo $Image->getUpdatedAt() ?></td>
      <td><?php echo $Image->getCreatedAt() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('image/show?id=') . $Image->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin')) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('image/edit?id=') . $Image->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'image/delete?id=' . $Image->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('image/new') ?>"><button class="btn btn-primary">New</button></a>
