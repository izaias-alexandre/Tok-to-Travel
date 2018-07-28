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
    $cod_local = $_GET['Cod_evento'];
    $avaliacao = $_GET['Avaliacao'];
     $state = $con->prepare("SELECT nota,avaliacao FROM locais where cod_local = '".$cod_local."'");
           $state->execute();
           $avalia = $state->fetchObject();
    $notanova= $avalia->nota + $avaliacao;
  $avaliacaonova = $avalia->avaliacao + 1;
    $state = $con->prepare("UPDATE locais set avaliacao = '".$avaliacaonova."', nota = '".$notanova."' where cod_local = '".$cod_local."'");
          $state->execute();
   } catch (PDOException $ex) {
          die($ex->getMessage().' '.$sql);
      }
      }

 
  
  if(isset($_GET['Nome_loc']) && !empty($_GET['Nome_loc'])){
    
  $Nome_loc = $_GET['Nome_loc'];
  $Cep_loc = $_GET['Cep_loc'];
  $Bairro_loc = $_GET['Bairro_loc'];
  $Cidade_loc = $_GET['Cidade_loc'];
  $Desc_local = $_GET['Desc_local'];
  $End_loc = $_GET['End_loc'];
  $Nro_loc = $_GET['Nro_loc'];
    
try{
       $state = $con->prepare("INSERT INTO locais_temp (nome_loc,cep_loc,bairro_loc,cidade_loc,desc_local,end_loc,nro_loc) VALUES('".$Nome_loc."','".$Cep_loc."','".$Bairro_loc."','".$Cidade_loc."','".$Desc_local."','".$End_loc."','".$Nro_loc."')");
          
          $state->execute();
           $state = $con->prepare("SELECT last_insert_id() as last FROM locais_temp");
           $state->execute();
           $last = $state->fetchObject();
           
           $state = $con->prepare("INSERT INTO notificacao (ativo,msg,cat) values('s','cadastro de local','".$last->last."')");
          $state->execute();
       }
        catch (PDOException $ex) {
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
           
           $uploaddir = '../content/site/img/imagemLocais/'.$last->last.'';
          if(!is_dir($uploaddir)){
  mkdir($uploaddir, 0777);
}
       
        $uploadfile = $uploaddir.'/'.$file_name;
     
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
             $state = $con->prepare("INSERT INTO imagens(album_id_album,caminho_img,tipo_album) values ('".$last->last."','".$uploadfile."','local')");
          $state->execute();
          $state = $con->prepare("select max(cod_local) as id from locais_temp");
            $state->execute();
                    $ult_id = $state->fetchObject();
         // UPDATE `locais_temp` SET `id_album` = '175' WHERE `locais_temp`.`cod_local` = 49;
          $state = $con->prepare("UPDATE locais_temp set id_album = '".$last->last."' where cod_local = '".$ult_id->id."'" );
          $state->execute();
          $dataDB['status'] = 'sucesso';      
         } else {
            $dataDB['status'] =  'falhou';       
         }
         //$this->response($dataDB, 200);
            echo $dataDB['status'];
    
  }
