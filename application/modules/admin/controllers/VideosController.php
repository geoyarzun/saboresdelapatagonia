<?php

class Admin_VideosController extends Zend_Controller_Action
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
//        $this->view->estado3 = 'active';
        
        // Título de la vista
        $this->view->title = "Mis Videos";
        // Iniciamos una instancia del nuestro modelo
        $videos = new Admin_Model_Videos(); 
        // Asignamos a la vista el resultado de consultar por todos los registros
        $this->view->videos = $videos->fetchAll();
        
        //        Paginador
        
        Zend_Loader::loadClass('Admin_Model_Videos');  
        $video = new Admin_Model_Videos();  

        // obtenemos la página actual  
        $page = $this->_getParam('page', 1);
        // número de registros a mostrar por página  
        $registros_pagina = 5;  //20
        // número máximo de páginas a mostrar en el paginador  
        $rango_paginas = 10;  //10
                
        $videos = $video->fetchAll();  

        $paginador = Zend_Paginator::factory($videos);  
        $paginador->setItemCountPerPage($registros_pagina)  
                ->setCurrentPageNumber($page)  
                ->setPageRange($rango_paginas);  

        $this->view->videos = $paginador;  
        
    }
        
    public function editarAction()
    {                        
         $this->view->title = "Editar video"; 
 
        $form = new Admin_Form_Videos(); 
        $form->submit->setLabel('Guardar'); 
        $this->view->form = $form; 
        if ($this->getRequest()->isPost()) { 
            $formData = $this->getRequest()->getPost(); 
            if ($form->isValid($formData)) { 
                 $id = (int)$form->getValue('id'); 
                 $nombre = $form->getValue('nombre'); 
                 $url = $form->getValue('url'); 
                 
                 $videos = new Admin_Model_Videos(); 
                 $videos ->updateVideo($id, $nombre, $url); 
                 $this->_redirect('/admin/videos/index'); 
            } else { 
                 $form->populate($formData); 
            } 
        } else { 
            $id = $this->_getParam('id', 0); 
            if ($id > 0) { 
                 $videos = new Admin_Model_Videos(); 
                 $form->populate($videos->getVideo($id)); 
            } 
        } 
 
    }
    
    public function eliminarAction()
    {
        // action body 
        $this->view->title = "Eliminar videos"; 
 
        if ($this->getRequest()->isPost()) { 
            $del = $this->getRequest()->getPost('del'); 
            if ($del == 'Yes') { 
                 $id = $this->getRequest()->getPost('id'); 
                 $videos = new Admin_Model_Videos(); 
                 $videos->deleteVideo($id); 
            } 
            $this->_redirect('/admin/videos/index'); 
        } else { 
            $id = $this->_getParam('id', 0); 
            $videos = new Admin_Model_Videos(); 
            $this->view->video = $videos->getVideo($id); 
        } 
    }
    
    public function agregarAction()
    {
        $this->view->title = "Agregar un nuevo video"; 
        $form = new Admin_Form_Videos(); 
        $form->submit->setLabel('Agregar'); 
        $this->view->form = $form; 
        if ($this->getRequest()->isPost()) { 
            $formData = $this->getRequest()->getPost(); 
            if ($form->isValid($formData)) { 
                $nombre = $form->getValue('nombre'); 
                $url= $form->getValue('url'); 
                $video = new Admin_Model_Videos(); 
                $video->addVideo($nombre, $url); 
                $this->_redirect('/admin/videos/index'); 
            } else { 
                $form->populate($formData); 
            } 
        } 

    }
}

