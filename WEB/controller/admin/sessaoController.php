<?php

namespace controller\admin;

use lib\Controller;
use api\session\apiSessao;
use object\sessao\Sessao;

class sessaoController extends Controller{
    public function index(){
        $this->layout = "_layout.login";
        $this->view();
    }
    public function logout(){
   $api = new apiSessao();
   $api->deslogar();
    }
        
    public function validar(){
      $api =  new apiSessao();
      $api->logarAdmin(new Sessao('POST'));
    } 
}

