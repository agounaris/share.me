<?php

/**
 * main actions.
 *
 * @package    sf_intranet
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    $user = $this->getUser();

  if ($user->hasCredential('manage_content')) {
      $this->redirect('project/index');
  }elseif ($user->hasCredential('manage_content')) {
      $this->redirect('content/production');
  }elseif ($user->hasCredential('manage_project')) {
      $this->redirect('content/cm');
  }elseif ($user->hasCredential('read_project')) {
      $this->redirect('content/client');
  }
    
  }
}
