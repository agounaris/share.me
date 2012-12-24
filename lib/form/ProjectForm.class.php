<?php

/**
 * Project form.
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
class ProjectForm extends BaseProjectForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'id'            => new sfWidgetFormInputHidden(),
            'client_id'     => new sfWidgetFormPropelChoice(array('model' => 'Client', 'add_empty' => false)),
            'name'          => new sfWidgetFormInputText(),
            'created_by'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
            'archived'      => new sfWidgetFormSelect(array('choices' => array(1 => "yes", 0 => "no"))),
            'url'           => new sfWidgetFormInputText(),
            'updated_at'    => new sfWidgetFormDateTime(),
            'created_at'    => new sfWidgetFormDateTime(),
            'expires_at'    => new sfWidgetFormInputText(),
            'sf_guard_user_project_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
        ));

        $this->setValidators(array(
            'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
            'client_id'     => new sfValidatorPropelChoice(array('model' => 'Client', 'column' => 'id')),
            'name'          => new sfValidatorString(array('max_length' => 128)),
            'created_by'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
            'archived'      => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
            'url'           => new sfValidatorString(array('max_length' => 512, 'required' => false)),
            'updated_at'    => new sfValidatorDateTime(array('required' => false)),
            'created_at'    => new sfValidatorDateTime(array('required' => false)),
            'expires_at'                 => new sfValidatorDate(array('required' => false)),
            'sf_guard_user_project_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorAnd(array(
                new sfValidatorPropelUnique(array('model' => 'Project', 'column' => array('name'))),
            ))
        );

        $this->widgetSchema->setNameFormat('project[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        unset(
        $this['updated_at'],
        $this['created_at'],
        $this['sf_guard_user_project_list']
        );
    }
}
