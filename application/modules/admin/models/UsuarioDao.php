<?php

class Admin_Model_UsuarioDao
{
	private $_table;
	
	public function __construct() {
		$this->_table = new Admin_Model_DbTable_Usuario();
	}
	
    /*
     * Retorna el listado de usuarios.
     * - Como PDOStatement es usado para las operaciones en la base de datos
     * - Como el objeto ResultSet object es usado para recorrer
     * un cursos retornando los registros
     */
    public function obtenerTodos() {
        $listado = new ArrayObject();

		foreach($this->_table->fetchAll() as $row) {
			$listado->append(new Admin_Model_Usuario((int) $row->id,
											$row->nombre, 
											$row->apellido, 
											$row->email, 
											$row->clave));
		}

		return $listado;
    }

    // Obtiene a un usuario, su detalle seg�n el id recibido
    public function obtenerPorId($id) {
        $usuario = null;

		$row = $this->_table->find($id)->current();

		// Vemos si ha devuelto algun resultado y creamos el usuario.
		if ($row) {
			// Construimos una VO (value object) para el usuario.
			$usuario = new Admin_Model_Usuario((int) $row->id,
											$row->nombre, 
											$row->apellido, 
											$row->email, 
											$row->clave);
		}
		
        return $usuario;
    }

    /*
     * Guarda a un usuario recibido por argumento,
     * �ste objeto usuario contiene los valores
     * de la petici�n, t�picamente del formulario
     */
    public function guardar(Admin_Model_Usuario $usuario) {
		if ($usuario->getId() == 0) {
			$row = $this->_table->createRow();

		} else {
			$row = $this->_table->find($usuario->getId())->current();
		}

		$row->nombre = $usuario->getNombre();
		$row->apellido = $usuario->getApellido();
		$row->email = $usuario->getEmail();
		$row->clave = $usuario->getClave();

		$row->save();
    }

    // Elimina a un usuario dado su id
    public function eliminar(Admin_Model_Usuario $usuario) {
		$row = $this->_table->find($usuario->getId())->current();
		if (null !== $row) {
			$row->delete();
			return true;
		}
		return false;
    }
	
	public function buscarPorNombre($nombre)
	{	
		$listado = new ArrayObject();
		
		$select = $this->_table->select();
		$select->where("nombre=?", $nombre);
		$rows = $this->_table->fetchAll($select);

		foreach($rows as $row) {
			$listado->append(new Admin_Model_Usuario((int) $row->id,
											$row->nombre, 
											$row->apellido, 
											$row->email, 
											$row->clave));
		}
		return $listado;
	}
	
	public function obtenerCuenta($email, $clave)
	{	
		$usuario = null;
		$select = $this->_table->select();
		$select->where("email=?", $email);
		$select->where("clave=?", $clave);
		$row = $this->_table->fetchRow($select);

		if ($row) {
			// Construimos una VO (value object) para el usuario.
			$usuario = new Admin_Model_Usuario((int) $row->id,
											$row->nombre, 
											$row->apellido, 
											$row->email, 
											$row->clave);
		}
		return $usuario;
	}
        
        function actualizarCuenta($id, $nombre, $apellido, $email, $clave) 
      { 
            $data = array( 
                 'nombre' => $nombre, 
                 'apellido' => $apellido,
                 'email'=>$email,
                 'clave'=>$clave,
            ); 
            $this->update($data, 'id = '. (int)$id); 
      } 
}

