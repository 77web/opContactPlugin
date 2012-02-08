<?php

class opContactPluginBaseContactForm extends BaseForm
{
  public function setup()
  {
    $this->setWidget('name', new sfWidgetFormInput());
    $this->setValidator('name', new sfValidatorString());

    $this->setWidget('email', new sfWidgetFormInput());
    $this->setValidator('email', new sfValidatorEmail());
    
    $this->setWidget('body', new sfWidgetFormTextarea());
    $this->setValidator('body', new sfValidatorString());
    
    $this->getWidgetSchema()->setNameFormat($this->getName().'[%s]');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('form_contact');
  }
  
  public function getName()
  {
    return 'contact';
  }
  
  public function getEmail()
  {
    return $this->getValue('email');
  }
}