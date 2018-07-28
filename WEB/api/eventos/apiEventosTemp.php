<?php
namespace api\eventos;

use lib\Model;
use object\eventos\Eventos;

class apiEventosTemp extends Model {

     public function saveAdmin(Eventos $obj) {
        if (isset($obj->inserir)) {
            $id=$obj->cod_evento;
            unset($obj->cod_evento);
            unset($obj->id_user);
            unset($obj->inserir);
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_loc' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
            }
            try {
               
                $resultLoc = $this->Insert($arrayLocais, 'eventos');
               if($resultLoc['sucess']==true)
                {
                   $this->Delete(array('cod_evento'=>$id),'eventos_temp'); 
                }
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
            unset($obj->nome_img_loc);
            return $this->Update($obj, array('cod_evento' => $obj->cod_evento), 'eventos_temp');
        }
    }

    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_evento']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }

    public function saveImg($a, $b) {
        $arrayImg = array('caminho_img' => $a['url'] . $b['id'] . '/' . $a['nome_img_loc'], 'album_id_album' => $b['id'],'tipo_album'=>'evento');

        $result = $this->Insert($arrayImg, 'imagens');
        return $result;
    }
     public function getlist($id){
        return $this->Select("SELECT * FROM eventos_temp where cod_evento = $id");  
    }
 public function getEventos($obj){
                   $query = $this->First($this->Select("SELECT * FROM eventos_temp INNER JOIN imagens ON eventos_temp.id_album = imagens.album_id_album WHERE cod_evento = '$obj->cod_evento'"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
     if(count($query) < 1 ){
        $query = $this->First($this->Select("SELECT * FROM eventos_temp WHERE cod_evento = '$obj->cod_evento'"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album = 0 ");
       
        }
       $query->caminho_img = $caminho;
        $this->setObject($obj, $query);
    }
    public function Remove(Eventos $obj){
    if(empty($obj->cod_evento)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->Delete(array('cod_evento'=>$obj->cod_evento),'eventos_temp');
}
}
