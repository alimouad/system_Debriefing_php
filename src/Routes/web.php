<?php

// routes/web.php
$router->get("/teacher/home", "TeacherController@index");
$router->get("/teacher/briefs", "BriefsController@index");
$router->get("/teacher/briefs/create", "BriefsController@create");
$router->post("/teacher/briefs/create", "BriefsController@create");
$router->get("/teacher/briefs/evaluate", "EvaluationController@index");
$router->get('/teacher/evaluate', "EvaluationController@showEvaluationForm");
$router->post('/teacher/evaluate', "EvaluationController@showEvaluationForm");


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
$router->get('/admin/skills', "SkillController@index");
$router->get('/admin/skills/create', "SkillController@create");
$router->post('/admin/skills/create', "SkillController@create");


$router->get('/student/home', "StudentController@index");
$router->get('/student/briefs', "BriefsController@getStudentBriefs");
$router->get('/student/briefs/rendu', "StudentController@briefRendu");
$router->post('/student/briefs/rendu', "StudentController@briefRendu");


