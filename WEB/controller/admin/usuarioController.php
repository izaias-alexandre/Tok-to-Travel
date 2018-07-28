<?php

namespace controller\admin;
use lib\Controller;
use object\usuario\Usuario;
use api\usuario\apiUsuario;
use helper\Seguranca;
use model\Email;
  
class usuarioController extends Controller{
    public function __construct() {
        parent::__construct();
         $seg = new Seguranca();
        $seg->admin();
        $this->layout = '_layoutADM';
   
    }

    public function index() {
        $api = new apiUsuario();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view('index');
        
        
    }
    public function formCadastro(){
         $Usuario = new Usuario();
        $Usuario->id_user = $this->getParams(0);
        $api = new apiUsuario();
        $api->get($Usuario);
        $this->dados = array('dados'=>$Usuario);
        $this->view();      
    }

    public function save(){
        $api = new \api\usuario\apiUsuario();
       $query= $api->save(new \object\usuario\Usuario('POST'));
       $this->dados= array('return'=>$query['id']);
      /*$email = new Email();
      $Usuario = new Usuario();
        $Usuario->id_user = $this->$query['id'];
        $api = new apiUsuario();
        $api->get($Usuario);
      $email->enviarEmail($Usuario);*/
      
               $this->view();
    }
    public function excluir(){
        $Usuario = new Usuario;
        $Usuario->id_usuario  = $this->getParams(0);
        $Usuario->nome = $this->getParams(1);
        $this->dados=array('dados'=>$Usuario);
        $this->view();    
    }
    public function confirmaexcluir(){
       $Usuario = new Usuario;
        $Usuario->id_user  = $this->getParams(0);
        $Usuario->nome_user = $this->getParams(1); 
    
        $api= new apiUsuario();
        $query = $api->Remove($Usuario);
        $this->dados = array('dados'=>$Usuario, 'return'=>$query);
        $this->view();
    }
    public function vips() {
        $api = new apiUsuario();
        $this->dados = array(
        'list'=>$api->getVips()
         );
         $this->view();
        
    }
      public function parceiro() {
        $api = new apiUsuario();
        $this->dados = array(
        'list'=>$api->getParceiro()
         );
         $this->view();
        
    }
}