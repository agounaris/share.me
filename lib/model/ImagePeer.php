<?php


/**
 * Skeleton subclass for performing query and update operations on the 'image' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Sep 24 15:47:53 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ImagePeer extends BaseImagePeer {

    public static function retrieveImagesForProjectById($projectId){
        $c = new Criteria();
        $c->add(ImagePeer::PROJECT_ID, $projectId);
        $c->add(ImagePeer::ARCHIVED, 0);
        $c->addDescendingOrderByColumn(ImagePeer::PROJECT_ID);
        $v = ImagePeer::doSelect($c);
        return $v;
    }

} // ImagePeer
