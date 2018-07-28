<?php

namespace controller\site;

use lib\Controller;

class cadastroController extends Controller{
    public function __construct() {
        parent::__construct();
    
        $this->layout='_layout';
    }
    public function index(){
        $this->view();
    }
}