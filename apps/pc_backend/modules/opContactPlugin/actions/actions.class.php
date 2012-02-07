<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opContactPlugin actions.
 *
 * @package    OpenPNE
 * @subpackage opContactPlugin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class opContactPluginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward($this->getModuleName(), 'setting');
  }
  
  public function executeSetting(sfWebRequest $request)
  {
    $this->form = new opContactPluginSettingForm();
    
    if($request->isMethod(sfRequest::POST))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      
      if($this->form->isValid())
      {
        $this->form->save();
        $this->getUser()->setFlash('Notice', 'Setting updated.');
        $this->redirect('opContactPlugin/setting');
      }
    }
    
    return sfView::INPUT;
  }
}
