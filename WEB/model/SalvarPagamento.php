<?php

//namespace model;
//var_dump($_POST);
$dados = array( 'id_usuario'=>$_POST["Usuario_id_userpgto"],
'plano' => $_POST["plano"],
'valor_pgto'=>$_POST["valor_pgto"],
'data_pedido'=>$_POST["data_pedido"]);
//var_dump($dados);
 $conn = new conecta();
 
 $conn->salvarPedido($dados);

$pedido = $conn->consultarUltimoPedido();
 
echo $pedido;

class conecta{
 const hostname = 'localhost';
const username = 'root';
const password = null;
const password1 = '123456';
const database = 'usuario';
const database1 = 'tok';
const database2 = 'aula';
const database3 = 'toktotravel_tcc';
const charset  = 'utf8';
      
       public function __construct() {
      
        try{
        $this->con = new \PDO("mysql:host=".self::hostname.";dbname=".self::database3,self::username,self::password1);
        $this->con->exec("set names ".self::charset);
        $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
    }catch(PDOException $ex){
        die($ex->getMessage());   
    }
   
}
 
 function salvarPedido($dados){
 $sql = "INSERT INTO pagamento (".\implode(",",\array_keys((array)$dados)).") VALUES ('".\implode("','",\array_values((array)$dados))."')";
       
           $state = $this->con->prepare($sql);
           $state->execute(array('widgets'));
 
 }
 
 function consultarPedido($reference){
 $stmt = $this->con->prepare("SELECT * FROM pedidos where id = :reference");
 $stmt->bindValue(":reference",$reference);
 $run = $stmt->execute();
 $rs = $stmt->fetch(\PDO::FETCH_ASSOC);
 return $rs; 
 
 }

 function atualizaPedido($reference, $status){
 $stmt = $this->con->prepare("UPDATE pedidos SET status = :status where id = :reference");
 $stmt->bindValue(":reference",$reference);
 $stmt->bindValue(":status",$status);
 $run = $stmt->execute();
 
 }
 
function listarPedidos(){
 $stmt = $this->con->prepare("SELECT p.descricao, p.id, s.status FROM pedidos as p INNER JOIN status_pedido as s on p.status = s.id order by p.id");
 $run = $stmt->execute();
 $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $rs; 
 
 }
 
 function consultarUltimoPedido(){
      $state = $this->con->prepare("SELECT last_insert_id() as last FROM pagamento");
           $state->execute();
           $state = $state->fetchObject();
 return $state->last;
 
 }

}