<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TravelController;

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

$router->get('/viajes', 'TravelController@index');

$router->get('/viaje/{id}', 'TravelController@show');

$router->post('/viaje', 'TravelController@store');

$router->put('/viaje/{id}', 'TravelController@update');

$router->delete('/viaje/{id}', 'TravelController@destroy');

$router->get('/viajes', 'TravelController@filtrar');




