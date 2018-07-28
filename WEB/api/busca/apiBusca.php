<?php

namespace api\busca;
use lib\Model;

/*if($_POST['Busca']=="true"){
    $api= new apiBusca;
 $api->buscarLocal($_POST['texto']);
}*/


 
class apiBusca extends Model {
   
      

    public function carregarDataList1(){
         $sql="SELECT nome_loc FROM locais where fakedelete <> 1";
         $query = $this->Select($sql);
         return $query;
        
    }
    public function BuscarLocal($campo){
        $pesquisar = $campo;
  $sqllocal ="SELECT * FROM locais INNER JOIN imagens ON locais.id_album = imagens.album_id_album WHERE nome_loc  LIKE '%$pesquisar%' and locais.fakedelete <> 1 GROUP BY locais.id_album";
  $sqlcategoria ="SELECT nome_loc FROM tipo_local WHERE tipo_local = (SELECT id_cat FROM categoria WHERE nome_cat  LIKE '$pesquisar%')";
  $query = $this->Select($sqllocal);
  if(count($query) >0){
             return $query;
            foreach ($query as $locais){
          //echo "Local Pesquisado: ".$locais->nome_loc;
  }
  }
  /*else{
    $query = $this->Select($sqlcategoria);
  if(count($query) > 0){
      foreach ($query as $locais){
          return "Local Pesquisado: ".$locais->nome."<br>";
    }
    }*/
    else{
      return "Nenhum resultado encontrado";  
    }
  }
       
   }
    
 
//}