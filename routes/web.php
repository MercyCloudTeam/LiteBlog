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
    $router->get('/p/{posts}','BlogController@posts');
    $router->get('/tags/{tag}','BlogController@posts');
    $router->get('/category/{tag}','BlogController@posts');
//    $router->get('/posts/{posts.name}','BlogController@posts');
});

$router->group(['middleware'=>['token-validate','request-limit:60'],'prefix'=>'/api'],function ()use($router){
    $router->group(['prefix'=>'/posts'],function ()use($router){
        $router->get('/','PostsController@show');
        $router->get('/{posts}','PostsController@detail');
        $router->post('/','PostsController@store');
        $router->post('/{posts}','PostsController@update');
        $router->delete('/{posts}','PostsController@delete');
    });

});
