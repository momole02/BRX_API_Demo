<?php 


/**
 * brx_funds_balance.php
 * ---
 * Robot de test de l'API Bitrevex 
 *  	=> Affiche les informations sur le solde de l'utilisateur 
*/
include("brx_api_key.php");


$url = "https://bitrevex.com/api/v1/funds?_key=$API_KEY";

$data = [
	"jsonrpc" => "2.0",
	"id"=>1,
	"method"=>"getBalance",
	"params" =>[
		"type" => 2, /* balance trade (voir la doc pour plus d'informations) */
		"symbol" => "RVC"
	]
];
$channel = curl_init();
curl_setopt($channel, CURLOPT_URL, $url);
curl_setopt($channel , CURLOPT_POST , count($data));
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($channel , CURLOPT_RETURNTRANSFER , TRUE);

$rawResponse = curl_exec($channel);
$response = json_decode( $rawResponse ,TRUE);

$result = $response['result'];
//var_dump($response['result']);

print "Raw balance : ".$result['raw_balance']."\n";
print "Balance  : ".$result['balance']."\n";
print "Frozen raw balance  : ".$result['raw_in_order']."\n";
print "Frozen balance  : ".$result['in_order']."\n";
print "Symbol :   : ".$result['symbol']."\n";
