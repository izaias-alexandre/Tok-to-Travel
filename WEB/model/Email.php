<?php
namespace model;

class Email{
  public $emaildestino;
  public $emailorigem;
  public $assunto;
  public $messagem;

  public function enviarEmail(){

mail($this->emaildestino, $this->assunto, $this->messagem);
  }
}
