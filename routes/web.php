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

Route::get('/seed', 'SeedController@seed');
Route::get('/test', 'SeedController@test');
Route::post('/channel/data', 'Channel\ChannelController@data');

Route::get('/channel', 'Channel\ChannelController@index');
Route::post('/channel/create', 'Channel\ChannelController@create');
Route::get('/channel/{id}/edit', 'Channel\ChannelController@edit');
Route::post('/channel/{id}/update', 'Channel\ChannelController@update');
Route::get('/channel/{id}/delete', 'Channel\ChannelController@delete');
Route::get('/channel/{id}/detail', 'Channel\ChannelController@detail');

Route::get('/field', 'Field\FieldController@index');
Route::post('/field/create', 'Field\FieldController@create');
Route::get('/field/{id}/edit', 'Field\FieldController@edit');
Route::post('/field/{id}/update', 'Field\FieldController@update');
Route::get('/field/{id}/delete', 'Field\FieldController@delete');
Route::get('/field/{id}/show', 'Field\FieldController@show');
// Route::get('/field/{id}/download', 'Field\FieldController@export_excel');

Route::get('/data', 'Data\DataController@index');
Route::get('/field/{id}/download_data', 'Data\DataController@export_excel');
Route::get('/data/download_excel', 'Data\DataController@download_excel')->name('data.download_excel');

Route::get('/tags', 'Tags\TagsController@index');
Route::post('/tags/create', 'Tags\ChannelController@create');
Route::get('/tags/{id}/edit', 'Tags\ChannelController@edit');
Route::post('/tags/{id}/update', 'Tags\ChannelController@update');
Route::get('/tags/{id}/delete', 'Tags\ChannelController@delete');

Route::get('/generate/{id}', 'Token\TokenController@generate');

// Route::get('/home_user', 'User@index');
Route::get('/', 'User@index');
Route::get('/dashboard', 'User@index');
Route::get('/login', 'User@login');
Route::post('/loginPost', 'User@loginPost');
Route::get('/register', 'User@register');
Route::post('/registerPost', 'User@registerPost');
Route::get('/logout', 'User@logout');


// Route::get('/home', 'Channel\ChannelController@index');
