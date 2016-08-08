<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

//eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

//auth
$client = new Google_Client($container['settings']['auth']);
$client->addScope(\Google_Service_Oauth2::USERINFO_PROFILE);
$client->addScope(\Google_Service_Oauth2::USERINFO_EMAIL);

$container['auth'] = function ($c) use ($client) {
	return $client;
};