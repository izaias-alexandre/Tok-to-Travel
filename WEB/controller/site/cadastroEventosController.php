<?php

namespace controller\site;
use lib\Controller;
use api\imagens\apiImagens;
use api\eventos\apiEventos;
use object\eventos\Eventos;
use model\Upload;
use helper\Seguranca;
use api\eventos\apiEventosTemp;

class cadastroEventosController extends Controller{
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
        $api = new apiEventos();
       $query = $api->save(new Eventos('POST'));
       $this->dados = array('return'=>$query['id_album'],'id'=>$query['id']);
               $this->view();
    }
    public function saveimg(){
           $objImagem = new Upload();
                   $move = $objImagem->uploadImagem('POST');
          $Eventos = new Eventos();
        $Eventos->cod_evento = $this->getParams(0);
        $api = new apiEventosTemp();
        $api->getEventos($Eventos);
        $this->dados = array('dados'=>$Eventos,'return'=>$move);
        $this->view();
    }
   public function CarregarTipo(){
      $api = new apiEventos();
return $api->CarregarTipo();
      
    }

}


