<?php

namespace api\local;

use lib\Model;
use object\locais\Locais;

class apiLocaisTemp extends Model {

public function saveAdmin(Locais $obj) {
    if(isset($obj->inserir)){
        $id=$obj->cod_local;
            unset($obj->cod_local);
            unset($obj->id_user);
            unset($obj->inserir);
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_loc' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
            }
            try {
                $resultLoc = $this->Insert($arrayLocais, 'locais');
                //var_dump($resultLoc);
                if($resultLoc['sucess']==true)
                {
                   $this->Delete(array('cod_local'=>$id),'locais_temp'); 
                }
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
            unset($obj->nome_img_loc);
            return $this->Update($obj, array('cod_local' => $obj->cod_local), 'locais_temp');
        }
    }
    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_loc']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }

    public function saveImg($a, $b) {
        $arrayImg = array('caminho_img' => $a['url'] . $b['id'] . '/' . $a['nome_img_loc'], 'album_id_album' => $b['id'],'tipo_evento'=>'local');

        $result = $this->Insert($arrayImg, 'imagens');
        return $result;
    }
     public function getlist($id){
        return $this->Select("SELECT * FROM locais_temp where cod_local = $id");  
    }

    public function getLocal($obj){
        //  $query = $this->First($this->Select("SELECT * FROM locais_temp WHERE cod_local = '{$obj->cod_local}'"));
        //$this->setObject($obj, $query);
                $query = $this->First($this->Select("SELECT * FROM locais_temp INNER JOIN imagens ON locais_temp.id_album = imagens.album_id_album WHERE cod_local = '$obj->cod_local'"));
           $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
      
      //var_dump($query);
      if(count($query) < 1 ){
        $query = $this->First($this->Select("SELECT * FROM locais_temp WHERE cod_local = '$obj->cod_local'"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album = 0 ");
        
        }
              $query->caminho_img = $caminho;
      
        $this->setObject($obj, $query);
    }
    /*public function getLocal($obj){
        //  $query = $this->First($this->Select("SELECT * FROM locais_temp WHERE cod_local = '{$obj->cod_local}'"));
        //$this->setObject($obj, $query);
                $query = $this->First($this->Select("SELECT * FROM locais_temp INNER JOIN imagens ON locais_temp.id_album = imagens.album_id_album WHERE cod_local = '$obj->cod_local'"));
           $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
              $query->caminho_img = $caminho;
        $this->setObject($obj, $query);
    }*/
    public function Remove(Locais $obj){
    if(empty($obj->cod_local)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->Delete(array('cod_local'=>$obj->cod_local),'locais_temp');
}

}
