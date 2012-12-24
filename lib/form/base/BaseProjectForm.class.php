<?php

/**
 * Project form base class.
 *
 * @method Project getObject() Returns the current form's model object
 *
 * @package    workshare
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'client_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Client', 'add_empty' => false)),
      'name'                       => new sfWidgetFormInputText(),
      'created_by'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'archived'                   => new sfWidgetFormInputText(),
      'url'                        => new sfWidgetFormInputText(),
      'updated_at'                 => new sfWidgetFormDateTime(),
      'created_at'                 => new sfWidgetFormDateTime(),
      'expires_at'                 => new sfWidgetFormDate(),
      'sf_guard_user_project_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'client_id'                  => new sfValidatorPropelChoice(array('model' => 'Client', 'column' => 'id')),
      'name'                       => new sfValidatorString(array('max_length' => 128)),
      'created_by'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'archived'                   => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'url'                        => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'updated_at'                 => new sfValidatorDateTime(array('required' => false)),
      'created_at'                 => new sfValidatorDateTime(array('required' => false)),
      'expires_at'                 => new sfValidatorDate(array('required' => false)),
      'sf_guard_user_project_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Project', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('project[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Project';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_guard_user_project_list']))
    {
      $values = array();
      foreach ($this->object->getsfGuardUserProjects() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('sf_guard_user_project_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savesfGuardUserProjectList($con);
  }

  public function savesfGuardUserProjectList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_guard_user_project_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(sfGuardUserProjectPeer::PROJECT_ID, $this->object->getPrimaryKey());
    sfGuardUserProjectPeer::doDelete($c, $con);

    $values = $this->getValue('sf_guard_user_project_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new sfGuardUserProject();
        $obj->setProjectId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
