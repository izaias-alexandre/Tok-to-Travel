<?php

namespace controller\admin;
use lib\Controller;
use object\atracoes\Atracoes;
use api\atracoes\apiAtracoes;
use api\local\apiLocais;
use helper\Seguranca;
use model\Upload;

class atracoesController extends Controller{
    public function __construct() {
        parent::__construct();
         $seg = new Seguranca();
        $seg->admin();
        $this->layout = '_layoutADM';
        
    }

    public function index() {
        $api = new apiAtracoes();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view('index');
        
        
    }
    public function formCadastro(){
         $Locais = new Atracoes();
        $Locais->id_atr = $this->getParams(0);
        $api = new apiAtracoes();
        $api->getAtracao($Locais);
        $this->dados = array('dados'=>$Locais);
        $this->view();      
    }

    public function save(){
        $api = new apiAtracoes();
       $query= $api->saveAdmin(new Atracoes('POST'));
       $this->dados = array('return'=>$query['id_album']);
               $this->view();
    }
    public function excluir(){
        $Locais = new Atracoes();
        $Locais->id_atr  = $this->getParams(0);
        $Locais->nome_atr = $this->getParams(1);
        $this->dados=array('dados'=>$Locais);
        $this->view();    
    }
    public function confirmaexcluir(){
       $Locais = new Atracoes();
        $Locais->id_atr  = $this->getParams(0);
        $Locais->nome_atr = $this->getParams(1); 
    
        $api= new apiAtracoes();
        $query = $api->Remove($Locais);
        $this->dados = array('dados'=>$Locais, 'return'=>$query);
        $this->view();
    }
         public function saveimg(){
           $objImagem = new Upload();
                   $move = $objImagem->uploadImagem('POST');
      
$this->dados = array('return'=>$move);
              $this->view();
    }
    public function CarregarLocais(){
        $api = new apiLocais();
        return  $api->getlist();
    }

}

