<table>
  <tbody>
    <tr>
      <th>Group:</th>
      <td><?php echo $SfGuardGroupProject->getGroupId() ?></td>
    </tr>
    <tr>
      <th>Client:</th>
      <td><?php echo $SfGuardGroupProject->getClientId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('sfGuardGroupProject/edit?group_id='.$SfGuardGroupProject->getGroupId().'&client_id='.$SfGuardGroupProject->getClientId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sfGuardGroupProject/index') ?>">List</a>
