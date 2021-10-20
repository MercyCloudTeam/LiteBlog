<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['middleware'=>'page-cache'],function ()use ($router){
    $router->get('/','BlogController@index');
    $router->get('/p/{title}',['uses'=>'BlogController@postsTitle','as'=>'posts']);
    $router->get('/{postId}','BlogController@postsId');

    $router->get('/tags/{tag:name}',['uses'=>'BlogController@tags']);
    $router->get('/{category/{category}',['uses'=>'BlogController@category']);
});

$router->group(['middleware'=>['token-validate'],'prefix'=>'/api'],function ()use($router){
    $router->group(['prefix'=>'/posts'],function ()use($router){
        $router->get('/','PostsController@show');
        $router->get('/{post}','PostsController@detail');
        $router->post('/{post}','PostsController@update');
        $router->post('/','PostsController@store');
        $router->delete('/{post}','PostsController@delete');
    });
});

