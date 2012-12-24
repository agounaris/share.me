<?php

/**
 * sfGuardGroupProject filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardGroupProjectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_project_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupProject';
  }

  public function getFields()
  {
    return array(
      'group_id'  => 'ForeignKey',
      'client_id' => 'ForeignKey',
    );
  }
}
