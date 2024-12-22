<?php






$router->post('/registration','RegistrationController@onRegister');


$router->post('/login','LoginController@onLogin');


$router->post('/tokenTest',['middleware'=>'auth','uses'=>'LoginController@tokenTest']);

