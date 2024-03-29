<?php


/**
 * Skeleton subclass for performing query and update operations on the 'project' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Sep 24 15:47:52 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ProjectPeer extends BaseProjectPeer {

	public static function retrieveProjectsForClient($clientId){
        $c = new Criteria();
        $c->add(ProjectPeer::CLIENT_ID, $clientId);
        $c->add(ProjectPeer::ARCHIVED, 0);
        $c->addDescendingOrderByColumn(ProjectPeer::CLIENT_ID);
        $v = ProjectPeer::doSelect($c);
        return $v;
    }

    public static function retrieveArchivedProjectsForClient($clientId){
        $c = new Criteria();
        $c->add(ProjectPeer::CLIENT_ID, $clientId);
        $c->add(ProjectPeer::ARCHIVED, 1);
        $c->addDescendingOrderByColumn(ProjectPeer::CLIENT_ID);
        $v = ProjectPeer::doSelect($c);
        return $v;
    }

    public static function retrieveProjectByName($projectName){
        $c = new Criteria();
        $c->add(ProjectPeer::NAME, "%$projectName%", Criteria::LIKE );
        $v = ProjectPeer::doSelect($c);
        return $v;
    }

} // ProjectPeer
