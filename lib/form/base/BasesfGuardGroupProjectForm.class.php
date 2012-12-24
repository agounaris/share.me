<?php

/**
 * sfGuardGroupProject form base class.
 *
 * @method sfGuardGroupProject getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BasesfGuardGroupProjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'  => new sfWidgetFormInputHidden(),
      'client_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id'  => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id', 'required' => false)),
      'client_id' => new sfValidatorPropelChoice(array('model' => 'Client', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_project[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupProject';
  }


}
