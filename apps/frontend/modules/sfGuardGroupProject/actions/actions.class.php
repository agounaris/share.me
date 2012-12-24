<?php

/**
 * sfGuardGroupProject actions.
 *
 * @package    workshare
 * @subpackage sfGuardGroupProject
 * @author     Your name here
 */
class sfGuardGroupProjectActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->SfGuardGroupProjects = sfGuardGroupProjectPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->SfGuardGroupProject = sfGuardGroupProjectPeer::retrieveByPk($request->getParameter('group_id'),
           $request->getParameter('client_id'));
    $this->forward404Unless($this->SfGuardGroupProject);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SfGuardGroupProjectForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SfGuardGroupProjectForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($SfGuardGroupProject = sfGuardGroupProjectPeer::retrieveByPk($request->getParameter('group_id'),
     $request->getParameter('client_id')), sprintf('Object SfGuardGroupProject does not exist (%s).', $request->getParameter('group_id'),
     $request->getParameter('client_id')));
    $this->form = new SfGuardGroupProjectForm($SfGuardGroupProject);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($SfGuardGroupProject = sfGuardGroupProjectPeer::retrieveByPk($request->getParameter('group_id'),
     $request->getParameter('client_id')), sprintf('Object SfGuardGroupProject does not exist (%s).', $request->getParameter('group_id'),
     $request->getParameter('client_id')));
    $this->form = new SfGuardGroupProjectForm($SfGuardGroupProject);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($SfGuardGroupProject = sfGuardGroupProjectPeer::retrieveByPk($request->getParameter('group_id'),
     $request->getParameter('client_id')), sprintf('Object SfGuardGroupProject does not exist (%s).', $request->getParameter('group_id'),
     $request->getParameter('client_id')));
    $SfGuardGroupProject->delete();

    $this->redirect('sfGuardGroupProject/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $SfGuardGroupProject = $form->save();

      $this->redirect('sfGuardGroupProject/edit?group_id='.$SfGuardGroupProject->getGroupId().'&client_id='.$SfGuardGroupProject->getClientId());
    }
  }
}
