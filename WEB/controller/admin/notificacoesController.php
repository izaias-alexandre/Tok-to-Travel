<?php

namespace controller\admin;
use lib\Controller;
use object\eventos\Eventos;
use object\locais\Locais;
use api\local\apiLocaisTemp;
use api\eventos\apiEventosTemp;
use api\not\apiNot;
use api\contatos\apiContatos;
use api\parceiro\apiParceiro;
use object\parceiro\Parceiro;
use api\usuario\apiUsuario;
use helper\Seguranca;
use object\servico\Servico;

class notificacoesController extends Controller{
    public function __construct() {
        parent::__construct();
         $seg = new Seguranca();
        $seg->admin();
        $this->layout = '_layoutADM';

        
    }
    public function index(){
      $api = new apiNot();
        $this->dados = array(
        'list'=>$api->getlist()
         );
         $this->view();
    }

    public function Locais() {
        $id = $this->getParams(0);
        $api1 = new apiLocaisTemp();
        $this->dados = array(
        'list'=>$api1->getlist($id)
         );
         $this->view();
        
        
    }
    public function Eventos(){
           $id = $this->getParams(0);
         $api = new apiEventosTemp();
        $this->dados = array(
        'list'=>$api->getlist($id)
         );
        
         $this->view();
    }
    public function Parceiro(){
                  $id = $this->getParams(0);
         $api = new apiParceiro();
        $this->dados = array(
        'list'=>$api->getlist($id)
         );
        
         $this->view();
    }
    public function parceiro_servico(){
                     $id = $this->getParams(0);
         $api = new apiParceiro();
        $this->dados = array(
        'list'=>$api->getlistServico($id)
         );
        
         $this->view();
    }

    public function formLocais(){
         $Locais = new Locais();
         $Locais->cod_local = $this->getParams(0);
        $action= $this->getParams(1);
        $api = new apiLocaisTemp();
        $api->getLocal($Locais);
        $this->dados = array('dados'=>$Locais, 'acao'=>$action);
        $this->view();      
    }
        public function formEventos(){
      $Eventos = new Eventos();
        $Eventos->cod_evento = $this->getParams(0);
         $action= $this->getParams(1);
        $api = new apiEventosTemp();
        $api->getEventos($Eventos);
        $this->dados = array('dados'=>$Eventos,'acao'=>$action);
        $this->view();  
    }
    public function saveEventos(){
               $api = new apiEventosTemp();
               $query= $api->saveAdmin(new Eventos('POST'));
               if($query['sucess']==true){
            $this->finaliza($this->getParams(0));
        }
               $this->dados= array('return'=>$query['id']);
               $this->view();
    }

    public function saveLocais(){
        $api = new apiLocaisTemp();
       $query= $api->saveAdmin(new Locais('POST'));
             if($query['sucess']==true){
            $this->finaliza($this->getParams(0));
        }
        //var_dump();
       $this->dados= array('return'=>$query['id']);
               $this->view();
    }
      public function saveParceiro(){
        $api = new apiParceiro();
        $par = new Parceiro();
        $par->id_par = $this->getParams(0);
        $par->status_par = 'ativo';
       $query= $api->save($par);
             if($query['sucess']==true){
                  $list = $api->getlist($par->id_par);
                  $obj = array('email_user'=>$list[0]->email_par,'senha_user'=>$list[0]->senha_par,'tipo_user'=>'PARCEIRO','nome_user'=>$list[0]->nome_par,'id_parceiro'=>$list[0]->id_par);
                  $api1 = new apiUsuario();
                  $api1->Insert($obj, 'usuario') ;
                  
            $this->finaliza($this->getParams(2));
        }
        //var_dump();
       $this->dados= array('return'=>$query['id']);
               $this->view();
    }
         public function saveServico(){
        $api = new apiParceiro();
        $serv = new Servico();
        $serv->id_serv = $this->getParams(0);
        $serv->status_serv = 'ativo';
       /* $serv =array('id_serv'=>$this->getParams(0),
        'status_serv' => 'ativo');*/
       $query= $api->saveServico($serv);
             if($query['sucess']==true){
                  
            $this->finaliza($this->getParams(1));
        }
        //var_dump();
       $this->dados= array('return'=>$query['id']);
               $this->view();
    }
 
    public function excluirLocais(){
       $Locais = new Locais();
        $Locais->cod_local  = $this->getParams(0);
        $Locais->nome_loc = $this->getParams(1); 
   
        $api= new apiLocaisTemp();
        $query = $api->Remove($Locais);
          if($query['sucess']==true){
            $this->finaliza( $this->getParams(2));
        }
        $this->dados = array('dados'=>$Locais, 'return'=>$query);
        $this->view();
    }
    public function excluirParceiro(){
           $Parceiro = new Parceiro();
        $Parceiro->id_par  = $this->getParams(0);
        $Parceiro->nome_par = $this->getParams(1); 
   
        $api= new apiParceiro();
        $query = $api->Remove($Parceiro);
          if($query['sucess']==true){
            $this->finaliza( $this->getParams(2));
        }
        $this->dados = array('dados'=>$Parceiro, 'return'=>$query);
        $this->view();
    }
        public function excluirServico(){
       $servico= new Servico();
        $servico->id_serv  = $this->getParams(0);
        $servico->nome_serv = $this->getParams(1); 
   
        $api= new apiParceiro();
        $query = $api->RemoveServico($servico);
          if($query['sucess']==true){
            $this->finaliza( $this->getParams(2));
        }
        $this->dados = array('dados'=>$Parceiro, 'return'=>$query);
        $this->view('parceiro_servico');
    }
    public function excluirEventos(){
        $Eventos = new Eventos();
        $Eventos->cod_evento = $this->getParams(0);
        $Eventos->nome_evento = $this->getParams(1); 
    
        $api= new apiEventosTemp();
        $query = $api->Remove($Eventos);
        if($query['sucess']==true){
            $this->finaliza($this->getParams(2));
        }
        $this->dados = array('dados'=>$Eventos, 'return'=>$query);
        $this->view();
    }
    public function finaliza($id){ 
        $api= new apiNot();
        $api->Finalizar($id);
                    //echo "<script>window.history.back();</script>";
        
    }
    public function contatos(){
         $id = $this->getParams(0);
         $api = new apiContatos();
        $this->dados = array(
        'list'=>$api->getlist($id)
         );
        
        $this->finaliza($this->getParams(1));
         $this->view();
    }
   }
    




