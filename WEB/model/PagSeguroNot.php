<?php
 header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
 
$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

$data['token'] ='29AC8BBAEB8947D98E640875567CDCDC';
$data['email'] = 'izaiasalexandre13@gmail.com';

$data = http_build_query($data);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

$reference = $xml->reference;
$status = $xml->status;

if($reference && $status){
 
 $conn = new conecta();

 $rs_pedido = $conn->consultarPedido($reference);

 if($rs_pedido){
     
 $conn->atualizaPedido($reference,$status,$notificationCode);
 }
}

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
        $this->con = new \PDO("mysql:host=".self::hostname.";dbname=".self::database3,self::username,self::password);
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
 $stmt = $this->con->prepare("SELECT * FROM pagamento where id = $reference");
 $stmt->execute();
 $rs = $stmt->fetch(\PDO::FETCH_ASSOC);
 return $rs; 
 
 }

 function atualizaPedido($reference, $status,$transasao){
 $stmt = $this->con->prepare("UPDATE pagamento SET status = $status, trasacao = $transasao where id = $reference");
 

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

