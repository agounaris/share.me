<h1>SfGuardGroups List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($SfGuardGroups as $SfGuardGroup): ?>
    <tr>
      <td><a href="<?php echo url_for('sfGuardGroup/show?id='.$SfGuardGroup->getId()) ?>"><?php echo $SfGuardGroup->getId() ?></a></td>
      <td><?php echo $SfGuardGroup->getName() ?></td>
      <td><?php echo $SfGuardGroup->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sfGuardGroup/new') ?>">New</a>
