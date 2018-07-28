<?php

namespace api\session;

use lib\Model;
use object\sessao\Sessao;

class apiSessao extends Model{
    public function logarId($id){
         $sql = "SELECT * FROM usuario WHERE id_user = '{$id}' ";
         $query = $this->First($this->Select($sql));
          $_SESSION['usuario'] = $query->nome_user;
             $_SESSION['id']=$query->id_user;
             $_SESSION['tipo']=$query->tipo_user;
              header('location:'.APP_ROOT.'');
    }
 public function logar(Sessao $obj){
     $user = trim($obj->usuario);
     $pass = trim($obj->senha);
     
     $sql = "SELECT * FROM usuario WHERE email_user = '{$user}' ";
     
     $query = $this->First($this->Select($sql));
     //var_dump($query);
     if($query->fakedelete ==1 || $query->status_user=='inativo'){
          $_SESSION['msg'] = "Usuario Bloqueado";
             //echo "<script> window.location.href='".APP_ROOT."site/login/'; </script>";
                header('location:'.APP_ROOT.'site/login');
     }else{
     if(isset($query->senha_user)){
         if($pass == $query->senha_user){
        
             
          
             $_SESSION['usuario'] = $query->nome_user;
             $_SESSION['id']=$query->id_user;
             $_SESSION['tipo']=$query->tipo_user;
              //$_SESSION['msg'] = "Usuario logado com sucesso";
            
           header('location:'.APP_ROOT.'');
         }else{
            
              $_SESSION['msg'] = "Login ou senha inválido";
             //echo "<script> window.location.href='".APP_ROOT."site/login/'; </script>";
                header('location:'.APP_ROOT.'site/login');
         }
         }else{
       
              $_SESSION['msg'] = "Login ou senha inválido";
                    header('location:'.APP_ROOT.'site/login');
         
         
             
         }
 }
 }    
          public function logarAdmin(Sessao $obj){
     $user = trim($obj->usuario);
     $pass = trim($obj->senha);    
     $sql = "SELECT * FROM administrador WHERE nome_adm = '{$user}' ";
     $query = $this->First($this->Select($sql));
        if($query->fakedelete==1 || $query->status_adm =='inativo'){
          $_SESSION['msg'] = "Usuario Bloqueado";
            
                 header('location:'.APP_ROOT.'admin/sessao');
     }else{
     if(isset($query->senha_adm)){
         if($pass == $query->senha_adm){
             $_SESSION['adm'] = $query->senha_adm;
             $_SESSION['id']=$query->id_adm;
              //$_SESSION['msg'] = "Usuario logado com sucesso";
            
           header('location:'.APP_ROOT.'admin/home');
         }else{
            
              $_SESSION['msg'] = "Login ou senha inválido";
             //echo "<script> window.location.href='".APP_ROOT."site/login/'; </script>";
                header('location:'.APP_ROOT.'admin/sessao');
         }
         }else{
       
              $_SESSION['msg'] = "Login ou senha inválido";
                    header('location:'.APP_ROOT.'admin/sessao');   
         }
     }

          }      
    
public function deslogar(){
    if(isset($_SESSION['usuario'])){
    unset($_SESSION['usuario']);  
    }
    if(isset($_SESSION['adm'])){
        unset($_SESSION['adm']);  
    }
    unset($_SESSION['id']);
    unset($_SESSION['tipo']);
    header('location:'.APP_ROOT);
    
}    
}