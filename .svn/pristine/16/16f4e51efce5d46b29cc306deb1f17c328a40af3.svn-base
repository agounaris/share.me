<?php

/**
 * LDAPServer form base class.
 *
 * @method LDAPServer getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseLDAPServerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'host'         => new sfWidgetFormInputText(),
      'port'         => new sfWidgetFormInputText(),
      'tls'          => new sfWidgetFormInputCheckbox(),
      'basedn'       => new sfWidgetFormInputText(),
      'user_prefix'  => new sfWidgetFormInputText(),
      'group_prefix' => new sfWidgetFormInputText(),
      'binddn'       => new sfWidgetFormInputText(),
      'bindpasswd'   => new sfWidgetFormInputText(),
      'user_attr'    => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'host'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'port'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'tls'          => new sfValidatorBoolean(),
      'basedn'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'user_prefix'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'group_prefix' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'binddn'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'bindpasswd'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'user_attr'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'status'       => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('ldap_server[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LDAPServer';
  }


}
