<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sf_guard_user_project' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Sep 24 18:06:47 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class sfGuardUserProjectPeer extends BasesfGuardUserProjectPeer {

    public static function retrieveProjectsForUserById($userId){
        $c = new Criteria();
        $c->add(sfGuardUserProjectPeer::USER_ID, $userId);
        $c->addDescendingOrderByColumn(sfGuardUserProjectPeer::USER_ID);
        $v = sfGuardUserProjectPeer::doSelect($c);
        return $v;
    }

} // sfGuardUserProjectPeer
