<?php

namespace controller\site;

use lib\Controller;
use api\session\apiSessao;
use object\sessao\Sessao;
use api\imagens\apiImagens;

class loginController extends Controller{
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
    public function validar(){
        $api = new apiSessao();
        $api->logar(new Sessao('POST'));
        
    }
    public function Sair(){
        $api = new apiSessao();
        $api->deslogar();
    }
    public function loginfacebook(){
           $this->view();

    }
}