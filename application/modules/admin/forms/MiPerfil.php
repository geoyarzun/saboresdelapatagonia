<?php

class Admin_Form_MiPerfil extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    }
 
    public function __construct($options = null){
            parent::__construct($options);

            $this->setName('usuario');
            $id = new Zend_Form_Element_Hidden('id');

            $nombre = new Zend_Form_Element_Text('nombre');
            $nombre->setAttrib('size', '40');
            $nombre->setLabel('Nombre')
            ->setRequired(true)
//            ->addFilter('StripTags')
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');

            $apellido = new Zend_Form_Element_Text('apellido');
            $apellido->setAttrib('size', '40');
            $apellido->setLabel('Apellido')
            ->setRequired(true)
//            ->addFilter('StripTags')                    
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');
            
            $email = new Zend_Form_Element_Text('email');
            $email->setAttrib('size', '40');
            $email->setLabel('Email')
            ->setRequired(true)
//            ->addFilter('StripTags')                    
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');
            
            $clave = new Zend_Form_Element_Text('clave');
            $clave->setAttrib('size', '40');
            $clave->setLabel('Clave')
            ->setRequired(true)
//            ->addFilter('StripTags')                    
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');

            $submit = new Zend_Form_Element_Submit('submit');
            $submit->setAttrib('id', 'submitbutton');
            $this->addElements(array($id, $nombre, $apellido, $email, $clave , $submit));
    }
}

