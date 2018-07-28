<?php

namespace controller\site;
use lib\Controller;
use object\usuario\Usuario;
use api\usuario\apiUsuario;
use api\session\apiSessao;
use api\imagens\apiImagens;

class cadastroUsuarioController extends Controller{
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
        $api = new apiUsuario();
       $query = $api->save(new Usuario('POST'));
       $api_log = new apiSessao();
       $api_log->logarId($query['id']);
       //$this->dados = array('return'=>$query['id']);
         //      $this->view();
    }
}

