<?php

class Admin_MiPerfilController extends Zend_Controller_Action
{

    private $_usuarioDao = null;

    private $_config = null;
    
    
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
        $this->_usuarioDao = new Admin_Model_UsuarioDao();
        
        Zend_Layout::getMvcInstance()->setLayoutPath('../application/modules/admin/layouts/scripts/index/');
        $this->_login = new Admin_Model_Login();
		$this->_config = Zend_Registry::get('config');

		$this->view->baseUrl = $this->getRequest()->getBaseUrl();
    }

    

    public function indexAction()
    {

        $this->view->listaUsuario = $this->_usuarioDao->obtenerTodos();
        
    }

    public function editarAction()
    {
        
        $this->view->title = "Editar Mi Perfil"; 
 
        $form = new Admin_Form_MiPerfil(); 
        $form->submit->setLabel('Guardar'); 
        $this->view->form = $form; 
        if ($this->getRequest()->isPost()) { 
            $formData = $this->getRequest()->getPost(); 
            if ($form->isValid($formData)) { 
                 $id = (int)$form->getValue('id'); 
                 $nombre = $form->getValue('nombre'); 
                 $apellido = $form->getValue('apellido');
                 $email = $form->getValue('email');
//                 $clave = $form->getValue('clave');
                 
//                 $url = $form->getValue('url'); 
                 
                 $miperfil = new Admin_Model_Miperfil(); 
                 $miperfil ->updateMiPerfil($id, $nombre, $apellido, $email); 
                 $this->_redirect('/admin/MiPerfil'); 
            } else { 
                 $form->populate($formData); 
            } 
        } else { 
            $id = $this->_getParam('id', 0); 
            if ($id > 0) { 
                 $miperfil = new Admin_Model_MiPerfil(); 
                 $form->populate($miperfil->getUsuario($id)); 
            } 
        }
        

    }
    

}



