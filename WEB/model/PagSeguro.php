<?php

$pedido = preg_replace('/[^[:alnum:]-]/','',$_POST["idPedido"]);
$plano = $_POST["plano"];
$valor = $_POST["valor_pgto"];

$data['token'] ='29AC8BBAEB8947D98E640875567CDCDC';
$data['email'] = 'izaiasalexandre13@gmail.com';
$data['currency'] = 'BRL';
$data["itemId1"] = '1';
$data["itemQuantity1"] = '1';
$data['itemDescription1'] = $plano;
$data['itemAmount1'] = $valor;
$data['reference'] = $pedido;


$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml= curl_exec($curl);
if($xml == 'Unauthorized'){
$return = 'Não Autorizado';
echo $return;
exit;
}
curl_close($curl);


$xml= simplexml_load_string($xml);
if(count($xml -> error) > 0){
$return = 'Dados Inválidos '.$xml ->error-> message;
echo $return;
exit;
}
echo $xml -> code;

