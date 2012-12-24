<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Image->getId() ?></td>
    </tr>
    <tr>
      <th>Image file:</th>
      <td><?php echo $Image->getImageFile() ?></td>
    </tr>
    <tr>
      <th>Project:</th>
      <td><?php echo $Image->getProjectId() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $Image->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Image->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Image->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<a href="<?php echo url_for('image/edit?id='.$Image->getId()) ?>"><button class="btn btn-primary">Edit</button></a>
&nbsp;
<a href="<?php echo url_for('image/index') ?>"><button class="btn btn-primary">List</button></a>
