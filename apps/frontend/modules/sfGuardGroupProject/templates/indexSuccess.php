<h1>SfGuardGroupProjects List</h1>

<table>
  <thead>
    <tr>
      <th>Group</th>
      <th>Client</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($SfGuardGroupProjects as $SfGuardGroupProject): ?>
    <tr>
      <td><a href="<?php echo url_for('sfGuardGroupProject/show?group_id='.$SfGuardGroupProject->getGroupId().'&client_id='.$SfGuardGroupProject->getClientId()) ?>"><?php echo $SfGuardGroupProject->getGroupId() ?></a></td>
      <td><a href="<?php echo url_for('sfGuardGroupProject/show?group_id='.$SfGuardGroupProject->getGroupId().'&client_id='.$SfGuardGroupProject->getClientId()) ?>"><?php echo $SfGuardGroupProject->getClientId() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sfGuardGroupProject/new') ?>">New</a>
