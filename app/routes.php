<?php

$router->get('','PagesController@home');
$router->get('about','PagesController@about');
$router->get('contact','PagesController@contact');

$router->get('users','UsersController@index');

$router->get('countries','CountriesController@index');

$router->get('capitals','CapitalsController@index');
