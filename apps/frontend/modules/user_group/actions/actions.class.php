<?php

/**
 * user_group actions.
 *
 * @package    workshare
 * @subpackage user_group
 * @author     Your name here
 */
class user_groupActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        //$this->sfGuardGroups = sfGuardGroupPeer::doSelect(new Criteria());
        $this->filterForm = new sfGuardGroupFormFilter();

        $c = new Criteria();

        if ( $request->hasParameter('project_filters') ) {
            $filters = $request->getParameter('project_filters');

            $this->filterForm->setDefault('name', $filters['client']);
            if (!empty($filters['name']['text']))
                $c->add(sfGuardGroupPeer::NAME, $filters['name']['text']);

        }

        $this->sortType = "";
        $this->sort = "";
        if ($request->hasParameter("sort")) {
            $this->sort = strtoupper($request->getParameter("sort"));
            if ($request->hasParameter("desc")) {
                $c->addDescendingOrderByColumn($this->sort);
                $this->sortIcon = 'ui-icon-triangle-1-s';
            } else {
                $c->addAscendingOrderByColumn($this->sort);
                $this->sortType = 'desc=1';
                $this->sortIcon = 'ui-icon-triangle-1-n';
            }
        }else if( $request->hasParameter("filter") ) {

            $filter = $request->getParameter('filter');
            $c->add( ClientPeer::NAME, "%$filter%", Criteria::LIKE );
        }

        if ($request->hasParameter("view_num")) {
            $viewNum = $request->getParameter("view_num");
            $this->getUser()->setAttribute('view_num', $viewNum);
        } else {
            if ($this->getUser()->hasAttribute('view_num')) {
                $viewNum = $this->getUser()->getAttribute('view_num');
            } else {
                $viewNum = sfConfig::get('app_list_display_rows', 10);
            }
        }

        $pager = new sfPropelPager('sfGuardGroup', $viewNum);
        $pager->setPage($request->getParameter('page', 1));
        $pager->setCriteria($c);
        $pager->init();
        $this->pager = $pager;
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->sfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->sfGuardGroup);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new sfGuardGroupForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new sfGuardGroupForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($sfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardGroupForm($sfGuardGroup);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($sfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardGroupForm($sfGuardGroup);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($sfGuardGroup = sfGuardGroupPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardGroup does not exist (%s).', $request->getParameter('id')));
        $sfGuardGroup->delete();

        $this->redirect('user_group/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $sfGuardGroup = $form->save();
            $this->getUser()->setFlash('notice', 'Group saved.');

            $this->redirect('user_group/index');
        }
    }
}
