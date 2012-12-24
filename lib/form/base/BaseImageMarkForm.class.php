<?php

/**
 * ImageMark form base class.
 *
 * @method ImageMark getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseImageMarkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'image_id' => new sfWidgetFormPropelChoice(array('model' => 'Image', 'add_empty' => false)),
      'point_x'  => new sfWidgetFormInputText(),
      'point_y'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'image_id' => new sfValidatorPropelChoice(array('model' => 'Image', 'column' => 'id')),
      'point_x'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'point_y'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('image_mark[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageMark';
  }


}
