<?php

namespace controller\site;

use lib\Controller;
use api\busca\apiBusca;
use api\imagens\apiImagens;
use api\contatos\apiContatos;
use object\contato\contatos;

class contatosController extends Controller{
    
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

        $api = new apiContatos();
        $cont = $api->save(new contatos('POST'));
        if($cont['sucess']==true){
                         $msg='Enviado com sucesso';     
        }else{
            $msg='erro';     
        }
        $this->dados = array('return'=>$msg); 
    $this->view();
    }
}