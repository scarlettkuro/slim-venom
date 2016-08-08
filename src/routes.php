<?php
// Routes
use App\Controllers\AuthController;

$auth = new AuthController($app);

$app->get('/login', [$auth, 'login']);
$app->get('/auth', [$auth, 'auth']);
$app->get('/', [$auth, 'index']);

