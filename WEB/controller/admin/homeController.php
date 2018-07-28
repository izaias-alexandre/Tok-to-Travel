<?php

namespace controller\admin;

use lib\Controller;
use helper\Seguranca;

class homeController extends Controller{
    public function __construct() {
        parent::__construct();
        
          $seg = new Seguranca();
        $seg->admin();
         $this->layout='_layoutADM';
    }

    public function  index(){
        $this->view();
    }
}

