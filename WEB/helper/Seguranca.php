<?php

namespace helper;
class Seguranca{
    public function usuario() {
        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) ){
          header('location:'.APP_ROOT.'site/login');
          
        }
    }
     public function admin() {
        if (!isset($_SESSION['adm']) || empty($_SESSION['adm']) ){
          header('location:'.APP_ROOT.'admin/sessao');
          
        }
    }
    
}

