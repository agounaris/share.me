<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Client->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $Client->getName() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $Client->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Client->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Client->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<a href="<?php echo url_for('client/edit?id='.$Client->getId()) ?>"><button class="btn btn-primary">Edit</button></a>
&nbsp;
<a href="<?php echo url_for('client/index') ?>"><button class="btn btn-primary">List</button></a>

<div class="presentation" style="margin:20px;">
<?php 

foreach ($projects as $project) {
  # code...
  $imagesForProject = ImagePeer::retrieveImagesForProjectById( $project->getId() );

  $imageUrls = array();

  foreach ($imagesForProject as $image) {
    # code...
    array_push($imageUrls, $image->getImageFile());

  }
?>
<div class="project" style="width:150px;height:200px;float:left;margin:20px;">
  <a href="/content/client/id/<?php echo $Client->getId() ?>">
  <div class="thumb-container" style="width:150px; height:200px; overflow:hidden;">
    <img class="img-rounded" src="/uploads/images/<?php echo $imageUrls[0] ?>" />
  </div>

  <?php echo $project->getName() ?>
</div>

<?php } ?>
</div>

