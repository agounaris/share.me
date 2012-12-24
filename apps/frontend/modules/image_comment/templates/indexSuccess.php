<h1>ImageComments List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Image</th>
      <th>Comment</th>
      <th>Created by</th>
      <th>Updated at</th>
      <th>Created at</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ImageComments as $ImageComment): ?>
    <tr>
      <td><a href="<?php echo url_for('image_comment/show?id='.$ImageComment->getId()) ?>"><?php echo $ImageComment->getId() ?></a></td>
      <td><?php echo $ImageComment->getImageId() ?></td>
      <td><?php echo $ImageComment->getComment() ?></td>
      <td><?php echo $ImageComment->getCreatedBy() ?></td>
      <td><?php echo $ImageComment->getUpdatedAt() ?></td>
      <td><?php echo $ImageComment->getCreatedAt() ?></td>
        <td>
            <ul id="icons" class="pager ui-widget ui-helper-clearfix">
                <li title="Show" style="margin-right: 30px;"><a
                    href="<?php echo url_for('image_comment/show?id=') . $ImageComment->getId() ?>"><span
                    class="ui-icon ui-icon-search"></span></a></li>

                <?php if ($sf_user->hasCredential('admin')) { ?>
                <li title="Edit" style="margin-right: 30px;"><a
                    href="<?php echo url_for('image_comment/edit?id=') . $ImageComment->getId() ?>"><span
                    class="ui-icon ui-icon-pencil"></span></a></li>
                <li title="Delete"
                    style="margin-right: 30px;"><?php echo link_to('<span class="ui-icon ui-icon-trash"></span>', 'image_comment/delete?id=' . $ImageComment->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></a></li>
                <?php } ?>
            </ul>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('image_comment/new') ?>">New</a>
