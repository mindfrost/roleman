<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:42
 */

Route::group(array('prefix'=>'roleman','namespace' => 'LaravelRoles\Roleman\Controllers','middleware' => ['web']), function() {

    Route::any('/index', ['as' => 'call_request_form','uses' => 'RoleController@index']);

});