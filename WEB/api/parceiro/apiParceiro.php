<?php
namespace api\parceiro;

use lib\Model;
use object\parceiro\Parceiro;
use object\servico\Servico;

class apiParceiro extends Model{
public  function save(Parceiro $obj){
   if(empty($obj->id_par)){
       unset($obj->id_par);
       $obj->status_par = 'inativo';
      
       $resultLoc = $this->Insert($obj, 'parceiro') ;
         if($resultLoc['sucess']==true)
              {
                 $arraynot=array('ativo'=>'s','msg'=>'cadastro de parceiro','cat'=>$resultLoc['id']);
                   $this->Insert($arraynot,'notificacao'); 
                }
                return $resultLoc;
   }else{
      foreach($obj as $key=>$value){
          if(!empty($value) ||  !is_null($value)){
              $array[$key] = $value;
          }
      }
       
       //var_dump( $array);
        return $this->Update($array, array('id_par' =>$array['id_par']),'parceiro'); 
       
   } 
}
   public function getlist($id){
        return $this->Select("SELECT * FROM parceiro where fakedelete <> 1 and id_par = $id");  
    }
    public function carregarServicos($id){

        return $this->Select("SELECT * FROM servico_dos_parceiros inner join parceiro on servico_dos_parceiros.Parceiro_id_par = parceiro.id_par where servico_dos_parceiros.Local_id_local = $id AND servico_dos_parceiros.fakedelete <> 1 and servico_dos_parceiros.status_serv = 'ativo' ");  
    }

    public function Remove(Parceiro $obj){
    if(empty($obj->id_par)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('id_par'=>$obj->id_par),'parceiro');
}
public  function saveServico($obj){
   if(empty($obj->id_serv)){
       unset($obj->id_serv);
       
       //var_dump($obj);
       $resultLoc = $this->Insert($obj, 'servico_dos_parceiros') ;
         if($resultLoc['sucess']==true)
                {
                     $arraynot=array('ativo'=>'s','msg'=>'cadastro de servico','cat'=>$resultLoc['id']);
                   $this->Insert($arraynot,'notificacao'); 
                }
                return $resultLoc;
   }else{
        foreach($obj as $key=>$value){
          if(!empty($value) ||  !is_null($value)){
              $array[$key] = $value;
          }
      }
       
       var_dump( $array);
       unset($array["con"]);
        return $this->Update($array, array('id_serv' =>$array['id_serv']),'servico_dos_parceiros'); 
       
       
   }
 }
 public function getlistServico($id){
      return $this->Select("SELECT * FROM servico_dos_parceiros where fakedelete <> 1 and id_serv = $id");
      
 }
 public function RemoveServico(Servico $obj){
    if(empty($obj->id_serv)){
        return array('sucess'=>false,'feedback'=>'Registro não informado!');
    }
   return $this->FakeDelete(array('id_serv'=>$obj->id_serv),'servico_dos_parceiros');
}
}
