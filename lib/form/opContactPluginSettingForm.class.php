<?php

class opContactPluginSettingForm extends BaseForm
{
  public function configure()
  {
    //mail subject
    $this->setWidget('mail_subject', new sfWidgetFormInput(array('default'=>$this->getDefaultValue('mail_subject'))));
    $this->setValidator('mail_subject', new sfValidatorString());
    
    //with remote addr
    $this->setWidget('save_remote_addr', new sfWidgetFormInputCheckbox(array('default'=>(bool)$this->getDefaultValue('save_remote_addr'))));
    $this->setValidator('save_remote_addr', new sfValidatorBoolean());
    
    //return confirm
    $this->setWidget('is_return_confirm', new sfWidgetFormInputCheckbox(array('default'=>(bool)$this->getDefaultValue('is_return_confirm'))));
    $this->setValidator('is_return_confirm', new sfValidatorBoolean());

    //confirm mail subject
    $this->setWidget('confirm_mail_subject', new sfWidgetFormInput(array('default'=>$this->getDefaultValue('confirm_mail_subject'))));
    $this->setValidator('confirm_mail_subject', new sfValidatorString());
    
    $this->getWidgetSchema()->setNameFormat($this->getName().'[%s]');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('form_opContactPlugin_setting');
  }
  
  public function getName()
  {
    return 'opContactPluginSetting';
  }
  
  protected function getDefaultValue($name)
  {
    return opConfig::get('opContactPlugin_'.$name, false);
  }
  
  public function save()
  {
    $table = Doctrine::getTable('SnsConfig');
    foreach($this->getValues() as $name => $value)
    {
      $table->set('opContactPlugin_'.$name, $value);
    }
  }
}