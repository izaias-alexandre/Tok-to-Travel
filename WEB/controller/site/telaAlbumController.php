<?php

namespace controller\site;

use lib\Controller;
use api\imagens\apiImagens;
use api\telaAlbum\apitelaAlbum;
use model\Upload;

class telaAlbumController extends Controller{
    
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
       
    public function album($obj){
    $api = new apitelaAlbum();
    $met = $api->carregarAlbum($obj);
    return $met;
    }

    public function save(){
           $objImagem = new Upload();
                   $move = $objImagem->uploadImagem('POST');     
            $this->dados = array('return'=>$move);
              echo "<script>
window.history.back(); 
</script>";
    }
}