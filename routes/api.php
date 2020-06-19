<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('channel', 'Channel\ChannelController@channel');
Route::get('channel/{id}', 'Channel\ChannelController@channelById');
Route::post('channel', 'Channel\ChannelController@channelSave');
Route::put('channel/{id}', 'Channel\ChannelController@channelUpdate');
Route::delete('channel/{channel}', 'Channel\ChannelController@channelDelete');

Route::get('field', 'Field\FieldController@field');
Route::get('field/{id}', 'Field\FieldController@fieldById');
Route::post('field', 'Field\FieldController@fieldSave');
Route::put('field/{id}', 'Field\FieldController@fieldUpdate');
Route::delete('field/{field}', 'Field\FieldController@fieldDelete');

Route::get('data', 'Data\DataController@data');
Route::get('data/{id}', 'Data\DataController@dataById');
Route::post('data', 'Data\DataController@dataSave');
Route::put('data/{id}', 'Data\DataController@dataUpdate');
Route::delete('data/{data}', 'Data\DataController@dataDelete');
