<?php

function COP_Login($server, $port, $user, $password, $scenarioid) {

	$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://' . $server . ':' + $port + '/coplanner/Token',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => 'grant_type=password&username=' . $user . '&password=' . $password . '&language_id=0&entity_id=1&scenario_id=' . $scenarioid . '&culture_name=de-DE&client_type=Web',
		CURLOPT_HTTPHEADER => array(
		'content-type: application/x-www-form-urlencoded',
		'Authorization: Basic'
		),
		));

		$response = curl_exec($curl);

	curl_close($curl);

	$token = json_decode($response, true);

	return $token;
}

function COP_getSession($server, $port, $token) {

	$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://' . $server . ':' + $port + '/coplanner/api/v1.0/session',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
		'content-type: application/json',
		'Authorization: Bearer ' . $token['access_token']
		),
		));

		$response = curl_exec($curl);

	curl_close($curl);

	$session = json_decode($response, true);
	$sessionId  = $sessionId['sessionId'];
	
	return $sessionId;
}

?>