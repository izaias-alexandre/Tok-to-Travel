<?php

namespace controller\site;

use lib\Controller;
use api\imagens\apiImagens;
use api\eventos\apiEventos;
use api\avaliacao\apiAvalia;
use object\avaliacao\avaliacao;


class eventosController extends Controller{
    
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
        $this->view();
    }
     
    public function index(){
       
    }
        public function carregarFooter(){
        $api = new apiImagens;
        $img = $api->carregarFooter();
        return $img;

    }
    
    public function carregarEventos(){
        $api = new apiImagens;
        $img = $api->carregarEventos();
        return $img;

    }
    public function eventos(){
      
        $id = $this->getParams(0);
        $api = new apiEventos;
        $eve = $api->get($id);
        return $eve;
        
    }
    public function avalia(){
        $api = new apiAvalia();
        $ava = $api->Avaliar(new avaliacao('POST'));
      echo "<script>
window.history.back(); 
</script>";
 
    
}
}