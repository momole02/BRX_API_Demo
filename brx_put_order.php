<?php 


/**
 * bot_put_order.php
 * ---
 * Robot de test de l'API Bitrevex 
 *  	=> Place un ordre de vente dans le marche RVC/BTC 
*/
include("brx_api_key.php");

$url = "https://bitrevex.com/api/v1/trade?_key=$API_KEY";

$data = [
	"jsonrpc" => "2.0",
	"id"=>1,
	"method"=>"sendOrder",
	"params" =>[
		"want_symbol" => "RVC", 	/* crypto de gauche(demande) */
		"offer_symbol" => "BTC",	/* crypto droite (offre) */
		"type" => "LIMIT", 			/* type(  LIMIT ou MARKET) */
		"side" => "ASK", 			/* side (BID ou ASK) */
		"price" => "0.00000125",	/* prix  */
		"amount" => "200", 			/* quantité */
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

print "Status : ".$result['status']."\n";
print "Engine message : ".$result['message']."\n";