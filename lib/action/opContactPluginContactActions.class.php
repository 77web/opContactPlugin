<?php

class opContactPluginContactActions extends sfActions
{
  const SAVE_ATTR_NAME = 'contact_values';
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('contact', 'form');
  }
  
  public function executeForm(sfWebRequest $request)
  {
    $defaults = array();
    if($this->getUser()->getAttribute(self::SAVE_ATTR_NAME))
    {
      $defaults = $this->getUser()->getAttribute(self::SAVE_ATTR_NAME, array());
    }
    $this->form = new opContactPluginContactForm($defaults);
    
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if($this->form->isValid())
      {
        $this->getUser()->setAttribute(self::SAVE_ATTR_NAME, $this->form->getValues());
        $this->csrfForm = new BaseForm();
        return sfView::SUCCESS;
      }
    }
    
    return sfView::INPUT;
  }
  
  public function executeSend(sfWebRequest $request)
  {
    $this->forwardUnless($this->getUser()->hasAttribute(self::SAVE_ATTR_NAME), 'contact', 'form');
    $request->checkCSRFProtection();
    
    $this->form = new opContactPluginContactForm(array(), array(), false);
    $this->form->bind($this->getUser()->getAttribute(self::SAVE_ATTR_NAME, array()));
    $this->forwardUnless($this->form->isValid(), 'contact', 'form');
    
    try
    {
      $to = opConfig::get("admin_mail_address");
      $from = opConfig::get("admin_mail_address");
      sfContext::getInstance()->getConfiguration()->loadHelpers(array('Partial', 'I18N'));
      $title = opConfig::get('opContactPlugin_mail_subject', __('Contact mail'));
      $body = get_partial('contact/contactMail', array('form'=>$this->form));
      opMailSend::execute($title, $to, $from, $body);
      
      if((bool)opConfig::get('opContactPlugin_is_return_confirm', false))
      {
        $title2 = opConfig::get('opContactPlugin_confirm_mail_subject', __('Thank you for your request'));
        $body2 = get_partial('contact/confirmMail', array('form'=>$this->form));
        opMailSend::execute($title2, $this->form->getEmail(), $from, $body2);
      }
    }
    catch(Exception $e)
    {
      return sfView::ERROR;
    }
    
    $this->redirect('contact/complete');
  }
  
  public function executeComplete(sfWebRequest $request)
  {
    $this->redirectUnless($this->getUser()->getAttribute(self::SAVE_ATTR_NAME, false), 'contact/form');
    $this->getUser()->setAttribute(self::SAVE_ATTR_NAME, null);
    
    return sfView::SUCCESS;
  }
}