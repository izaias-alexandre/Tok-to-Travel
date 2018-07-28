<?php

namespace controller\site;

use lib\Controller;
use api\busca\apiBusca;
use api\imagens\apiImagens;



class sobreController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
     
    }
     
    public function index(){
        $this->view('sobre');
    }
    public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
}