<?php
//var_dump($clientId);
$projects = ProjectPeer::retrieveProjectsForClient($clientId);
?>

<div style="margin: 0 auto;margin-top:10px;text-align: center;">
    <div id="up-button" class="buttons" style="cursor:pointer;cursor:hand;width:100px;<?php echo (count($projects)<12)? 'display:none;':'' ?>">
        Up
    </div>
</div>
<div class="presentation" style="margin:10px;height:480px;overflow:auto;float:left;">
    <?php

    foreach ($projects as $project) {
        # code...
        $imagesForProject = ImagePeer::retrieveImagesForProjectById($project->getId());

        $imageUrls = array();

        foreach ($imagesForProject as $image) {
            # code...
            array_push($imageUrls, $image->getImageFile());

        }

        $numberOfImages = count($imageUrls);
        ?>
        <div class="project" style="width:150px;height:200px;float:left;margin:20px;">
            <a href="/content/campaign/id/<?php echo $project->getId() ?><?php echo (strpos($project->getUrl(), 'http') !== false) ? "?url=1" : ""  ?>">

                <div class="thumb-container" style="width:150px; height:200px; overflow:hidden;float:left;">
                    <div><img class="img-rounded" src="/uploads/images/<?php echo $imageUrls[$numberOfImages - 1] ?>"/>
                    </div>
                </div>

                <?php echo (strlen($project->getName()) > 24) ? substr($project->getName(), 0, 20) . '..' : $project->getName(); ?>
            </a>
        </div>

        <?php } ?>


</div>

<div style="margin: 0 auto;text-align: center;">
    <div id="down-button" class="buttons" style="cursor:pointer;cursor:hand;width:100px;<?php echo (count($projects)<12)? 'display:none;':'' ?>">Down</div>
</div>