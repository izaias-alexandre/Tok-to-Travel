<?php

namespace controller\site;

use lib\Controller;
use api\imagens\apiImagens;
use object\usuario\Usuario;
use api\usuario\apiUsuario;
use api\parceiro\apiParceiro;
use object\servico\Servico;
use api\local\apiLocais;
use helper\Seguranca;


class perfilController extends Controller{
    
    public function __construct() {
        parent::__construct();    
        $this->layout='_layout';
     new Seguranca();
    }
     
    public function usuario(){
        $Usuario = new Usuario();
        $Usuario->id_user = $this->getParams(0);
        $api = new apiUsuario();
        $api->get($Usuario);
        $this->dados = array('dados'=>$Usuario);
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
       if($query['sucess'] == true){
       $this->dados = array('return'=>$query['usuario']);
               $this->view();
       }else{
            $this->dados = array('return'=>'Erro não foi possivel atualizar');
               $this->view();
       }
    }
       public function saveserv(){
        $api = new apiParceiro();
       $query = $api->saveServico($_POST);
       /*if($query['sucess'] == true){
       $this->dados = array('return'=>$query['usuario']);
               $this->view();
       }else{
            $this->dados = array('return'=>'Erro não foi possivel atualizar');
               $this->view();
       }*/
          $this->view();     
    }
     public function CarregarLocais(){
        $api = new apiLocais();
        return  $api->getlist();
    }
    
    
}

