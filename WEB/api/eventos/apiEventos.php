<?php
namespace api\eventos;

use lib\Model;
use object\eventos\Eventos;

class apiEventos extends Model {

    public function save(Eventos $obj) {
          unset($obj->id_album);
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
                //$resultImg = $this->saveImg($arrayImg, $resultAlb);

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'eventos_temp');
                
                $resultLoc['id_album'] = $resultAlb['id'];
                $resultLoc['url'] = $arrayImg['url'];
                  // $resultLoc['id_imagem']=$resultImg['id'];
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
     public function saveAdmin(Eventos $obj) {
         
        if (empty($obj->cod_evento)) {
            unset($obj->cod_evento);
            unset($obj->id_album);
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
                //$resultImg = $this->saveImg($arrayImg, $resultAlb);

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'eventos');
                $resultLoc['id_album'] = $resultAlb['id'];
                $resultLoc['url'] = $arrayImg['url'];
               // $resultLoc['id_imagem']=$resultImg['id'];
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
             $id_album = $obj->id_album;
            unset($obj->id_album);
            unset($obj->nome_img_loc);
          unset($obj->url);
            foreach($obj as $key=>$value){
          //var_dump($obj);
         
          if(!empty($value) ||  !is_null($value) || $value){
              $array[$key] = $value;
          }
      }
           $result = $this->Update($array, array('cod_evento' => $obj->cod_evento), 'eventos');
               $result['id_album'] = $id_album;
            return $result;
        }
    }

    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_evento']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }

    /*public function saveImg($a, $b) {
        $arrayImg = array('caminho_img' => $a['url'] . $b['id'] . '/' . $a['nome_img_loc'], 'album_id_album' => $b['id'],'tipo_album'=>'evento');

        $result = $this->Insert($arrayImg, 'imagens');
        return $result;
    }*/
     public function get($obj){
        $query = $this->First($this->Select("SELECT * FROM eventos INNER JOIN imagens ON eventos.id_album = imagens.album_id_album WHERE cod_evento = '$obj' and fakedelete <> 1"));
        $caminho =  $this->Select("SELECT caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
       $query->caminho_img = $caminho;
        return $query;
    }
     public function getlist(){
        return $this->Select("SELECT * FROM eventos where fakedelete <> 1");  
    }
 public function getEventos($obj){
                  $query = $this->First($this->Select("SELECT * FROM eventos INNER JOIN imagens ON eventos.id_album = imagens.album_id_album WHERE cod_evento = '$obj->cod_evento' and fakedelete <> 1"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
    if(count($query) < 1 ){
        $query = $this->First($this->Select("SELECT * FROM eventos WHERE cod_evento = '$obj->cod_evento'"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album = 0 ");
       
        }
       $query->caminho_img = $caminho;
        $this->setObject($obj, $query);
    }
    public function Remove(Eventos $obj){
    if(empty($obj->cod_evento)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('cod_evento'=>$obj->cod_evento),'eventos');
}
  
public function CarregarTipo(){
    $sql = "SELECT * FROM tiposevento";
   return $query = $this->Select($sql);
}
}
