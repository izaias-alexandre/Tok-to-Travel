<?php
namespace api\avaliacao;
use lib\Model;
use object\avaliacao\avaliacao;

class apiAvalia extends Model {
      public function Avaliar(avaliacao $obj) {
          if(isset($obj->cod_evento)){
     $get = $this->Select("SELECT avaliacao,nota FROM eventos WHERE cod_evento = $obj->cod_evento LIMIT 1");
     $avaliacao = $get[0]->avaliacao + 1;
     $nota = ($get[0]->nota + $obj->nota);
     $this->Update(array('avaliacao'=>$avaliacao,'nota'=>$nota), array('cod_evento' => $obj->cod_evento), 'eventos');
          }else{
                $get = $this->Select("SELECT avaliacao,nota FROM locais WHERE cod_local = $obj->cod_local LIMIT 1");
     $avaliacao = $get[0]->avaliacao + 1;
     $nota = ($get[0]->nota + $obj->nota);
     $this->Update(array('avaliacao'=>$avaliacao,'nota'=>$nota), array('cod_local' => $obj->cod_local), 'locais');  
          }
    
     
     
}

}