<?php

namespace controller\site;

use lib\Controller;
use api\imagens\apiImagens;
use object\parceiro\Parceiro;
use api\parceiro\apiParceiro;

class parceiroController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
     
    }
     
    public function index(){
        $this->view();
    }
    public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
    public function save(){
      $api = new apiParceiro();
      $cont = $api->save(new Parceiro('POST'));
              if($cont['sucess']==true){
                         $msg='Enviado com sucesso';     
        }else{
            $msg='Erro';     
        }
          $this->dados = array('return'=>$msg,'id'=>$cont['id']);
               $this->view();
        
    }
    
}

