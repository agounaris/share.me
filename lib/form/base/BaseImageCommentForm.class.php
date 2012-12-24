<?php

/**
 * ImageComment form base class.
 *
 * @method ImageComment getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseImageCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'image_id'   => new sfWidgetFormPropelChoice(array('model' => 'Image', 'add_empty' => false)),
      'comment'    => new sfWidgetFormInputText(),
      'created_by' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'creator_is' => new sfWidgetFormInputText(),
      'updated_at' => new sfWidgetFormDateTime(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'image_id'   => new sfValidatorPropelChoice(array('model' => 'Image', 'column' => 'id')),
      'comment'    => new sfValidatorString(array('max_length' => 2000)),
      'created_by' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'creator_is' => new sfValidatorString(array('max_length' => 30)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageComment';
  }


}
