<?php

/**
 * image actions.
 *
 * @package    workshare
 * @subpackage image
 * @author     Your name here
 */
class imageActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        //$this->Images = ImagePeer::doSelect(new Criteria());

        $this->filterForm = new ImageFormFilter();

        $c = new Criteria();

        if ($request->hasParameter('project_filters')) {

            $filters = $request->getParameter('project_filters');

            $this->filterForm->setDefault('project', $filters['project']);
            if (!empty($filters['project']['text']))
                $c->add(ImagePeer::PROJECT_ID, $filters['project']['text']);

            $this->filterForm->setDefault('created_at', $filters['name']);
            if (!empty($filters['created_at']['text']))
                $c->add(ImagePeer::CREATED_AT, $filters['created_at']['text']);

        } else if ($request->hasParameter("filter")) {

            $filter = $request->getParameter('filter');

            $projects = ProjectPeer::retrieveProjectByName($filter);

            $projectIds = array();
            foreach ($projects as $project) {
                array_push($projectIds, $project->getId());
            }

            $c->add(ImagePeer::PROJECT_ID, $projectIds, Criteria::IN);

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

        $pager = new sfPropelPager('Image', $viewNum);
        $pager->setPage($request->getParameter('page', 1));
        $pager->setCriteria($c);
        $pager->init();
        $this->pager = $pager;
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->Image = ImagePeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->Image);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ImageForm();

        $this->form->setDefault('created_by', $this->getUser()->getGuardUser()->getId());

    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ImageForm();

        $this->form->setDefault('created_by', $this->getUser()->getGuardUser()->getId());

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($Image = ImagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Image does not exist (%s).', $request->getParameter('id')));
        $this->form = new ImageForm($Image);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Image = ImagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Image does not exist (%s).', $request->getParameter('id')));
        $this->form = new ImageForm($Image);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($Image = ImagePeer::retrieveByPk($request->getParameter('id')), sprintf('Object Image does not exist (%s).', $request->getParameter('id')));
        $Image->delete();

        $this->redirect('image/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $Image = $form->save();

            $this->getUser()->setFlash('notice', 'Image saved.');

            $this->redirect('image/index');
        }
    }
}
