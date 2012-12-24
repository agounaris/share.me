<?php

/**
 * LDAPServer filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLDAPServerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(),
      'host'         => new sfWidgetFormFilterInput(),
      'port'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tls'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'basedn'       => new sfWidgetFormFilterInput(),
      'user_prefix'  => new sfWidgetFormFilterInput(),
      'group_prefix' => new sfWidgetFormFilterInput(),
      'binddn'       => new sfWidgetFormFilterInput(),
      'bindpasswd'   => new sfWidgetFormFilterInput(),
      'user_attr'    => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'host'         => new sfValidatorPass(array('required' => false)),
      'port'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tls'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'basedn'       => new sfValidatorPass(array('required' => false)),
      'user_prefix'  => new sfValidatorPass(array('required' => false)),
      'group_prefix' => new sfValidatorPass(array('required' => false)),
      'binddn'       => new sfValidatorPass(array('required' => false)),
      'bindpasswd'   => new sfValidatorPass(array('required' => false)),
      'user_attr'    => new sfValidatorPass(array('required' => false)),
      'status'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('ldap_server_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LDAPServer';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'host'         => 'Text',
      'port'         => 'Number',
      'tls'          => 'Boolean',
      'basedn'       => 'Text',
      'user_prefix'  => 'Text',
      'group_prefix' => 'Text',
      'binddn'       => 'Text',
      'bindpasswd'   => 'Text',
      'user_attr'    => 'Text',
      'status'       => 'Boolean',
    );
  }
}
