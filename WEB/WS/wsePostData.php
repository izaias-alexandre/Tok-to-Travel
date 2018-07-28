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
if(isset($_GET['Avaliacao']) && !empty($_GET['Avaliacao'])){
  try{
    $cod_evento = $_GET['Cod_evento'];
    $avaliacao = $_GET['Avaliacao'];
     $state = $con->prepare("SELECT nota,avaliacao FROM eventos where cod_evento = '".$cod_evento ."'");
           $state->execute();
           $avalia = $state->fetchObject();
    $notanova= $avalia->nota + $avaliacao;
  $avaliacaonova = $avalia->avaliacao + 1;
    $state = $con->prepare("UPDATE eventos set avaliacao = '".$avaliacaonova."', nota = '".$notanova."' where cod_evento = '".$cod_evento."'");
          $state->execute();
   } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      }
      }

if(isset($_GET['Nome_evento']) && !empty($_GET['Nome_evento'])){
  $Nome_evento = $_GET['Nome_evento'];
  $Evento_CEP = $_GET['Evento_CEP'];
  $Evento_bairro = $_GET['Evento_bairro'];
  $Evento_cidade  = $_GET['Evento_cidade'];
  $Desc_evento = $_GET['Desc_evento'];
  $Evento_end = $_GET['Evento_end'];
  $Evento_nro = $_GET['Evento_nro'];
  $Hr_evento = $_GET['Hr_evento'];
  $Data_evento = $_GET['Data_evento'];
  
      //$con=connection();
      try{
       $state = $con->prepare("INSERT INTO eventos_temp (nome_evento,evento_CEP,evento_bairro,evento_cidade,desc_evento,evento_end,evento_nro,hr_evento,data_evento) VALUES('".$Nome_evento."','".$Evento_CEP."','".$Evento_bairro."','".$Evento_cidade."','".$Desc_evento."','".$Evento_end."','".$Evento_nro."','".$Hr_evento."','".$Data_evento."')");
       $state->execute();
         $state = $con->prepare("SELECT last_insert_id() as last FROM eventos_temp");
           $state->execute();
           $last = $state->fetchObject();
           
           $state = $con->prepare("INSERT INTO notificacao (ativo,msg,cat) values('s','cadastro de eventos','".$last->last."')");
          $state->execute();
          
     
      } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      } 
 }
   if(isset($_FILES['file'])){
           $file_name = _($_FILES['file']['name']);
         
           $state = $con->prepare("INSERT into albumimg (nome_album) values ('".$file_name."')");
           $state->execute();
           $state = $con->prepare("SELECT last_insert_id() as last FROM albumimg");
           $state->execute();
           $last = $state->fetchObject();
           
           $uploaddir = '../content/site/img/imgevento/'.$last->last.'';
          if(!is_dir($uploaddir)){
  mkdir($uploaddir, 0777);
}
       
        $uploadfile = $uploaddir.'/'.$file_name;
     
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
             $state = $con->prepare("INSERT INTO imagens(album_id_album,caminho_img,tipo_album) values ('".$last->last."','".$uploadfile."','evento')");
          $state->execute();
          $state = $con->prepare("select max(cod_evento) as id from eventos_temp");
            $state->execute();
                    $ult_id = $state->fetchObject();
         // UPDATE `locais_temp` SET `id_album` = '175' WHERE `locais_temp`.`cod_local` = 49;
          $state = $con->prepare("UPDATE eventos_temp set id_album = '".$last->last."' where cod_evento = '".$ult_id->id."'" );
          $state->execute();
          $dataDB['status'] = 'sucesso';      
         } else {
            $dataDB['status'] =  'falhou';       
         }
         //$this->response($dataDB, 200);
            echo $dataDB['status'];
    
  }
        