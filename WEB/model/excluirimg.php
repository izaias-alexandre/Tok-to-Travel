<?php

namespace model;
  
//use lib\Model;
  
class excluirimg {
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
/*const hostname = '179.188.16.2';
const hostname1 = 'localhost';
const username = 'toktotraveldb';
const username1 = 'root';
const password = null;
const password1 = 'Tokto*3000';
const password2 = '123456';
const database = 'usuario';
const database1 = 'toktotravel_tcc';
const database2 = 'aula';
const database3 = 'toktotraveldb';

const charset  = 'utf8';*/
      
//class Upload extends Model{

     /*   public function __construct() {
            parent::__construct();
    }*/
       /*public function __construct() {
      
   try{
       $this->con = new PDO("mysql:host=".self::hostname.";dbname=".self::database3,self::username,self::password1);
        $this->con->exec("set names ".self::charset);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $ex){
        die($ex->getMessage());   
    }
   
}*/
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
    
    public function excluir($id){
    return $this->Delete(array('id_img'=>$id),'imagens');
}
}


// aqui é onde vai decorrer a chamada se houver um *request* POST
$id_img = $_POST['altx'];
$api =  new excluirimg();
$med = $api->excluir($id_img);
if($med['sucess']==true){
  echo $id_img;
    echo 'sucesso'.' '.$id_img;
}
else{
    echo 'naão';
}

