<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:42
 */

Route::group(array('prefix'=>'roleman','namespace' => 'LaravelRoles\Roleman\Controllers','middleware' => ['web']), function() {

    Route::any('/index', ['as' => 'roleman:index','uses' => 'RoleController@index']);

    Route::group(array('prefix'=>'user'), function() {
        Route::any('/', ['as' => 'index_user','uses' => 'UserController@index']);
        Route::get('/delete/{id}', ['as' => 'delete_user','uses' => 'UserController@delete']);
        Route::get('/edit/{id}', ['as' => 'edit_user','uses' => 'UserController@edit']);
        Route::get('/test', ['as' => 'test_user','uses' => 'UserController@test']);
        Route::post('/store/{id}', ['as' => 'store_user','uses' => 'UserController@store']);
    });
    Route::group(array('prefix'=>'role'), function() {
        Route::any('/', ['as' => 'index_role','uses' => 'RoleController@index']);
        Route::get('/delete/{id}', ['as' => 'delete_role','uses' => 'RoleController@delete']);
        Route::get('/edit/{id}', ['as' => 'edit_role','uses' => 'RoleController@edit']);
        Route::post('/permissions/{id}', ['as' => 'edit_role_permissions','uses' => 'RoleController@permissions']);
        Route::post('/parents/{id}', ['as' => 'edit_role_parents','uses' => 'RoleController@parents']);
        Route::post('/store/{id}', ['as' => 'store_role','uses' => 'RoleController@store']);
    });
    Route::group(array('prefix'=>'permission'), function() {
        Route::any('/', ['as' => 'index_permission','uses' => 'PermissionController@index']);
        Route::get('/delete/{id}', ['as' => 'delete_permission','uses' => 'PermissionController@delete']);
        Route::get('/edit/{id}', ['as' => 'edit_permission','uses' => 'PermissionController@edit']);
        Route::post('/store/{id}', ['as' => 'store_permission','uses' => 'PermissionController@store']);
    });

});