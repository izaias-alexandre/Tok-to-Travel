<?php

namespace controller\admin;
use lib\Controller;
use object\locais\Locais;
use api\local\apiLocais;
use helper\Seguranca;
use model\Upload;

class locaisController extends Controller{
    public function __construct() {
        parent::__construct();
         $seg = new Seguranca();
        $seg->admin();
        $this->layout = '_layoutADM';
        
    }

    public function index() {
        $api = new apiLocais();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view('index');
        
        
    }
    public function formCadastro(){
         $Locais = new Locais();
         if($this->getParams(0) != null){
        $Locais->cod_local = $this->getParams(0);
        $api = new apiLocais();
        $api->getLocal($Locais);
        
    }
         $this->dados = array('dados'=>$Locais);
        $this->view();      
    
    }

    public function save(){
        $api = new apiLocais();
       $query= $api->saveAdmin(new Locais('POST'));
       $this->dados = array('return'=>$query['id_album']);
               $this->view();
    }
    public function excluir(){
        $Locais = new Locais();
        $Locais->cod_local  = $this->getParams(0);
        $Locais->nome_loc = $this->getParams(1);
        $this->dados=array('dados'=>$Locais);
        $this->view();    
    }
    public function confirmaexcluir(){
       $Locais = new Locais();
        $Locais->cod_local  = $this->getParams(0);
        $Locais->nome_loc = $this->getParams(1); 
    
        $api= new apiLocais();
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

}

