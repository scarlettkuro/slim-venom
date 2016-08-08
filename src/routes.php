<?php
// Routes
use App\Controllers\HomeController;

$a = new HomeController($app);

$app->get('/[{name}]', [$a, 'index']);
