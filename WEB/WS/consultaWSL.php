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
   

 
      //$con=connection();
      try{
       $state = $con->prepare("SELECT `cod_local`,`nome_loc`,`end_loc`,`cep_loc`,`nro_loc`,`data_cad_loc`,`desc_local`,`tipo_local`,`id_album`,`fakedelete`,`avaliacao`,`nota`,`comp_loc`,`bairro_loc`,`cidade_loc`, CONCAT('http://toktotravel.tecnologia.ws/', i.caminho_img) as nome_img_loc FROM locais as l INNER JOIN imagens as i on l.id_album = i.album_id_album WHERE l.fakedelete <> 1 GROUP by l.id_album ");
          
          $state->execute();
      } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      } 
      $array = array();
      while ($row = $state->fetchObject()){
          header("Content-Type: application/json");
          
            $array[]=$row;
      }
      
      
      echo json_encode($array,JSON_UNESCAPED_UNICODE);
      




