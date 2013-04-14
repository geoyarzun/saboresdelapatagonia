<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
//     protected function _initAutoload() 
//     { 
//          $moduleLoader = new Zend_Application_Module_Autoloader(array( 
//               'namespace' => '', 
//               'basePath' => APPLICATION_PATH)); 
//          return $moduleLoader; 
//     } 

    protected function _initConfig()
    {
        $config = new Zend_Config_Ini('config.ini', 'default');
        Zend_Registry::set("config", $config);
		return $config;
    }
    
     protected function _initEnvironment()
    {
        if ($this->getEnvironment() == "development") {
             error_reporting(E_ALL | E_STRICT);
             ini_set("display_errors",true);
        }
        
        return null;
    }
    
    protected function _initView()
    {
        // Inicializar la vista
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');

        $view->setEncoding("iso-8859-1");
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=iso-8859-1');
//		$view->headTitle(Zend_Registry::get('config')->parametros->titulo);

        // A�adir al ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
		
        $viewRenderer->setView($view);

        // Retornar el objeto para luego poder usarlo.
        return $view;
    }
}

