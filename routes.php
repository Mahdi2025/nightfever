<?php

/** --------------------------------------------------------------------------------------------------------
 * Add your routes here.
 * At this point, variables in a route are not supported like in Laravel: user/{user_id}/edit
 *  I add this in a future version.
 * 
 * Protect your routes with one ore more Middleware classes, like WhenNotLoggedIn or Permissions.
 *  See the classes for more information.
 * Add Middleware in an associative array with a key, like the admin route
 * ---------------------------------------------------------------------------------------------------------
*/

use App\Middleware\WhenNotLoggedin;
use App\Middleware\Permissions;

$router->get('', 'App/Controllers/HomeController.php@index');

$router->get('login', 'App/Controllers/LoginController.php@index');

$router->get('logout', 'App/Controllers/LoginController.php@logout');

$router->get('register', 'App/Controllers/RegisterController.php@index');

$router->post('register', 'App/Controllers/RegisterController.php@store');

$router->post('login/auth', 'App/Controllers/LoginController.php@login');

$router->get('admin', 'App/Controllers/AdminController.php@index', [
    'list' => Permissions::class,
]);

$router->get('profile/{id}', 'App/Controllers/ProfileController.php@index', [
    'auth' => WhenNotLoggedin::class,
]);


// All the routes concerning users

$router->get('user/{id}', 'App/Controllers/UserController.php@index', [
    'show' => Permissions::class
]);

$router->get('user/create', 'App/Controllers/UserController.php@create', [
    'create' => Permissions::class
]);

$router->post('user/store', 'App/Controllers/UserController.php@store', [
    'create' => Permissions::class
]);

$router->get('user/{id}/edit', 'App/Controllers/UserController.php@edit', [
    'edit' => Permissions::class
]);

$router->post('user/{id}/update', 'App/Controllers/UserController.php@update', [
    'edit' => Permissions::class
]);

$router->get('user/{id}/destroy', 'App/Controllers/UserController.php@destroy', [
    'delete' => Permissions::class
]);


// All the routes concerning educations

$router->get('education', 'App/Controllers/EducationController.php@index', [
    'list' => Permissions::class
]);

$router->get('education/{id}', 'App/Controllers/EducationController.php@show', [
    'show' => Permissions::class
]);

$router->get('education/create', 'App/Controllers/EducationController.php@create', [
    'create' => Permissions::class
]);

$router->post('education/store', 'App/Controllers/EducationController.php@store', [
    'create' => Permissions::class
]);

$router->get('education/{id}/edit', 'App/Controllers/EducationController.php@edit', [
    'edit' => Permissions::class
]);

$router->post('education/{id}/update', 'App/Controllers/EducationController.php@update', [
    'edit' => Permissions::class
]);

$router->get('education/{id}/destroy', 'App/Controllers/EducationController.php@destroy' , [
    'delete' => Permissions::class
]);


// All the routes concerning jobs

$router->get('job', 'App/Controllers/JobController.php@index', [
    'list' => Permissions::class
]);

$router->get('job/{id}', 'App/Controllers/JobController.php@show', [
    'show' => Permissions::class
]);

$router->get('job/create', 'App/Controllers/JobController.php@create', [
    'create' => Permissions::class
]);

$router->post('job/store', 'App/Controllers/JobController.php@store', [
    'create' => Permissions::class
]);

$router->get('job/{id}/edit', 'App/Controllers/JobController.php@edit', [
    'edit' => Permissions::class
]);

$router->post('job/{id}/update', 'App/Controllers/JobController.php@update', [
    'edit' => Permissions::class
]);

$router->get('job/{id}/destroy', 'App/Controllers/JobController.php@destroy', [
    'delete' => Permissions::class
]);


// All the routes concerning skills

$router->get('skill', 'App/Controllers/SkillController.php@index', [
    'list' => Permissions::class
]);

$router->get('skill/{id}', 'App/Controllers/SkillController.php@show', [
    'show' => Permissions::class
]);

$router->get('skill/create', 'App/Controllers/SkillController.php@create', [
    'create' => Permissions::class
]);

$router->post('skill/store', 'App/Controllers/SkillController.php@store', [
    'create' => Permissions::class
]);

$router->get('skill/{id}/edit', 'App/Controllers/SkillController.php@edit', [
    'edit' => Permissions::class
]);

$router->post('skill/{id}/update', 'App/Controllers/SkillController.php@update', [
    'edit' => Permissions::class
]);

$router->get('skill/{id}/destroy', 'App/Controllers/SkillController.php@destroy', [
    'delete' => Permissions::class
]);


// All the routes concerning hobbies

$router->get('hobby', 'App/Controllers/HobbyController.php@index', [
    'list' => Permissions::class
]);

$router->get('hobby/{id}', 'App/Controllers/HobbyController.php@show', [
    'show' => Permissions::class
]);

$router->get('hobby/create', 'App/Controllers/HobbyController.php@create', [
    'create' => Permissions::class
]);

$router->post('hobby/store', 'App/Controllers/HobbyController.php@store', [
    'create' => Permissions::class
]);

$router->get('hobby/{id}/edit', 'App/Controllers/HobbyController.php@edit', [
    'edit' => Permissions::class
]);

$router->post('hobby/{id}/update', 'App/Controllers/HobbyController.php@update', [
    'edit' => Permissions::class
]);

$router->get('hobby/{id}/destroy', 'App/Controllers/HobbyController.php@destroy', [
    'delete' => Permissions::class
]);
