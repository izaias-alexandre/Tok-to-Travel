<?php
namespace api\not;

use lib\Model;


class apiNot extends Model {
     public function getlist(){
        return $this->Select("SELECT * FROM notificacao where ativo LIKE 's' ");  
    }
    public function Finalizar($id){
        return $this->Update(array('ativo'=>'n'), array('id' => $id), 'notificacao');
    }
}

