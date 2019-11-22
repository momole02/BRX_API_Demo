<?php 


/**
 * brx_24.php
 * ---
 * Robot de test de l'API Bitrevex 
 *  	=> Recuperer les données OHLC du marché RVC/BTC 
*/
include("brx_api_key.php");

$url = "https://bitrevex.com/api/v1/public";

$data = [
	"jsonrpc" => "2.0",
	"id"=>1,
	"method"=>"get24h",
	"params" =>[
		"want_symbol" => "RVC", 	/* crypto de gauche(demande) */
		"offer_symbol" => "BTC",	/* crypto droite (offre) */
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

print "High : ".$result['highest']." BTC \n";
print "Low : ".$result['lowest']." BTC \n";
print "Open : ".$result['open']." BTC \n";
print "Close : ".$result['closing']." BTC \n";
print "Volume: ".$result['volume']." RVC \n";
print "Change: ".$result['change']." %\n";
