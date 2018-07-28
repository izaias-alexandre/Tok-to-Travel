<?php

namespace api\local;

use lib\Model;
use object\locais\Locais;

class apiLocais extends Model {

    public function save(Locais $obj) {
        unset($obj->id_album);
        if (empty($obj->cod_local)) {
            unset($obj->cod_local);
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_loc' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
                if ($keys == 'nome_loc' || $keys == 'nome_img_loc' || $keys == 'url') {
                    $arrayImg[$keys] = $values;
                }
            }
            try {
                $resultAlb = $this->saveAlbum($arrayImg);
              //  $resultImg = $this->saveImg($arrayImg, $resultAlb);
//var_dump($arrayLocais)."<br>";
//var_dump($obj);

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'locais_temp');
                $resultLoc['id_album'] = $resultAlb['id'];
                $resultLoc['url'] = $arrayImg['url'];
                   //$resultLoc['id_imagem']=$resultImg['id'];
                    if($resultLoc['sucess']==true)
                {
                     $arraynot=array('ativo'=>'s','msg'=>'cadastro de local','cat'=>$resultLoc['id']);
                   $this->Insert($arraynot,'notificacao'); 
                }
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
            return $this->Update($obj, array('cod_local' => $obj->cod_local), 'locais_temp');
        }
    }
public function saveAdmin(Locais $obj) {
        if (empty($obj->cod_local)) {
            unset($obj->cod_local);
             unset($obj->id_album);
         
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_loc' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
                if ($keys == 'nome_loc' || $keys == 'nome_img_loc' || $keys == 'url') {
                    $arrayImg[$keys] = $values;
                }
            }
            try {
                $resultAlb = $this->saveAlbum($arrayImg);
                //$resultImg = $this->saveImg($arrayImg, $resultAlb);

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'locais');
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
          unset($obj->data_cad_loc);
          unset($obj->url);
           foreach($obj as $key=>$value){
          //var_dump($obj);
         
          if(!empty($value) ||  !is_null($value) || $value){
              $array[$key] = $value;
          }
      }
            $result =  $this->Update($array, array('cod_local' => $obj->cod_local), 'locais');
            $result['id_album'] = $id_album;
            return $result;
        }
    }
    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_loc']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }

    public function saveImg($a, $b) {
        $arrayImg = array('caminho_img' => $a['url'] . $b['id'] . '/' . $a['nome_img_loc'], 'album_id_album' => $b['id'],'tipo_album'=>'local');

        $result = $this->Insert($arrayImg, 'imagens');
        return $result;
    }
     public function getlist(){
        return $this->Select("SELECT * FROM locais where fakedelete <> 1");  
    }
    public function get($obj){
        $query = $this->First($this->Select("SELECT * FROM locais INNER JOIN imagens ON locais.id_album = imagens.album_id_album WHERE cod_local = '$obj' and locais.fakedelete <> 1"));
         $imgrelac = $this->Select("SELECT * FROM locais INNER JOIN imagens ON locais.id_album = imagens.album_id_album WHERE locais.tipo_local = ".$query->tipo_local." and imagens.tipo_album = 'local' and locais.fakedelete <> 1 GROUP BY locais.id_album ");
        $query->tipo_local = $imgrelac;
        $caminho =  $this->Select("SELECT caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
       $query->caminho_img = $caminho;
        /*  ------------------------------ quando as imagens tiverem todo inplementados ---------------------------------------*/
       /*
        $imagens = $this->Select("SELECT * FROM imagens where album_id_album in (select id_album from locais_temp where cod_local = '$obj' )");
       */
    
        return $query;
    }
    public function getLocal($obj){
          //$query = $this->First($this->Select("SELECT * FROM locais WHERE cod_local = '{$obj->cod_local}'"));
        $query = $this->First($this->Select("SELECT * FROM locais INNER JOIN imagens ON locais.id_album = imagens.album_id_album WHERE cod_local = '$obj->cod_local' and locais.fakedelete <> 1"));
           $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album'");
       if(count($query) < 1 ){
        $query = $this->First($this->Select("SELECT * FROM locais WHERE cod_local = '$obj->cod_local'"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album = 0 ");
       
        }
              $query->caminho_img = $caminho;
        $this->setObject($obj, $query);
    }
    public function Remove(Locais $obj){
    if(empty($obj->cod_local)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('cod_local'=>$obj->cod_local),'locais');
}
public function CarregarTipo(){
    $sql = "SELECT * FROM tiposlocal";
   return $query = $this->Select($sql);
}
}
