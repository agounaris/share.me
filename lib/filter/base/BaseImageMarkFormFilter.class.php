<?php

/**
 * ImageMark filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseImageMarkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'image_id' => new sfWidgetFormPropelChoice(array('model' => 'Image', 'add_empty' => true)),
      'point_x'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'point_y'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'image_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Image', 'column' => 'id')),
      'point_x'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'point_y'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('image_mark_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageMark';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'image_id' => 'ForeignKey',
      'point_x'  => 'Number',
      'point_y'  => 'Number',
    );
  }
}
