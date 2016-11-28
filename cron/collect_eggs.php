<?php

include __DIR__.'/vendor/autoload.php';
use Guzzle\Http\Client;

// create our http client (Guzzle)
$http = new Client('http://coop.apps.knpuniversity.com', array(
    'request.options' => array(
        'exceptions' => false,
    )
));

// run this code *before* requesting the eggs-collect endpoint
$request = $http->post('/token', null, array(
	'client_id'     => 'Kalles lazy CRON job',
	'client_secret' => '915479378bc88d0dd641172cd5f3e762',
	'grant_type'    => 'client_credentials',
));

// make a request to the token url
$response = $request->send();
$responseBody = $response->getBody(true);
$responseArr = json_decode($responseBody, true);
$accessToken = $responseArr['access_token'];

$request = $http->post('/api/1201/eggs-collect');
$request->addHeader('Authorization', 'Bearer '.$accessToken);
$response = $request->send();
echo $response->getBody();

echo "\n\n";