<?php

namespace api\usuario;

use lib\Model;
use object\usuario\Usuario;


class apiUsuario extends Model{
   public function get(Usuario $obj){
        $query = $this->First($this->Select("SELECT * FROM usuario WHERE id_user = '{$obj->id_user}'"));
        $this->setObject($obj, $query);
    }
    public function getlist(){
        return $this->Select("SELECT * FROM usuario where fakedelete <> 1");  
    }
public  function save(Usuario $obj){
   if(empty($obj->id_user)){
       unset($obj->id_user);
       $resultAlb = $this->saveAlbum('VIP'.'-'.$obj->nome_user);
       $obj->id_album = $resultAlb['id'];
       return $this->Insert($obj, 'usuario') ;
   }else{
        if($obj->senha_user == ''){
              unset($obj->senha_user); 
          }
      foreach($obj as $key=>$value){
          //var_dump($obj);
         
          if(!empty($value) ||  !is_null($value) || $value){
              $array[$key] = $value;
          }
      }

       //var_dump($array);
       //var_dump( $array);
        return $this->Update($array, array('id_user' =>$array['id_user']),'usuario'); 
       
   } 
}
 public function saveAlbum($a) {
        $arrayAlbum = array('nome_album' => $a);

        $result = $this->Insert($arrayAlbum, 'albumimg');

        return $result;
    }
public function Remove(Usuario $obj){
    if(empty($obj->id_user)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('id_user'=>$obj->id_user),'usuario');
}
public function criarVip($id_user){
   return $this->Update(array('tipo_user' => 'VIP'),array('id_user' =>$array['id_user']),'usuario');
}
 public function getVips(){
        $dados = $this->Select("SELECT * FROM pagamento where fakedelete <> 1");
   
        return $dados;   
    }
     public function getParceiro(){
        $dados = $this->Select("SELECT * FROM parceiro where fakedelete <> 1 and status_par = 'ativo'");
        return $dados;   
    }
    

}

