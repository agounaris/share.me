<?php

/**
 * Image form.
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
class ImageForm extends BaseImageForm
{
  public function configure()
  {
  	$this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'image_file' => new sfWidgetFormInputFile(),
      'project_id' => new sfWidgetFormPropelChoice(array('model' => 'Project', 'add_empty' => false)),
      'created_by' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'archived'   => new sfWidgetFormSelect(array('choices'=>array(1 => "yes",0 => "no") )),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'image_file' => new sfValidatorFile( array('path' => sfConfig::get('sf_upload_dir').'/images'
          , 'required' => false
          )),
      'created_by' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'project_id' => new sfValidatorPropelChoice(array('model' => 'Project', 'column' => 'id')),
      'archived' => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

   unset(
      $this['updated_at'],
      $this['created_at']
    );

  }
}
