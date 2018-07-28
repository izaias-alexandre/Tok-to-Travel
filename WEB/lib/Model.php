<?php

namespace lib;


use PDO;
use PDOException;

class Model extends Config{
    protected $con;
    

  public function __construct() {
      
        try{
       $this->con = new PDO("mysql:host=".self::hostname.";dbname=".self::database3,self::username,self::password1);
        $this->con->exec("set names ".self::charset);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
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
    
    public function Insert($obj,$table){
       try{
       // var_dump($obj);
            $sql = "INSERT INTO {$table} (".\implode(",",\array_keys((array)$obj)).") VALUES ('".\implode("','",\array_values((array)$obj))."')";
          //var_dump($sql);
           $state = $this->con->prepare($sql);
           $state->execute();
           
           return array('id'=>$this->Last($table),'sucess'=>true);
       } catch (Exception $ex) {
           
           die($ex->getMessage(). " ".$sql);
       }
       
       }
     public function Update($obj,$condicion,$table){
         
         try{
  
             foreach($condicion as $ind => $val){
                 $where[]="`{$ind}`".(is_null($val) ? "IS NULL" : "= '{$val}'"); 
             }
             if(isset($obj->id_user)){
             $id=$obj->id_user;
             unset($obj->id_user);
             }elseif (isset($obj->cod_local)) {
             $id=$obj->cod_local;   
             unset($obj->cod_local);
            }elseif (isset ($obj->cod_evento)) {
               $id= $obj->cod_evento;
               unset($obj->cod_evento);
            } else {
            $id = '';    
            }
            unset($obj->url);
             
             foreach($obj as $ind => $val){
                 $dados[]="`{$ind}` =".(is_null($val) ? "NULL" : "'{$val}'"); 
             }
             
              $sql = "UPDATE {$table} SET ".implode(',',$dados)." WHERE ".implode('AND',$where);
              //echo $sql;
              $state = $this->con->prepare($sql);
           $state->execute(array('widgets'));
            if(isset($obj->nome_user))
                { 
            $varnome= $obj['nome_user'];
                
                }else{
                    $varnome='';
                    
                }
       return array('sucess'=>true,'feedback'=>'','usuario'=>$varnome,'id'=>$id);
                 
         } catch (\PDOException $ex) {
        die($ex->getMessage(). " ".$sql);
       }
       
    }
    public function Delete($condicion,$table){
        try{
            foreach($condicion as $ind => $val){
                $where[]="`{$ind}`".(is_null($val) ? "IS NULL" : "='{$val}'");
            }
            $sql = "DELETE FROM {$table} WHERE".implode('AND',$where);
         $state = $this->con->prepare($sql);
           $state->execute(array('widgets'));
           return array('sucess'=>true,'feedback'=>'');
            } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
    }
    public function FakeDelete($condicion,$table){
        try{
            foreach($condicion as $ind => $val){
                $where[]="`{$ind}`".(is_null($val) ? "IS NULL" : "='{$val}'");
            }
              $sql = "UPDATE {$table} SET fakedelete = 1 WHERE ".implode('AND',$where);
         $state = $this->con->prepare($sql);
           $state->execute(array('widgets'));
           return array('sucess'=>true,'feedback'=>'');
            } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        
    }
    public function Last($table){
        try{
           $state = $this->con->prepare("SELECT last_insert_id() as last FROM {$table}");
           $state->execute();
           $state = $state->fetchObject();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $state->last;
    }
    
    public function First($obj){
       if(isset($obj[0])){
           return $obj[0];
       }else{
           return null;
       }
    }
    
    public function setObject($obj,$values,$exits=true){
        if(is_object($obj)){
            if(count($values)>0){
                foreach ($values as $in => $va){
                    if(property_exists($obj, $in) || $exits){
                     $obj->$in = $values->$in;
                 }   
                }
            }
        }
    }
}
        



