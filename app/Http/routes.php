<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

DingoRoute::group(['namespace' => 'System'], function($dgRoute) {
    $dgRoute->post('/admins', 'AdminController@store');
    $dgRoute->post('/login', 'AccountController@login');

//    $dgRoute->group(['middleware' => ['jwt.auth', 'permission_check']], function () use ($dgRoute) {
    $dgRoute->group(['middleware' => 'api.auth'], function () use ($dgRoute) {
        $dgRoute->group(['prefix' => 'roles'], function () use ($dgRoute) {
            $dgRoute->get('/', 'RoleController@index');
            $dgRoute->get('/{id}', 'RoleController@show');
            $dgRoute->post('/', 'RoleController@store');
            $dgRoute->match(['put', 'patch'], '/{id}', 'RoleController@update');
            $dgRoute->delete('/{id}', 'RoleController@destroy');
        });

        $dgRoute->group(['prefix' => 'permissions'], function () use ($dgRoute) {
            $dgRoute->get('/', 'PermissionController@index');
            $dgRoute->get('/{id}', 'PermissionController@show');
            $dgRoute->post('/', 'PermissionController@store');
            $dgRoute->match(['put', 'patch'], '/{id}', 'PermissionController@update');
            $dgRoute->delete('/{id}', 'PermissionController@destroy');
        });

        $dgRoute->group(['prefix' => 'accounts'], function () use ($dgRoute) {
            $dgRoute->get('/', 'AccountController@index');
            $dgRoute->get('/{id}', 'AccountController@show');
            $dgRoute->post('/', 'AccountController@store');
            $dgRoute->match(['put', 'patch'], '/{id}', 'AccountController@update');
            $dgRoute->delete('/{id}', 'AccountController@destroy');
        });

        $dgRoute->group(['prefix' => 'admins'], function () use ($dgRoute) {
            $dgRoute->get('/', 'AdminController@index');
            $dgRoute->get('/{id}', 'AdminController@show');
            $dgRoute->match(['put', 'patch'], '/{id}', 'AdminController@update');
            $dgRoute->delete('/{id}', 'AdminController@destroy');
        });
    });
});

DingoRoute::group(['namespace' => 'User'], function($dgRoute) {
    $dgRoute->post('/users', 'UserController@store');

    $dgRoute->group(['middleware' => 'jwt_check'], function () use ($dgRoute) {
        $dgRoute->group(['prefix' => 'users'], function () use ($dgRoute) {
            $dgRoute->get('/', 'UserController@index');
            $dgRoute->get('/{id}', 'UserController@show');
            $dgRoute->match(['put', 'patch'], '/{id}', 'UserController@update');
            $dgRoute->delete('/{id}', 'UserController@destroy');
        });
    });

    $dgRoute->group(['prefix' => 'jobs'], function () use ($dgRoute) {
        $dgRoute->get('/', 'JobController@index');
        $dgRoute->get('/{id}', 'JobController@show');
        $dgRoute->post('/', 'JobController@store');
        $dgRoute->match(['put', 'patch'], '/{id}', 'JobController@update');
        $dgRoute->delete('/{id}', 'JobController@destroy');
    });

    $dgRoute->group(['prefix' => 'industries'], function () use ($dgRoute) {
        $dgRoute->get('/', 'IndustryController@index');
        $dgRoute->get('/{id}', 'IndustryController@show');
        $dgRoute->post('/', 'IndustryController@store');
        $dgRoute->match(['put', 'patch'], '/{id}', 'IndustryController@update');
        $dgRoute->delete('/{id}', 'IndustryController@destroy');
    });

    $dgRoute->group(['prefix' => 'schools'], function () use ($dgRoute) {
        $dgRoute->get('/', 'SchoolController@index');
        $dgRoute->get('/{id}', 'SchoolController@show');
        $dgRoute->post('/', 'SchoolController@store');
        $dgRoute->match(['put', 'patch'], '/{id}', 'SchoolController@update');
        $dgRoute->delete('/{id}', 'SchoolController@destroy');
    });

    $dgRoute->group(['prefix' => 'resumes', 'middleware' => ['jwt.auth']], function () use ($dgRoute) {
        $dgRoute->get('/', 'ResumeController@index');
        $dgRoute->get('/{id}', 'ResumeController@show');
        $dgRoute->post('/', 'ResumeController@store');
        $dgRoute->match(['put', 'patch'], '/{id}', 'ResumeController@update');
        $dgRoute->delete('/{id}', 'ResumeController@destroy');
    });

});

DingoRoute::group(['namespace' => 'Common'], function($dgRoute) {
    $dgRoute->group(['prefix' => 'tags'], function () use ($dgRoute) {
        $dgRoute->get('/', 'TagController@index');
        $dgRoute->get('/{id}', 'TagController@show');
        $dgRoute->post('/', 'TagController@store');
        $dgRoute->delete('/{id}', 'TagController@destroy');
    });
});

DingoRoute::group(['namespace' => 'Organization'], function($dgRoute) {
    $dgRoute->group(['prefix' => 'corporations'], function () use ($dgRoute) {
        $dgRoute->get('/', 'CorporationController@index');
        $dgRoute->get('/{id}', 'CorporationController@show');
        $dgRoute->post('/', 'CorporationController@store');
        $dgRoute->match(['put', 'patch'], '/{id}', 'CorporationController@update');
        $dgRoute->delete('/{id}', 'CorporationController@destroy');
    });

    $dgRoute->group(['prefix' => 'clients'], function () use ($dgRoute) {
        $dgRoute->get('/', 'ClientController@index');
        $dgRoute->get('/{account}', 'ClientController@show');
        $dgRoute->match(['put', 'patch'], '/{account}', 'ClientController@update');
        $dgRoute->delete('/{account}', 'ClientController@destroy');
    });
});
