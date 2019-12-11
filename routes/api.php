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

Route::get('/api/maestros', 'APIController@getMaestros')->name('api.maestros.index');
Route::get('/api/country', 'APIController@getcountry')->name('api.country');
Route::get('/api/area', 'APIController@getarea')->name('api.area');
Route::get('/api/segmento', 'APIController@getsegmento')->name('api.segmento');
Route::get('/api/storeconcept', 'APIController@getstoreconcept')->name('api.storeconcept');
Route::get('/api/ubicacion', 'APIController@getubicacion')->name('api.ubicacion');
Route::get('/api/mobiliario', 'APIController@getmobiliario')->name('api.mobiliario');
Route::get('/api/propxelemento', 'APIController@getpropxelemento')->name('api.propxelemento');
Route::get('/api/carteleria', 'APIController@getcarteleria')->name('api.carteleria');
Route::get('/api/medida', 'APIController@getmedida')->name('api.medida');
Route::get('/api/material', 'APIController@getmaterial')->name('api.material');

Route::get('/api/campaigns', 'APIController@getCampaigns')->name('api.campaigns.index');
