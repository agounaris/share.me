<?php

/**
 * ImageComment form.
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
class ImageCommentForm extends BaseImageCommentForm
{
  public function configure()
  {

      parent::configure();

      unset(
      $this['updated_at'],
      $this['created_at']
      );

  }
}
