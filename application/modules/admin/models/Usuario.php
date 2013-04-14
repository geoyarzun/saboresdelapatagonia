<?php

class Admin_Model_Usuario
{
        private $_id;
	
	private $_nombre;
	
	private $_apellido;
	
	private $_email;
	
	private $_clave;
	
	public function __construct($id = null, $nombre = null, $apellido = null, $email = null, $clave = null)
	{
		$this->_id = $id;
		$this->_nombre = $nombre;
		$this->_apellido = $apellido;
		$this->_email = $email;
		$this->_clave = $clave;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function getNombre()
	{
		return $this->_nombre;
	}
	
	public function getApellido()
	{
		return $this->_apellido;
	}
	
	public function getEmail()
	{
		return $this->_email;
	}
	
	public function getClave()
	{
		return $this->_clave;
	}
}

