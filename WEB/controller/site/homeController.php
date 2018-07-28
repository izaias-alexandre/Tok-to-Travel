<?php

namespace controller\site;

use lib\Controller;
use api\busca\apiBusca;
use api\imagens\apiImagens;



class homeController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layoutHome';
     
    }
     
    public function index(){
        $this->view();
    }
    public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
    

    public function carregarDataList(){
        $api = new apiBusca;
        $nomes = $api->carregarDataList1();
        return $nomes;
        
    }
    public function carregarImagens(){
        $api = new apiImagens;
        $img = $api->carregarImagens();
        return $img;

    }
    public function carregarBusca($campo){
         $api = new apiBusca();
        $img = $api->BuscarLocal($campo);
        return $img;
    }
}