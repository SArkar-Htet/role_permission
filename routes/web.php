<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'],function ()
{
  // Route::resource('roles','RoleController');
  Route::get('roles/','RoleController@index');
  Route::get('roles/create','RoleController@create')->name('roles.create');
  Route::post('roles/store','RoleController@store')->name('roles.store');
  Route::get('/roles/{role}/edit','RoleController@edit')->name('roles.edit');
  Route::patch('/roles/{role}/update','RoleController@update')->name('roles.update');
  Route::delete('/roles/{role}/destroy','RoleController@destroy')->name('roles.delete');
  Route::get('/roles/{role}/permission','RoleController@permission')->name('roles.permission');
  Route::get('/roles/{role}/setPermission','RoleController@setPermission')->name('roles.setPermission');
  Route::resource('users','UserController');
  Route::resource('products','ProductController');
});
