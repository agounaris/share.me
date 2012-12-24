<?php

/**
 * user actions.
 *
 * @package    workshare
 * @subpackage user
 * @author     Your name here
 */
class userActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        //$this->sfGuardUsers = sfGuardUserPeer::doSelect(new Criteria());

        $this->filterForm = new sfGuardUserFormFilter();

        $c = new Criteria();

        if ($request->hasParameter('issue_filters')) {
            $filters = $request->getParameter('issue_filters');

            $this->filterForm->setDefault('username', $filters['username']);
            if (!empty($filters['username']['text']))
                $c->add(sfGuardUserPeer::USERNAME, $filters['username']['text']);

            $this->filterForm->setDefault('created_at', $filters['created_at']);
            if (!empty($filters['created_at']['text']))
                $c->add(sfGuardUserPeer::CREATED_AT, $filters['created_at']['text']);

            $this->filterForm->setDefault('last_login', $filters['last_login']);
            if (!empty($filters['last_login']['text']))
                $c->add(sfGuardUserPeer::LAST_LOGIN, $filters['last_login']['text']);

        } else if( $request->hasParameter("filter") ) {

            $filter = $request->getParameter('filter');
            $c->add( sfGuardUserPeer::USERNAME, "%$filter%", Criteria::LIKE );
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
        }

        if ($request->hasParameter("view_num")) {
            $viewNum = $request->getParameter("view_num");
            $this->getUser()->setAttribute('view_num', $viewNum);
        } else {
            if ($this->getUser()->hasAttribute('view_num')) {
                $viewNum = $this->getUser()->getAttribute('view_num');
            } else {
                $viewNum = sfConfig::get('app_list_display_rows', 15);
            }
        }

        $pager = new sfPropelPager('sfGuardUser', $viewNum);
        $pager->setPage($request->getParameter('page', 1));
        $pager->setCriteria($c);
        $pager->init();
        $this->pager = $pager;
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->sfGuardUser);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new sfGuardUserForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new sfGuardUserForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($sfGuardUser);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($sfGuardUser);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($sfGuardUser = sfGuardUserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
        $sfGuardUser->delete();

        $this->redirect('user/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $sfGuardUser = $form->save();

            $this->getUser()->setFlash('notice', 'User saved.');

            $this->redirect('user/index');
        }
    }
}
