<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/project/view/{id}', 'ProjectConTroller@project_view')->name('project_view');
Route::get('/get_comments/{id}', 'ProjectConTroller@get_comments')->name('get_comments');
Route::post('/store_comments/{id}', 'ProjectConTroller@store_comments')->name('store_comments');

Route::get('/index', function()
{
    return view('index');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/delete/{id}', 'HomeController@delete_user')->name('delete_user');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/add', 'HomeController@add_user')->name('add_user');
Route::post('/user/add', 'HomeController@add_user_post')->name('add_user_post');
Route::get('/change-password', 'HomeController@change_password')->name('change_password');
Route::post('/change-password', 'HomeController@change_password_post')->name('change_password_post');

Route::get('/project', 'HomeController@project')->name('project');
Route::get('/project/add', 'HomeController@project_add')->name('project_add');
Route::post('/project/add', 'HomeController@project_add_post')->name('project_add_post');
Route::get('/project/edit/{id}', 'HomeController@project_edit')->name('project_edit');
Route::post('/project/edit/{id}', 'HomeController@project_edit_post')->name('project_edit_post');
Route::get('/project/delete/{id}', 'HomeController@project_delete')->name('project_delete');
Route::get('/project/addon/{id}', 'HomeController@project_addon')->name('project_addon');
Route::post('/project/addon/{id}', 'HomeController@project_addon_post')->name('project_addon_post');

Route::get('/logo', 'HomeController@client')->name('logo');
Route::get('/logo/add', 'HomeController@client_add')->name('logo_add');
Route::post('/logo/add', 'HomeController@logo_add_post')->name('logo_add_post');
Route::get('/logo/delete/{id}', 'HomeController@logo_delete')->name('logo_delete');

Route::get('/sizes', 'HomeController@sizes')->name('sizes');
Route::get('/sizes/add', 'HomeController@size_add')->name('size_add');
Route::post('/sizes/add', 'HomeController@size_add_post')->name('size_add_post');
Route::get('/sizes/delete/{id}', 'HomeController@size_delete')->name('size_delete');

Route::get('/video/edit/{id}', 'HomeController@video_edit')->name('video_edit');
Route::post('/video/edit/{id}', 'HomeController@video_edit_post')->name('video_edit_post');
Route::get('/video/delete/{id}', 'HomeController@video_delete')->name('video_delete');