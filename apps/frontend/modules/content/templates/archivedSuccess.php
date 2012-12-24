<div class="presentation" style="margin:20px;">
    <?php

    //var_dump($clientId);
    $projects = ProjectPeer::retrieveArchivedProjectsForClient( $clientId );

    foreach ($projects as $project) {
        # code...
        $imagesForProject = ImagePeer::retrieveImagesForProjectById( $project->getId() );

        $imageUrls = array();

        foreach ($imagesForProject as $image) {
            # code...
            array_push($imageUrls, $image->getImageFile());

        }
        
       	$numberOfImages = count($imageUrls);
        ?>
        <div class="project" style="width:150px;height:200px;float:left;margin:20px;">
            <a href="/project/show/id/<?php echo $project->getId() ?><?php echo (strpos($project->getUrl(), 'http') !== false ) ? "?url=1":""  ?>">
            
                <div class="thumb-container" style="width:150px; height:200px; overflow:hidden;float:left;">

                    <div><img class="img-rounded" src="/uploads/images/<?php echo $imageUrls[$numberOfImages-1] ?>" /></div>

                </div>

                <?php echo $project->getName() ?>
            </a>
        </div>

        <?php } ?>
</div>