<?php

class Admin_Form_Videos extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    }    
    
    public function __construct($options = null){
            parent::__construct($options);

            $this->setName('videos');
            $id = new Zend_Form_Element_Hidden('id');

            $nombre = new Zend_Form_Element_Text('nombre');
            $nombre->setAttrib('size', '100');
            $nombre->setLabel('Nombre')
            ->setRequired(true)
//            ->addFilter('StripTags')
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');

            $url = new Zend_Form_Element_Text('url');
            $url->setAttrib('size', '150');
            $url->setLabel('Url')
            ->setRequired(true)
//            ->addFilter('StripTags')                    
            ->addValidator('NotEmpty')
            ->addFilter('StringTrim');

            $submit = new Zend_Form_Element_Submit('submit');
            $submit->setAttrib('id', 'submitbutton');
            $this->addElements(array($id, $nombre, $url, $submit));
    }

}

