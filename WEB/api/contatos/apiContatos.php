<?php

namespace api\contatos;

use lib\Model;
use object\contato\contatos;


class apiContatos extends Model {

 public function save(contatos $obj) {

       $resultCont = $this->Insert($obj,'contatos');

        if($resultCont['sucess']==true)
               {
           //          chamar classe de email.
             
                     $arraynot=array('ativo'=>'s','msg'=>'formulario de contato','cat'=>$resultCont['id']);
                   $this->Insert($arraynot,'notificacao'); 
                }
                return $resultCont;
              }
                 public function getlist($id){
        return $this->Select("SELECT * FROM contatos where id = $id");  
    }
    }

