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
$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);
$router->group(
    ['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->get('refsensor', 'RefSensorController@index');
        $router->get('refsensor/{id}', 'RefSensorController@show');
        $router->post('refsensor', 'RefSensorController@store');
        $router->put('refsensor/{id}', 'RefSensorController@update');
        $router->delete('refsensor/{id}', 'RefSensorController@destroy');

        $router->get('device', 'DeviceController@index');
        $router->get('device/{id}', 'DeviceController@show');
        $router->post('device', 'DeviceController@store');
        $router->put('device/{id}', 'DeviceController@update');
        $router->delete('device/{id}', 'DeviceController@destroy');

        $router->get('users', 'UsersController@index');
        $router->get('users/{id}', 'UsersController@show');
        $router->post('users', 'UsersController@store');
        

        $router->get('kandang', 'KandangController@index');
        $router->get('kandang/{id}', 'KandangController@show');
        $router->post('kandang', 'KandangController@store');
        $router->put('kandang/{id}', 'KandangController@update');
        $router->delete('kandang/{id}', 'KandangController@destroy');

        $router->get('sensor', 'SensorController@index');
        $router->get('sensor/{id}', 'SensorController@show');
        $router->post('sensor', 'SensorController@store');
        $router->put('sensor/{id}', 'SensorController@update');
        $router->delete('sensor/{id}', 'SensorController@destroy');

        $router->get('record', 'RecordController@index');
        $router->get('record/{sensor_id}', 'RecordController@show');

        // Update Tim Smart Farm Baru 
        $router->post('mykandang', 'KandangController@myKandang');
        $router->get('mysensor/{id_kandang}', 'SensorController@mySensor');
        $router->get('mysensor/{id_kandang}/{type_sensor}', 'SensorController@mySensorWithType');
        
    }
);

$router->post('record', 'RecordController@store');
$router->post('register', 'UsersController2@store');
