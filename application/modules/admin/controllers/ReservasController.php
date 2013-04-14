<?php

class Admin_ReservasController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->estado5 = 'active';
    }


}

