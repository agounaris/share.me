<?php

/**
 * LDAPSfUser filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLDAPSfUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'uid'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'uid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ldap_sf_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LDAPSfUser';
  }

  public function getFields()
  {
    return array(
      'user_id' => 'ForeignKey',
      'uid'     => 'Number',
      'id'      => 'Number',
    );
  }
}
