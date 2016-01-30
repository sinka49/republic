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

//Route::get('/', function () { return view('welcome');});

get('/',['as' => 'posts', 'uses' => 'PostController@index']);
Route::group(array('namespace' => 'api'), function()
{
    Route::get('/api', array('uses' => 'ApiController@index'));

    Route::get('api/listview/', array('uses' => 'ListviewController@index'));
    Route::get('api/listview/filter/{city?}/{rest?}/{catforApp?}', array('uses' => 'ListviewController@filter'));
    Route::get('api/listview/category/{city?}/{cat?}', array('uses' => 'ListviewController@category'));

    Route::get('api/place/{place_id?}', array('uses' => 'PlaceController@place'));

});