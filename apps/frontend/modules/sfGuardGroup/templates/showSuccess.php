<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $SfGuardGroup->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $SfGuardGroup->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $SfGuardGroup->getDescription() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('sfGuardGroup/edit?id='.$SfGuardGroup->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sfGuardGroup/index') ?>">List</a>
