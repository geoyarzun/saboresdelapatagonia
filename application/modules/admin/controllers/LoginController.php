<?php

class Admin_LoginController extends Zend_Controller_Action
{

    private $_config = null;

    private $_login = null;

    public function init()
    {
                Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/login/');
                
		$this->_login = new Admin_Model_Login();
		$this->_config = Zend_Registry::get('config');
		$this->view->baseUrl = $this->getRequest()->getBaseUrl();
    }

    public function preDispatch()
    {
		if (Admin_Model_Login::isLoggedIn()) {
			$this->view->loggedIn = true;
			$this->view->user = Admin_Model_Login::getIdentity();
		}
		
    }

    private function _getForm()
    {
		return new Admin_Form_Login();
    }

    public function indexAction()
    {
		$this->view->form = $this->_getForm();
    }

    public function autenticarAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->_forward('index');
        }
		
		// Obtenemos los parametros del formulario es similar a $_POST
        $postParams = $this->_request->getPost();

		$form = $this->_getForm(); 
		if(!$form->isValid($postParams)) {
			// Falla la validacion; volvemos a generar el formulario 
			// Poblamos al formulario con los datos 
			$form->populate($postParams); 
			$this->view->form = $form; 
			return $this->render('index'); 
		}
	
		$email = $form->username->getValue();
		$clave = $form->pass->getValue();
                
                
		$responseLogin = null;
		
		try{			
			$this->_login->setMessage('El nombre de Usuario y Password no coinciden.', Admin_Model_Login::NOT_IDENTITY);
			$this->_login->setMessage('La contrase�a ingresada es incorrecta. Int�ntelo de nuevo.', Admin_Model_Login::INVALID_CREDENTIAL);
			$this->_login->setMessage('Los campos de Usuario y Password no pueden dejarse en blanco.', Admin_Model_Login::INVALID_LOGIN);
			$this->_login->login($email, $clave);
			
			$this->_helper->layout->assign("mensaje", "Login Correcto!!!");
			$this->_helper->layout->assign("colorMensaje", "green");
			
//			return $this->_forward('index', 
//								   'index', 
//								   'admin');
//                        
        Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/index/');
                        return $this->_forward('index', 
								   'index', 
								   'admin');
                        
		} catch(Exception $e){
			$this->_helper->layout->assign("mensaje", $e->getMessage());
			return $this->_forward('index');
		}
		
    }

    public function logoutAction()
    {
		$this->_login->logout();
		$this->_redirect("admin/login/");
    }

}



