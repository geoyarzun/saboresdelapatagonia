<?php

class Admin_Model_MiPerfil extends Zend_Db_Table
{
     protected $_name = 'usuarios';
     
      public function getUsuario($id)
      { 
            $id = (int)$id; 
            $row = $this->fetchRow('id = ' . $id); 
            if (!$row) { 
                 throw new Exception("No se encuentra la fila $id"); 
            } 
            return $row->toArray(); 
      } 
//      public function addUsuario($nombre) 
//      { 
//            $data = array( 
//                 'nombre' => $nombre,                                   
//            ); 
//            $this->insert($data); 
//      } 
      function updateMiPerfil($id, $nombre, $apellido, $email ) 
      { 
            $data = array( 
                'nombre' => $nombre,
                'apellido'=>$apellido,
                'email'=>$email,
            
            ); 
            $this->update($data, 'id = '. (int)$id); 
      } 
//      function deleteVideo($id) 
//      { 
//            $this->delete('id =' . (int)$id); 
//      } 
}

