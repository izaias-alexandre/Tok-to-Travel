<?php 

namespace api\atracoes;
use object\atracoes\Atracoes;
use lib\Model;

class apiAtracoes extends Model{
    public function carregarAtracoes($id){
               $sql =  "SELECT * FROM atracoes Left JOIN imagens ON atracoes.id_album = imagens.album_id_album WHERE Local_id_localatr = $id and imagens.tipo_album = 'atracao' and atracoes.fakedelete <> 1 group by atracoes.nome_atr  " ;
         //$sql =  "SELECT * FROM atracoes WHERE Local_id_localatr = $id" ;
        $query = $this->Select($sql);
       // var_dump($query);
        return $query;
    }
        public function get($id){
                $sql =  "SELECT * FROM atracoes INNER JOIN imagens ON atracoes.id_album = imagens.album_id_album WHERE id_atr = $id GROUP BY atracoes.id_album" ;
        $query = $this->Select($sql);
        return $query;
    }
    public function getAtracao($obj){
                $query = $this->First($this->Select("SELECT * FROM atracoes  WHERE id_atr = '$obj->id_atr' and fakedelete <> 1"));
        $caminho =  $this->Select("SELECT id_img,caminho_img FROM imagens WHERE album_id_album ='$query->id_album' and tipo_album='atracao'");
       $query->caminho_img = $caminho;
        $this->setObject($obj, $query);
    }
      public function getlist(){
        return $this->Select("SELECT * FROM atracoes where fakedelete <> 1");  
    }
     public function saveAdmin(Atracoes $obj) {
         
        if (empty($obj->id_atr)) {
            unset($obj->id_atr);
            unset($obj->id_album);
            foreach ($obj as $keys => $values) {
                if ($keys != 'nome_img_atr' && $keys != 'url') {
                    $arrayLocais[$keys] = $values;
                }
                if ($keys == 'nome_atr' || $keys == 'nome_img_atr' || $keys == 'url') {
                    $arrayImg[$keys] = $values;
                }
            }
            try {
                $resultAlb = $this->saveAlbum($arrayImg);
                

                $arrayLocais['id_album'] = $resultAlb['id'];
                $resultLoc = $this->Insert($arrayLocais, 'atracoes');
                $resultLoc['id_album'] = $resultAlb['id'];
                $resultLoc['url'] = $arrayImg['url'];
            
                return $resultLoc;
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        } else {
             $id_album = $obj->id_album;
            unset($obj->id_album);
            unset($obj->nome_img_atr);
          unset($obj->url);
           foreach($obj as $key=>$value){
          //var_dump($obj);
         
          if(!empty($value) ||  !is_null($value) || $value){
              $array[$key] = $value;
          }
      }
           $result = $this->Update( $array, array('id_atr' => $obj->id_atr), 'atracoes');
               $result['id_album'] = $id_album;
            return $result;
        }
    }

    public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a['nome_atr']);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }
        public function Remove($obj){
    if(empty($obj->id_atr)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('id_atr'=>$obj->id_atr),'atracoes');
}
}

