<?php

/**
 * LDAPSfGroup filter form base class.
 *
 * @package    workshare
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseLDAPSfGroupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardGroup', 'add_empty' => true)),
      'gid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'group_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardGroup', 'column' => 'id')),
      'gid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ldap_sf_group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LDAPSfGroup';
  }

  public function getFields()
  {
    return array(
      'group_id' => 'ForeignKey',
      'gid'      => 'Number',
      'id'       => 'Number',
    );
  }
}
