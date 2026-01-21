<?php
// routes/web.php

$router->get('/', "AuthController@index");
$router->get('/login', "AuthController@login");
$router->post("/login","AuthController@login");
$router->get('/logout', "AuthController@logout");
$router->get('/admin/home', "AdminController@home");
$router->get('/admin/classroom', "ClassRoomController@index");
$router->get('/admin/classroom/create', "ClassRoomController@create");
$router->post('/admin/classroom/create', "ClassRoomController@create");
$router->get('/admin/sprints', "SprintController@index");
$router->get('/admin/sprints/create', "SprintController@create");
$router->post('/admin/sprints/create', "SprintController@create");
$router->get('/admin/users', "UsersController@index");
$router->get('/admin/users/create', "UsersController@create");
$router->post('/admin/users/create', "UsersController@create");