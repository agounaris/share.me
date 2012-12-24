<?php

/**
 * content actions.
 *
 * @package    workshare
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    public function executeClient(sfWebRequest $request)
    {
        $user = $this->getUser();

        $userId = $user->getGuardUser()->getId();

        $projects = sfGuardUserProjectPeer::retrieveProjectsForUserById($userId);
        $groups = sfGuardUserGroupPeer::retrieveUserGroupsForUserById($userId);

        $this->images = null;
        $this->clientProjects = null;

        if ( count($groups) == 0 && count($projects) == 0 ) {
            $this->redirect('content/assign');
        }elseif ( count($groups) >= 1 ){

            foreach ( $groups as $group ) {
                $groupId = $group->getGroupId();
            }

            $client = sfGuardGroupProjectPeer::retrieveClientForGroupById($groupId);

            $this->clientId = $client[0]->getClientId();

            $this->setTemplate('projects');

        }elseif ( count($projects) >= 1 ) {

            foreach ($projects as $project) {
                $this->images = ImagePeer::retrieveImagesForProjectById($project->getProjectId());
            }

        }

    }

    public function executeArchived(sfWebRequest $request)
    {
        $user = $this->getUser();

        $userId = $user->getGuardUser()->getId();

        $projects = sfGuardUserProjectPeer::retrieveProjectsForUserById($userId);
        $groups = sfGuardUserGroupPeer::retrieveUserGroupsForUserById($userId);

        $this->images = null;
        $this->clientProjects = null;

        if ( count($groups) == 0 && count($projects) == 0 ) {
            $this->redirect('content/assign');
        }elseif ( count($groups) >= 1 ){

            foreach ( $groups as $group ) {
                $groupId = $group->getGroupId();
            }

            $client = sfGuardGroupProjectPeer::retrieveClientForGroupById($groupId);

            $this->clientId = $client[0]->getClientId();

            $this->setTemplate('archived');

        }elseif ( count($projects) >= 1 ) {

            foreach ($projects as $project) {
                $this->images = ImagePeer::retrieveImagesForProjectById($project->getProjectId());
            }

        }

    }

    public function executeCampaign(sfWebRequest $request)
    {
        $user = $this->getUser();

        $userId = $user->getGuardUser()->getId();

        $groups = sfGuardUserGroupPeer::retrieveUserGroupsForUserById($userId);

        if (count($groups) >= 1) {

            foreach ( $groups as $group ) {
                $groupId = $group->getGroupId();
            }

            $client = sfGuardGroupProjectPeer::retrieveClientForGroupById($groupId);
            $clientId = $client[0]->getClientId();

            $projects = array_merge(ProjectPeer::retrieveProjectsForClient( $clientId ), ProjectPeer::retrieveArchivedProjectsForClient($clientId) );

            $projectIds = array();
            foreach ($projects as $project) {
                array_push($projectIds, $project->getId());
                $this->url = $project->getUrl();
            }

        }

        $this->projectAllowed = false;
        if ( in_array( $request->getParameter('id'), $projectIds ) ) {
            $this->images = ImagePeer::retrieveImagesForProjectById($request->getParameter('id'));
            $this->projectAllowed = true;
        }
        
        /*
         * Dumping the user role to a hidden div for js to be aware of the user role
         */
        $this->userRole = 'other';
        if ( $user->hasCredential('admin') ) {
        	$this->userRole = 'other';
        }elseif ( $user->hasCredential('manage_content') ) {
        	$this->userRole = 'other';
        }elseif ( $user->hasCredential('manage_project') ) {
        	$this->userRole = 'other';
        }elseif ( $user->hasCredential('read_project') ) {
        	$this->userRole = 'client';
        }
        

    }

    public function executeCm(sfWebRequest $request)
    {
        $this->user = $this->getUser();
    }


}
