<?php

/**
 * sfGuardGroup actions.
 *
 * @package    workshare
 * @subpackage sfGuardGroup
 * @author     Your name here
 */
class sfGuardGroupActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->SfGuardGroups = sfGuardGroupPeer::doSelect(new Criteria());
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->SfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->SfGuardGroup);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new SfGuardGroupForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SfGuardGroupForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($SfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $this->form = new SfGuardGroupForm($SfGuardGroup);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($SfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $this->form = new SfGuardGroupForm($SfGuardGroup);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($SfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object SfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $SfGuardGroup->delete();

        $this->redirect('sfGuardGroup/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $SfGuardGroup = $form->save();

            $this->redirect('sfGuardGroup/index');
        }
    }
}
