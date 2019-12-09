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
// Route::get('/api/{id}/campaignelementos', 'APIController@getCampaignElementos')->name('api.campaigns.elementos');
// Route::get('/api/{id}/campaigndetalle', 'APIController@getCampaignDetalles')->name('api.campaigns.detalles');
Route::get('/api/{id}/campaignstore', 'APIController@getCampaignStores')->name('api.campaigns.stores');
Route::get('/api/{id}/campaignmaterial', 'APIController@getCampaignMateriales')->name('api.campaigns.materiales');
Route::get('/api/{id}/campaignsegmento', 'APIController@getCampaignSegmentos')->name('api.campaigns.segmentos');
Route::get('/api/{id}/campaignstoreconcept', 'APIController@getCampaignStoreConcepts')->name('api.campaigns.storeconcepts');
Route::get('/api/{id}/campaignmobiliario', 'APIController@getCampaignMobiliarios')->name('api.campaigns.mobiliarios');
Route::get('/api/{id}/campaignpropxelemento', 'APIController@getCampaignPropxelementos')->name('api.campaigns.propxelementos');
Route::get('/api/{id}/campaigncarteleria', 'APIController@getCampaignCartelerias')->name('api.campaigns.cartelerias');
Route::get('/api/{id}/campaignmedida', 'APIController@getCampaignMedidas')->name('api.campaigns.medidas');
Route::get('/api/{id}/campaignmaterialmedida', 'APIController@getCampaignMaterialMedidas')->name('api.campaigns.materialmedidas');
Route::get('/api/{id}/campaignidiomamaterialmedida', 'APIController@getCampaignIdiomaMaterialMedidas')->name('api.campaigns.campaignmaterialmedidas');
