<?php

class Admin_Model_Videos extends Zend_Db_Table
{
     protected $_name = 'videos';
     
      public function getVideo($id)
      { 
            $id = (int)$id; 
            $row = $this->fetchRow('id = ' . $id); 
            if (!$row) { 
                 throw new Exception("No se encuentra la fila $id"); 
            } 
            return $row->toArray(); 
      } 
      public function addVideo($nombre, $url) 
      { 
            $data = array( 
                 'nombre' => $nombre, 
                 'url' => $url,                  
            ); 
            $this->insert($data); 
      } 
      function updateVideo($id, $nombre, $url) 
      { 
            $data = array( 
                 'nombre' => $nombre, 
                 'url' => $url,                  
            ); 
            $this->update($data, 'id = '. (int)$id); 
      } 
      function deleteVideo($id) 
      { 
            $this->delete('id =' . (int)$id); 
      } 
}

