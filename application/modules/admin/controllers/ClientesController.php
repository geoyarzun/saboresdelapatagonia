<?php

class Admin_ClientesController extends Zend_Controller_Action
{

    private $_usuarioDao = null;

    private $_config = null;

    public function init()
    {
        $this->_usuarioDao = new Admin_Model_UsuarioDao();
        
        Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/clientes/');
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
        $this->view->estado7 = 'active';
        
//        $this->view->user = Admin_Model_Login::getIdentity();
//        
        $this->view->listaUsuario = $this->_usuarioDao->obtenerTodos();
        
        
//        //Grid Initialization
//        $grid = Bvb_Grid::factory('usuarios');
//        
//        //Setting grid source
//        $grid->setSource(new Bvb_Grid_Source_Zend_Table(new Bugs()));
//        
//        //Pass it to the view
//        $this->view->grid = $grid; 
    }



}

