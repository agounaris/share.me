<?php

/**
 * image_comment actions.
 *
 * @package    workshare
 * @subpackage image_comment
 * @author     Your name here
 */
class image_commentActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->ImageComments = ImageCommentPeer::doSelect(new Criteria());
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->ImageComment = ImageCommentPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->ImageComment);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ImageCommentForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ImageCommentForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($ImageComment = ImageCommentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ImageComment does not exist (%s).', $request->getParameter('id')));
        $this->form = new ImageCommentForm($ImageComment);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($ImageComment = ImageCommentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ImageComment does not exist (%s).', $request->getParameter('id')));
        $this->form = new ImageCommentForm($ImageComment);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($ImageComment = ImageCommentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object ImageComment does not exist (%s).', $request->getParameter('id')));
        $ImageComment->delete();

        $this->redirect('image_comment/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $ImageComment = $form->save();

            $this->redirect('image_comment/edit?id=' . $ImageComment->getId());
        }
    }

    public function executeImgshow(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');

        $comments = null;
        $user = $this->getUser();
        $clientView = false;
        if ( $user->hasCredential('client') ) {
            $comments = ImageCommentPeer::fetchCommentsForClients($request->getParameter('id'));
            $clientView = true;
        }else{
            $comments = ImageCommentPeer::fetchCommentsForImage($request->getParameter('id'));
        }


        $allComments = array();
        foreach ($comments as $comment) {
            $singleComment = array();
            array_push($singleComment, $comment->getId());
            array_push($singleComment, $comment->getComment());
            array_push($singleComment, $comment->getsfGuardUser()->getUsername());
            array_push($singleComment, $comment->getCreatedAt("d-m h:m a"));
            array_push($allComments, $singleComment);
            unset($singleComment);
        }

        $output = json_encode($allComments);

        return $this->renderText($output);
    }

    public function executeAjaxcreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $imageComment = new ImageComment();

        $today = ( date('Y-m-d H:i:s') );

        $imageComment->setImageId( $request->getParameter('image_id') );
        $imageComment->setComment( $request->getParameter('comment') );
        $imageComment->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $imageComment->setCreatedAt( $today );
        $imageComment->setUpdatedAt( $today );

        $user = $this->getUser();
        if ( $user->hasCredential('admin') ) {
            $imageComment->setCreatorIs( 'admin' );
        }elseif ( $user->hasCredential('manage_content') ) {
            $imageComment->setCreatorIs( 'production' );
        }elseif ( $user->hasCredential('manage_project') ) {
            $imageComment->setCreatorIs( 'cm' );
        }elseif ( $user->hasCredential('read_project') ) {
            $imageComment->setCreatorIs( 'client' );
        }

        $imageComment->save();

        if ( $request->hasParameter('x') ) {
            $imageMark = new ImageMark();
            $imageMark->setImageId($request->getParameter('image_id'));
            $imageMark->setPointX($request->getParameter('x'));
            $imageMark->setPointY($request->getParameter('y'));

            $imageMark->save();
        }

        return $this->renderText('all_cool');
    }

    public function executeAjaxpoints(sfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');

        $marks = ImageMarkPeer::fetchMarksForImage($request->getParameter('id'));

        $allMarks = array();
        foreach( $marks as $mark ) {
            $singleMark = array();
            array_push( $singleMark, $mark->getImageId());
            array_push( $singleMark, $mark->getPointX());
            array_push( $singleMark, $mark->getPointY());
            array_push( $allMarks, $singleMark);
            unset($singleMark);
        }

        $output = json_encode($allMarks);
        return $this->renderText($output);

    }

    /*
     * TODO: Not used should be deleted
     */
    public function executeUserrole( sfWebRequest $request )
    {
        $user = $this->getUser();
        $output = 'other';
        if ( $user->hasCredential('admin') ) {
            $output = 'other';
        }elseif ( $user->hasCredential('manage_content') ) {
            $output = 'other';
        }elseif ( $user->hasCredential('manage_project') ) {
            $output = 'other';
        }elseif ( $user->hasCredential('read_project') ) {
            $output = 'client';
        }

        return $this->renderText($output);
    }

}
