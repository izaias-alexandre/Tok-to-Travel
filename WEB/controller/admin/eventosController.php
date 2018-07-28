<?php

namespace controller\admin;
use lib\Controller;
use object\eventos\Eventos;
use api\eventos\apiEventos;
use helper\Seguranca;
use model\Upload;

class eventosController extends Controller{
    public function __construct() {
        parent::__construct();
         $seg = new Seguranca();
        $seg->admin();
        $this->layout = '_layoutADM';

    }

    public function index() {
        $api = new apiEventos();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view('index');
        
        
    }
    public function formCadastro(){
         $Eventos = new Eventos();
         if($this->getParams(0) != null){
        $Eventos->cod_evento = $this->getParams(0);
        $api = new apiEventos();
        $api->getEventos($Eventos);
    }
        $this->dados = array('dados'=>$Eventos);
        $this->view();      
    }

    public function save(){
        $api = new apiEventos();
       $query= $api->saveAdmin(new Eventos('POST'));
    
     $this->dados = array('return'=>$query['id_album']);
               $this->view();
    }
    public function excluir(){
        $Eventos = new Eventos();
        $Eventos->cod_evento  = $this->getParams(0);
        $Eventos->nome_evento = $this->getParams(1);
        $this->dados=array('dados'=>$Eventos);
        $this->view();    
    }
    public function confirmaexcluir(){
       $Eventos = new Eventos();
        $Eventos->cod_evento = $this->getParams(0);
        $Eventos->nome_evento = $this->getParams(1); 
    
        $api= new apiEventos();
        $query = $api->Remove($Eventos);
        $this->dados = array('dados'=>$Eventos, 'return'=>$query);
        $this->view();
    }
    public function saveimg(){
           $objImagem = new Upload();
                   $move = $objImagem->uploadImagem('POST');
      
$this->dados = array('return'=>$move);
              $this->view();
    }

}

