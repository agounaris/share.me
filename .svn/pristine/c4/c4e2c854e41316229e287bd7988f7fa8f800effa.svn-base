<?php

/**
 * LDAPSfGroup form base class.
 *
 * @method LDAPSfGroup getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseLDAPSfGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardGroup', 'add_empty' => false)),
      'gid'      => new sfWidgetFormInputText(),
      'id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id')),
      'gid'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ldap_sf_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LDAPSfGroup';
  }


}
