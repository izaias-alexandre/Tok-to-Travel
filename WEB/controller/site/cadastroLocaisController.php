<?php

namespace controller\site;
use lib\Controller;
use object\locais\Locais;
use api\local\apiLocais;
use api\imagens\apiImagens;
use model\Upload;
use helper\Seguranca;
use api\local\apiLocaisTemp;
class cadastroLocaisController extends Controller{
    public function __construct() {
        parent::__construct();
   $seg = new Seguranca(); 
      $seg->usuario();
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
        $api = new apiLocais();
       $query = $api->save(new Locais('POST'));
       $this->dados = array('return'=>$query['id_album'],'id'=>$query['id']);
               $this->view();
    }
    public function saveimg(){
           $objImagem = new Upload();
                   $move = $objImagem->uploadImagem('POST');     
           $Locais = new Locais();
        $Locais->cod_local = $this->getParams(0);
        $api = new apiLocaisTemp();
        $api->getLocal($Locais);
        $this->dados = array('dados'=>$Locais,'return'=>$move);
        $this->view();  
    }
    public function CarregarTipo(){
      $api = new apiLocais();
return $api->CarregarTipo();
      
    }
    
   
    
}

