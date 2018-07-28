<?php

namespace controller\site;

use lib\Controller;
use api\usuario\apiUsuario;
use api\imagens\apiImagens;

class planoVipsController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
     
    }
     
    public function index(){
        $this->view();
    }
    public function criarVip(){
        $api = new apiUsuario();
        $api->criarVip();
    }
    public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
}