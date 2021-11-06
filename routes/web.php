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
    //首页
    $router->get('/','BlogController@index');

    //友链
    $router->get('/links',['uses'=>'BlogController@links','as'=>'links']);

    //分组
    $router->get('/categories',['uses'=>'BlogController@categories','as'=>'categories']);
    $router->get('/category/{category}',['uses'=>'BlogController@category','as'=>'category']);

    //标签
    $router->get('/tags/{tag}',['uses'=>'BlogController@tag' ,'as'=>'tag']);
    $router->get('/tags',['uses'=>'BlogController@tags','as'=>'tags']);

    //文章
    $router->get('/p/{title}',['uses'=>'BlogController@postsTitle','as'=>'posts']);
    $router->get('/posts/{id}',['uses'=>'BlogController@postsId','as'=>'postsId']);
    $router->get('/uuid/{uuid}',['uses'=>'BlogController@postsUUID','as'=>'postsUUID']);

    $router->get('/s/{code}',['uses'=>'BlogController@shoreLink','as'=>'shoreLink']);//短连接


    //作者
    $router->get('/author/{name}',['uses'=>'BlogController@author','as'=>'author']);
});

$router->group(['middleware'=>['token-validate'],'prefix'=>'/api'],function ()use($router){
    $router->group(['prefix'=>'/posts'],function ()use($router){
        $router->get('/','PostsController@show');
        $router->get('/{post}','PostsController@detail');
        $router->post('/{post}','PostsController@update');
        $router->post('/','PostsController@store');
        $router->delete('/{post}','PostsController@delete');
    });
    $router->group(['prefix'=>'/file'],function ()use($router){
        $router->post('/upload','FileController@upload');
    });
});

//$router->get('/ip',['']);

