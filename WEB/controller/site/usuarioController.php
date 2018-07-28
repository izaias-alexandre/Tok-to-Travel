<?php


namespace controller\site;
use lib\Controller;
use object\usuario\Usuario;
use api\usuario\apiUsuario;
use api\imagens\apiImagens;

class usuarioController extends Controller{
     public function __construct() {
        
         parent::__construct();
        
    }
    public function formCadastro(){
          $this->view(); 

             
    }
        public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
     public function index() {
        $api = new apiUsuario();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view();
        
        
    }
     public function formCadastrox(){
        $Usuario = new Usuario();
        $this->id_usuario = $this->getParams(0);
        $api = new apiUsuario();
        $api->get($Usuario);
        $this->dados= array('dados'=>$Usuario);
        $this->view();        
    }

    public function save(){
        $api = new apiUsuario();
       $query = $api->save(new Usuario('POST'));
       $this->dados = array('return'=>$query);
               $this->view();
    }
    public function excluir(){
        $Usuario = new Usuario;
        $Usuario->id_usuario  = $this->getParams(0);
        $Usuario->nome = $this->getParams(1);
        $this->dados=array('dados'=>$Usuario);
        $this->view();    
    }
    public function confirmarExclusao(){
       $Usuario = new Usuario;
        $Usuario->id_usuario  = $this->getParams(0);
        $Usuario->nome = $this->getParams(1); 
    
        $api= new apiUsuario();
        $query = $api->delete($Usuario);
        $this->dados = array('dados'=>$Usuario, 'return'=>$query);
        $this->view();
    }

 
}
