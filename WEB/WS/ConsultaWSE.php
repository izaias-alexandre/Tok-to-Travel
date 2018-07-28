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
   

    header("Content-Type: application/json");
      //$con=connection();
      try{
       $state = $con->prepare("SELECT `cod_evento`,`nome_evento`,`data_evento`,`hr_evento`,`evento_CEP`,`evento_end`,`evento_nro`,`evento_comp`,`evento_bairro`,`id_album`,`evento_cidade`,`avaliacao`,`nota`,`categoria`,`fakedelete`,`desc_evento`, CONCAT('http://toktotravel.tecnologia.ws/', i.caminho_img) as nome_img_evento FROM eventos as e INNER JOIN imagens as i on e.id_album = i.album_id_album WHERE e.fakedelete <> 1 GROUP by e.id_album ");
          
          $state->execute();
      } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      } 
      $array = array();
      while ($row = $state->fetchObject()){
       
          
            $array[]=$row;
      }
      
      
      echo json_encode($array,JSON_UNESCAPED_UNICODE);
      




