<?php

class Admin_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setAction($this->getView()
            ->baseUrl().'/admin/login/autenticar')
            ->setMethod('post');
		
        $this->setAttrib('id','login-form');
        $this->setAttrib('class','formular');
        
        
//        $this->setDecorators(array(
//        'FormElements',
//        array('HtmlTag',array('tag'=>'div','id'=>'content-header')),
//        ));


		// Crear y configurar el elemento email: 
		$email = $this->createElement('text', 'username');
		$email->addValidator('EmailAddress')                        
//		->setLabel('E-mail')
                        ->setAttrib('placeholder','Nombre de Usuario')
		->setRequired(true);
		
		// Crear y configurar el elemento password:		
		$password = $this->createElement('password', 'pass');
		$password
//		->setLabel('Clave')
                ->setAttrib('placeholder','Clave')
		->addValidator('stringLength', false, array(4, 8))
		->setRequired(true);
		
		// Agregar los elementos al form:
		$this->addElement($email)
		->addElement($password)
                        
		->addElement('submit', 'login', array('label' => 'Login'));
		
//		$this->clearDecorators();
//                $this->addDecorator('FormElements')
//                ->addDecorator('HtmlTag', array('tag' => '<table>', 'class' => 'generic-form'))
//                ->addDecorator('Form');

//        $this->setElementDecorators(array(
//            array('ViewHelper'),
//            array('Errors'),
//            array('Description'),
//			array("HtmlTag", array("tag" => "td")),
//            array("Label" , array("tag" => "td")),
//            array(array("tr" => "HtmlTag"), array("tag" => "tr"))
//			
//        ));
//		
//		$this->login->setDecorators(array(
//                array('ViewHelper'),
//                array('Description'),
//				array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan'=>'2', 'align'=>'right', 'class' => "form-buttons")),
//				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
//				));
    
    }


}

