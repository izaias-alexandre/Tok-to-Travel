<?php
namespace api\telaAlbum;

use lib\Model;

class apitelaAlbum extends Model {

    public function save(telaAlbum $obj) {
        if (empty($obj->cod_evento)) {
            unset($obj->cod_evento);
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_loc' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
                if ($keys == 'nome_evento' || $keys == 'nome_img_loc' || $keys == 'url') {
                    $arrayImg[$keys] = $values;
                }
            }
            try {
                $resultAlb = $this->saveAlbum($arrayImg);
                $this->saveImg($arrayImg, $resultAlb);

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'eventos_temp');
                
                $resultLoc['id_album'] = $resultAlb['id'];
                $resultLoc['url'] = $arrayImg['url'];
                 if($resultLoc['sucess']==true)
                {
                     $arraynot=array('ativo'=>'s','msg'=>'cadastro de evento','cat'=>$resultLoc['id']);
                   $this->Insert($arraynot,'notificacao'); 
                }
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
            return $this->Update($obj, array('id_user' => $obj->id_user), 'usuario');
        }
    }
    
    public function carregarAlbum($obj) {
        //var_dump($obj);
      $slq = "SELECT * FROM usuario where id_user = $obj";
      $query = $this->Select($slq);
     // var_dump($query);
      $sql2= "SELECT * FROM imagens where album_id_album = ".$query[0]->id_album;
      $query2 = $this->Select($sql2);

      return $query2;

    }

    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_evento']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }

    public function saveImg($a, $b) {
        $arrayImg = array('caminho_img' => $a['url'] . $b['id'] . '/' . $a['nome_img_loc'], 'album_id_album' => $b['id']);

        $result = $this->Insert($arrayImg, 'imagens');
        return $result;
    }
     public function get($obj){
        $query = $this->First($this->Select("SELECT * FROM eventos WHERE cod_evento = '$obj'"));
        return $query;
    }
     public function getlist(){
        return $this->Select("SELECT * FROM eventos");  
    }
 public function getEventos($obj){
          $query = $this->First($this->Select("SELECT * FROM eventos WHERE cod_evento = '{$obj->cod_evento}'"));
        $this->setObject($obj, $query);
    }
    public function Remove(Eventos $obj){
    if(empty($obj->cod_evento)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->Delete(array('cod_evento'=>$obj->cod_evento),'eventos');
}
}
