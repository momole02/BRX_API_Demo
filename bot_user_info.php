<?php

/**
 * bot_user.php
 * ---
 * Robot de test de l'API Bitrevex 
 *  	=> Ecrit les informations de l'utilisateur dans la console
*/

include("bot_api_key.php");

/**
 * Effectue une requete pour afficher les informations de l'utilisateur
*/
$url = "https://bitrevex.com/api/v1/user?_key=$API_KEY";

$data = [
	"jsonrpc" => "2.0",
	"id"=>1,
	"method"=>"getUserInfo",
	"params" =>[
		"list_referrals" => true,
		"show_level_info" => true
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

print "* ID : ".$result['user']['id']."\n";
print "* Email : ".$result['user']['email']."\n";
print "* Referral Code : ".$result['user']['referral_code']."\n";
print "* Inscription date : ".$result['user']['inscription_date']."\n";
print "* Referrals counts : ".$result['user']['referrals_count']."\n";
print "* Level : ".$result['user']['level']."\n\n";
print "##########################################\n";
print "Referrals :\n";
print "##########################################\n";
foreach( $result['referrals'] as $ref_info ){
	print "\t".$ref_info['id']." - ".$ref_info['email']."\n";
}
