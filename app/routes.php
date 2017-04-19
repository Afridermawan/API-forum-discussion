<?php

use App\Middleware\GuestMiddleware;
use App\Middleware\AuthMiddleware;

$app->group('', function () use ($app, $container){
  $app->post('/api/auth/signin', 'App\Controllers\UserController:postSignIn')->add(new AuthMiddleware($container));
  $app->post('/api/auth/signup', 'App\Controllers\UserController:postSignUp');
})->add(new GuestMiddleware($container));

$app->group('', function () use ($app){
  $app->get('/', 'App\Controllers\HomeController:index')->setName('home');

  $app->get('/api/tread/list', 'App\Controllers\TreadController:listTread')->setName('list.Tread');

  $app->post('/api/tread/add', 'App\Controllers\TreadController:createTread');

  $app->put('/api/tread/edit/{id}', 'App\Controllers\TreadController:editTread');

  $app->delete('/api/tread/delete/{id}', 'App\Controllers\TreadController:softDelete');

  $app->post('/api/tread/{id}/comment', 'App\Controllers\CommentController:postComment');
})->add(new GuestMiddleware($container));
