<?php

namespace model;

use lib\Model;
class Upload extends Model{

        public function __construct() {
            parent::__construct();
    }

    public function uploadImagem($obj){
        $url =  $_POST['url'];
        $id_alb = $_POST['id_alb'];
        $tipo = $_POST['tipo'];
$mkdir =$url.$id_alb.'/';
      if(!is_dir($mkdir)){ 
	mkdir($mkdir, 0777);
      }
      
            $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
            
	for ($controle = 0; $controle < count($arquivo['name']); $controle++){
		 $destino = $url.$id_alb.'/'.$arquivo['name'][$controle];
		//$destino = $diretorio."/".$arquivo['name'][$controle];
		if(move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){
                    $this->Insert(array('album_id_album'=>$id_alb,'caminho_img'=>$destino,'tipo_album'=>$tipo), 'imagens');
			$msg = "Upload realizado com sucesso<br>"; 
		}else{
			$msg = "Erro ao realizar upload";
		}
		
	}
      return $msg;
        
}
}


