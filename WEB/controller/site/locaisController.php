<?php
namespace controller\site;

use lib\Controller;
use api\atracoes\apiAtracoes;
use api\imagens\apiImagens;
use api\local\apiLocais;
use api\parceiro\apiParceiro;



class locaisController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
        $this->view();
    }
     
    public function index(){
         
        $id = $this->getParams(0);
        $api = new apiLocais;
        $loc = $api->get($id);
        return $loc;
       
    }
    public function carregarAtracoes($id){
        $api = new apiAtracoes();
        $atr = $api->carregarAtracoes($id);
    return $atr;
    }
     public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;
    }
      public function Servico($id){
        $api = new apiParceiro();
        $atr = $api->carregarServicos($id);
    return $atr;
    }
    

  
}
