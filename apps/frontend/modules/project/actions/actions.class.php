<?php

/**
 * project actions.
 *
 * @package    workshare
 * @subpackage project
 * @author     Your name here
 */
class projectActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        //$this->Projects = ProjectPeer::doSelect(new Criteria());

        $this->filterForm = new ProjectFormFilter();

        $c = new Criteria();
        
        $c->add(ProjectPeer::ARCHIVED, 0, Criteria::EQUAL);

        if ( $request->hasParameter('project_filters') ) {
            $filters = $request->getParameter('project_filters');

            $this->filterForm->setDefault('client', $filters['client']);
            if (!empty($filters['client']['text']))
                $c->add(ProjectPeer::CLIENT_ID, $filters['client']['text']);

            $this->filterForm->setDefault('name', $filters['name']);
            if (!empty($filters['name']['text']))
                $c->add(ProjectPeer::NAME, $filters['name']['text']);

            $this->filterForm->setDefault('archived', $filters['archived']);
            if (!empty($filters['archived']['text']))
                $c->add(ProjectPeer::ARCHIVED, $filters['archived']['text']);

        }else if( $request->hasParameter("filter") ) {

            $filter = $request->getParameter('filter');

            $clients = ClientPeer::retrieveClientsByName( $filter );

            $clientIds = array();
            foreach ( $clients as $client ) {
               array_push( $clientIds, $client->getId() );
            }

            $c->add( ProjectPeer::CLIENT_ID, $clientIds, Criteria::IN );

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
                $viewNum = sfConfig::get('app_list_display_rows', 10);
            }
        }

        $pager = new sfPropelPager('Project', $viewNum);
        $pager->setPage($request->getParameter('page', 1));
        $pager->setCriteria($c);
        $pager->init();
        $this->pager = $pager;
    }
    
    public function executeArchive(sfWebRequest $request)
    {
    	//$this->Projects = ProjectPeer::doSelect(new Criteria());
    
    	$this->filterForm = new ProjectFormFilter();
    
    	$c = new Criteria();
    	
    	$c->add(ProjectPeer::ARCHIVED, 1, Criteria::EQUAL);
    
    	if ( $request->hasParameter('project_filters') ) {
    		$filters = $request->getParameter('project_filters');
    
    		$this->filterForm->setDefault('client', $filters['client']);
    		if (!empty($filters['client']['text']))
    			$c->add(ProjectPeer::CLIENT_ID, $filters['client']['text']);
    
    		$this->filterForm->setDefault('name', $filters['name']);
    		if (!empty($filters['name']['text']))
    			$c->add(ProjectPeer::NAME, $filters['name']['text']);
    
    		$this->filterForm->setDefault('archived', $filters['archived']);
    		if (!empty($filters['archived']['text']))
    			$c->add(ProjectPeer::ARCHIVED, $filters['archived']['text']);
    
    	}else if( $request->hasParameter("filter") ) {
    
    		$filter = $request->getParameter('filter');
    
    		$clients = ClientPeer::retrieveClientsByName( $filter );
    
    		$clientIds = array();
    		foreach ( $clients as $client ) {
    			array_push( $clientIds, $client->getId() );
    		}
    
    		$c->add( ProjectPeer::CLIENT_ID, $clientIds, Criteria::IN );
    
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
    			$viewNum = sfConfig::get('app_list_display_rows', 10);
    		}
    	}
    
    	$pager = new sfPropelPager('Project', $viewNum);
    	$pager->setPage($request->getParameter('page', 1));
    	$pager->setCriteria($c);
    	$pager->init();
    	$this->pager = $pager;
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->Project = ProjectPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->Project);

        $this->images = ImagePeer::retrieveImagesForProjectById( $this->Project->getId() );
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ProjectForm();

        $this->form->setDefault('created_by', $this->getUser()->getGuardUser()->getId());
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ProjectForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($Project = ProjectPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Project does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProjectForm($Project);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Project = ProjectPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Project does not exist (%s).', $request->getParameter('id')));
        $this->form = new ProjectForm($Project);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($Project = ProjectPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Project does not exist (%s).', $request->getParameter('id')));
        $Project->delete();

        $this->redirect('project/index');
    }

    public function executeArchiveit(sfWebRequest $request)
    {
        $this->Project = ProjectPeer::retrieveByPk($request->getParameter('id'));

        $this->Project->setArchived(1);

        $this->Project->save();

        $this->redirect('project/index');
    }

    public function executeUnarchiveit(sfWebRequest $request)
    {
        $this->Project = ProjectPeer::retrieveByPk($request->getParameter('id'));

        $this->Project->setArchived(0);

        $this->Project->save();

        $this->redirect('project/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $Project = $form->save();

            if (strpos($Project->getUrl(), 'http') !== false) {
                $this->createImageForProjectUrl($Project->getId(), $Project->getName(), $Project->getUrl());
            }

            $this->getUser()->setFlash('notice', 'Project saved.');

            if ( $this->getUser()->hasCredential('admin') ) {
            	$this->redirect('project/index');
            }elseif ( $this->getUser()->hasCredential('manage_project') ) {
            	$this->redirect('content/cm');
            }
            
        }
    }

    protected function createImageForProjectUrl($projectId, $projectName, $projectUrl)
    {
        $path = '/home/argiris/Development/share.me/web/uploads/images/';

        exec('touch ' . $path . 'render.js');

        $url = $projectUrl;
        
        $unique = uniqid();

        $js = "var page = require('webpage').create();
                page.open('" . $url . "', function () {
	            page.viewportSize = { width: 1024, height: 768 };
                page.render('" . $path . "".$projectName."-".$unique.".png');
                phantom.exit();
        });";

        $filename = $path . 'render.js';

        if (is_writable($filename)) {
            // In our example we're opening $filename in append mode.
            if (!$handle = fopen($filename, 'a')) {
                //die( "Cannot open file ($filename)");
                exit;
            }
            if (fwrite($handle, $js) === FALSE) {
                //die("Cannot write to file ($filename)");
                exit;
            }
            //die("Success, wrote ($somecontent) to file ($filename)");
            fclose($handle);
        } else {
            die("The file $filename is not writable");
        }

        exec('phantomjs ' . $path . 'render.js');

        $fh = fopen($filename, 'w');
        fclose($fh);

        $Image = new Image();

        $Image->setImageFile( $projectName."-".$unique.".png" );
        $Image->setProjectId($projectId);
        $Image->setCreatedBy($this->getUser()->getGuardUser()->getId());

        $Image->save();
    }
}
