<?php

class Admin_CalendarioController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/index/');
        $this->_login = new Admin_Model_Login();
		$this->_config = Zend_Registry::get('config');

		$this->view->baseUrl = $this->getRequest()->getBaseUrl();
    }
    
    public function preDispatch()
	{
		if (!Admin_Model_Login::isLoggedIn()) {
			$this->_forward("index", "login", "admin");
		} else {
			$this->view->loggedIn = true;
			$this->view->user = Admin_Model_Login::getIdentity();
		}
	}
    
    public function indexAction()
    {
        $this->view->estado4 = 'active';
    }

    public function estacaAction()
    {
        $this->view->estado4 = 'active';
    }

    public function miBarrioAction()
    {
        $this->view->estado4 = 'active';
    }


}





