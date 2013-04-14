<?php

class Admin_MultimediaController extends Zend_Controller_Action
{
    public function preDispatch()
    {
            if (!Admin_Model_Login::isLoggedIn()) {
                    $this->_forward("index", "login", "admin");
            } else {
                    $this->view->loggedIn = true;
                    $this->view->user = Admin_Model_Login::getIdentity();
            }
    }

    public function init()
    {
        Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/index/');
        $this->view->baseUrl = $this->getRequest()->getBaseUrl();
    }

    public function indexAction()
    {
        $this->view->estado2 = 'active';
    }


}

