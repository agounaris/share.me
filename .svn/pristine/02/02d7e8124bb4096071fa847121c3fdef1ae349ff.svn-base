<?php

/**
 * Image form base class.
 *
 * @method Image getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseImageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'image_file' => new sfWidgetFormInputText(),
      'project_id' => new sfWidgetFormPropelChoice(array('model' => 'Project', 'add_empty' => false)),
      'created_by' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'archived'   => new sfWidgetFormInputText(),
      'updated_at' => new sfWidgetFormDateTime(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'image_file' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'project_id' => new sfValidatorPropelChoice(array('model' => 'Project', 'column' => 'id')),
      'created_by' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'archived'   => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image';
  }


}
