<?php

/**
 * sfGuardUserProject filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardUserProjectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_project_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProject';
  }

  public function getFields()
  {
    return array(
      'user_id'    => 'ForeignKey',
      'project_id' => 'ForeignKey',
    );
  }
}
