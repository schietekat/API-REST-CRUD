<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/holaMundo', function () use ($router) {
    return "Hola mundo!!";
});

$router->get('/hola', ["uses" =>
    "UserController@index"
]);

$router->get('/manchego', ["uses" =>
    "UserController@tipoQueso"
]);

$router->get('/key', function(){
    return str_random(32);
});

$router->post('/createUser', ["uses" =>
    "UserController@postUser"
]);

$router->post('/laquequieran', ["uses" =>
    "UserController@comoQuieran"
]);

$router->get('/login', ["uses" => "UserController@login"]);

//Grupo de rutas para usar el authGuard
$router->group(['middleware' => ['auth']],function() use ($router){
//Rutas que vamos a checar

$router->get('/users', ["uses" =>
    "UserController@indexUsers"
]);

$router->get('/user/{id}', ["uses" =>
    "UserController@getUser"
]);

$router->delete('/user/{id}', ["uses" =>
    "UserController@deleteUser"
]);

$router->put('/user/{id}', ["uses" =>
    "UserController@updateUser"
]);

});

/////////////POSTS/////////////////

//crear un post
$router->post('/post', ["uses" =>
    "PostController@createPost"
]);

//update post
$router->put('/post/{id}', ["uses" =>
    "PostController@updatePost"
]);

//obtener todos los posts
$router->get('/posts', ["uses" =>
    "PostController@getPosts"
]);

//obtener post por id
$router->get('/post/{id}', ["uses" =>
    "PostController@getPostsByID"
]);

//Obtener posts de un usuario con su ID
$router->get('/posts/user/{id}', ["uses" =>
    "PostController@getPostsByUserID"
]);

//Borrar un post con su id
$router->delete('/post/{id}', ["uses" =>
    "PostController@deletePost"
]);

//upload image
$router->post('/file', ["uses" =>
    "PostController@uploadFile"
]);


////////COMENTARIOS///////////////

$router->post('/comment', ["uses" =>
    "CommentController@createComment"
]);

$router->put('/comment/{id}', ["uses" =>
    "CommentController@updateComment"
]);

$router->delete('/comment/{id}', ["uses" =>
    "CommentController@deleteComment"
]);

$router->get('/comments', ["uses" =>
    "CommentController@getComments"
]);

$router->get('/comments/{id}', ["uses" =>
    "CommentController@getCommentsByID"
]);

$router->get('/comments/user/{id}', ["uses" =>
    "CommentController@getCommentsByUserID"
]);

$router->get('/comments/post/{id}', ["uses" =>
    "CommentController@getCommentsByPostID"
]);

/////////////////LIKES/////////////////////////////

$router->post('/like', ["uses" =>
    "LikeController@createLike"
]);

$router->put('/like/{id}', ["uses" =>
    "LikeController@updateLike"
]);

$router->delete('/like/{id}', ["uses" =>
    "LikeController@deleteLike"
]);

$router->get('/like', ["uses" =>
    "LikeController@getLikes"
]);

$router->get('/like/{id}', ["uses" =>
    "LikeController@getLikesByID"
]);

$router->get('/like/user/{id}', ["uses" =>
    "LikeController@getLikesByUserID"
]);

$router->get('/like/post/{id}', ["uses" =>
    "LikeController@getLikesByPostID"
]);
