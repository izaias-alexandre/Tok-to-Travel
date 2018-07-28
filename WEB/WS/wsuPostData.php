<?php
  $hostname = '179.188.16.2';
 $username = 'toktotraveldb';
 $password = null;
 $password1 = 'Tokto*3000';
 $database = 'usuario';
 $database1 = 'tok';
 $database2 = 'toktotraveldb';
  $database3 = 'toktotraveldb';
  $charset = 'utf8';
      
        try{
        $con = new PDO("mysql:host=".$hostname.";dbname=".$database2,$username,$password1);
        $con->exec("set names ".$charset);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $ex){
        die($ex->getMessage());   
    }
   

 
  $Nome_user = $_GET['Nome_user'];
  $Email_user = $_GET['Email_user'];
  $Senha_user = $_GET['Senha_user'];

  
      //$con=connection();
      try{
       $state = $con->prepare("INSERT INTO usuario (nome_user,email_user,senha_user,tipo_user) VALUES('".$Nome_user ."','".$Email_user ."','".$Senha_user ."','USUARIO')");
       $state->execute();
        $state = $con->prepare("SELECT last_insert_id() as last FROM usuario");
           $state->execute();
           $last = $state->fetchObject();
        echo $last->last;
          
     
      } catch (PDOException $ex) {
         echo "erro";
      } 