<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/index', function()
{
    return view('index');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/project', 'HomeController@project')->name('project');
Route::get('/project/add', 'HomeController@project_add')->name('project_add');
Route::get('/client', 'HomeController@client')->name('client');
Route::get('/client/add', 'HomeController@client_add')->name('client_add');
Route::get('/sizes', 'HomeController@sizes')->name('sizes');
Route::get('/sizes/add', 'HomeController@size_add')->name('size_add');
Route::post('/sizes/add', 'HomeController@size_add_post')->name('size_add_post');
Route::get('/sizes/delete/{id}', 'HomeController@size_delete')->name('size_delete');
