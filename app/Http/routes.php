<?php

$app['router']->get('/', function (){
    return 'ok';
});

$app['router']->get('welcome', 'App\Http\Controllers\WelcomeController@index');