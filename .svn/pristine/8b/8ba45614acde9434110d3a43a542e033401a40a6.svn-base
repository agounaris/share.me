<?php

/**
 * ImageComment filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseImageCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'image_id'   => new sfWidgetFormPropelChoice(array('model' => 'Image', 'add_empty' => true)),
      'comment'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_by' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'creator_is' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'image_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Image', 'column' => 'id')),
      'comment'    => new sfValidatorPass(array('required' => false)),
      'created_by' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'creator_is' => new sfValidatorPass(array('required' => false)),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('image_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageComment';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'image_id'   => 'ForeignKey',
      'comment'    => 'Text',
      'created_by' => 'ForeignKey',
      'creator_is' => 'Text',
      'updated_at' => 'Date',
      'created_at' => 'Date',
    );
  }
}
