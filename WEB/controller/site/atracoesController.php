<?php

namespace controller\site;
use lib\Controller;
use object\atracoes\Atracoes;
use api\atracoes\apiAtracoes;
use api\local\apiLocais;
use helper\Seguranca;
use api\imagens\apiImagens;
use model\Upload;

class atracoesController extends Controller{
    public function __construct() {
        parent::__construct();

      $this->layout='_layout';
        $this->view();
    }

    public function index() {
       $api = new apiAtracoes();
        $id=$this->getParams(0);
        $img = $api->get($id);
        //var_dump($img);
        return $img;
        
        
        
    }
    public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }


    

}

