<?php
// Routes
use App\Controllers\AuthController;
use App\Controllers\PostController;

$auth = new AuthController($app);
$post = new PostController($app);


$app->get('/', [$post, 'index'])->setName('home');

/*
 * OAuth
 */
$app->get('/login', [$auth, 'login'])->setName('login');
$app->get('/auth', [$auth, 'auth'])->setName('auth');
$app->get('/logout', [$auth, 'logout'])->setName('logout');
/*
 * User Managment
 */
$app->post('user',[$auth, 'updateUser'] ])
	->setName('update-user')->add('auth');
/*
 * Post managment
 */
    /*
     * Editing
     */
$app->group('/post', function () use ($app) {
	$app->post('create', [$post, 'createPost'] ])->setName('create-post');
	$app->post('update/{id:[0-9]+}',[$post, 'updatePost'] ])->setName('update-post');
	$app->get('private/{id:[0-9]+}',[$post, 'privatePost'] ])->setName('private-post');
	$app->get('delete/{id:[0-9]+}',[$post, 'deletePost' ]])->setName('delete-post');
})->add('auth');
    /*
     * Read 
     */
$app->get('read/{id:[0-9]+}',[$post, 'readPost']])->add('read-post');
$app->get('edit/{id:[0-9]+}',[$post, 'editPost']])->add('edit-post');
$app->get('{nickname}/[{page:[0-9]+}]', [$post, 'blog']])->add('blog');
