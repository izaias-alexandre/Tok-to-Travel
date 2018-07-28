<?php

namespace model;

class Notificacoes {
    

const hostname = '179.188.16.2';
const username = 'toktotraveldb';
const password = null;
const password1 = 'Tokto*3000';
const database = 'usuario';
const database1 = 'tok';
const database2 = 'aula';
const database3 = 'toktotraveldb';
const charset  = 'utf8';
      
       public function __construct() {
      
        try{
        $this->con = new \PDO("mysql:host=".self::hostname.";dbname=".self::database3,self::username,self::password1);
        $this->con->exec("set names ".self::charset);
        $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $ex){
        die($ex->getMessage());   
    }
   
}
    public function Select($sql){
      try{
          $state = $this->con->prepare($sql);
          $state->execute();
      } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      } 
      $array = array();
      while ($row = $state->fetchObject()){
            $array[]=$row;
      }
      
      return $array;
    }
    
    public function Verificar(){
    $cont=$this->Select("SELECT * FROM notificacao WHERE ativo LIKE 's' ");
    $contador =count($cont);
    if($contador==0){
        echo '<span class="">0</span>';
    }
    else{
        echo '<span class="">'.$contador.' </span>';
    }
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET') { // aqui é onde vai decorrer a chamada se houver um *request* POST
    $not = new Notificacoes;
    $not->Verificar();
}