<?php
session_start();

   date_default_timezone_set('America/Sao_Paulo');
  //Criar a conexao
$servidor = "179.188.16.2";
  $usuario = "toktotraveldb";
  $senha = "Tokto*3000";
  $dbname = "toktotraveldb";
  
  //Criar a conexao
  $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
        
       // session_start();
  
$data['atual'] = date('Y-m-d H:i:s');
  
  //Diminuir 1 minuto, contar usuário no site no último minuto
  //$data['online'] = strtotime($data['atual'] . " - 1 minutes");
  
  //Diminuir 20 segundos 
  $data['online'] = strtotime($data['atual'] . " - 10 seconds");
  $data['online'] = date("Y-m-d H:i:s",$data['online']);
  
 
    if (!isset($_SESSION['visitante'])) {
    //Salvar no banco de dados
      $result_visitas = "INSERT INTO visitas (data_inicio, data_final)VALUES ('".$data['atual']."', '".$data['atual']."')";
    
    $resultado_visitas = mysqli_query($conn, $result_visitas);
    
    $_SESSION['visitante'] = mysqli_insert_id($conn);
  }

if(isset($_POST['contar'])){
  
   if (isset($_SESSION['visitante']) && !empty($_SESSION['visitante'])) {
    
  
   $result_up_visita = "UPDATE visitas SET data_final = '" . $data['atual'] . "' WHERE id = '" . $_SESSION['visitante'] . "'";
    
    $resultado_up_visitas = mysqli_query($conn, $result_up_visita);
     
     $result_qnt_visitas = "SELECT count(id) as online FROM visitas WHERE data_final >= '" . $data['online'] . "'";
  $resultado_qnt_visitas = mysqli_query($conn,$result_qnt_visitas);
   $row_qnt_visitas = mysqli_fetch_assoc( $resultado_qnt_visitas);
     
  $resultado_qnt_usuarios = mysqli_query($conn,"SELECT count(id_user) as id FROM usuario where tipo_user = 'USUARIO' and fakedelete <> 1");
   $row_qnt_user =  mysqli_fetch_assoc( $resultado_qnt_usuarios);
     
       $resultado_qnt_vip = mysqli_query($conn,"SELECT count(id_user) as id FROM usuario where tipo_user = 'VIP' and  fakedelete <> 1");
   $row_qnt_vip =  mysqli_fetch_assoc( $resultado_qnt_vip );
     $resultado_qnt_par = mysqli_query($conn,"SELECT count(id_user) as id FROM usuario where tipo_user = 'PARCEIRO' and  fakedelete <> 1");
   $row_qnt_par =  mysqli_fetch_assoc( $resultado_qnt_par );
          $resultado_qnt_user = mysqli_query($conn,"SELECT count(id_user) as id FROM usuario where fakedelete <> 1 ");
   $row_qnt_usuarios = mysqli_fetch_assoc( $resultado_qnt_user );
          $resultado_qnt_user = mysqli_query($conn,"SELECT count(id_user) as id FROM usuario where fakedelete <> 1");
   $row_qnt_usuarios = mysqli_fetch_assoc( $resultado_qnt_user );
          $resultado_qnt_local = mysqli_query($conn,"SELECT count(cod_local) as id FROM locais where fakedelete <> 1");
   $row_qnt_locais = mysqli_fetch_assoc( $resultado_qnt_local );
          $resultado_qnt_eventos = mysqli_query($conn,"SELECT count(cod_evento) as id FROM eventos where fakedelete <> 1");
   $row_qnt_event = mysqli_fetch_assoc( $resultado_qnt_eventos );
               $resultado_qnt_atracoes = mysqli_query($conn,"SELECT count(id_atr) as id FROM atracoes where fakedelete <> 1");
   $row_qnt_atr = mysqli_fetch_assoc( $resultado_qnt_atracoes );
     //var_dump(  $row_qnt_usuarios);
  echo $row_qnt_visitas['online'].','.$row_qnt_user ['id'].','.$row_qnt_vip ['id'].','.$row_qnt_par ['id'].','.$row_qnt_usuarios ['id'].','.$row_qnt_locais['id'].','.$row_qnt_event['id'].','.$row_qnt_atr['id'];
    
  }
    
     
  
  }
  
  
   


header('Content-Type: text/html; charset=utf-8');

require_once 'helper/Bootstrap.php';
//define('RAIZ_PATH', 'MVCv5');
define('APP_ROOT', 'http'.(isset($_SERVER['HTTPS']) ? (($_SERVER['HTTPS']=="on") ? "s" : "") : "").'://' . $_SERVER['HTTP_HOST'] . '/');

use lib\System;

$System = new System();
$System->run();

