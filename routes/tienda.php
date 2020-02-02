<?php


Route::get('tienda/index','TiendaController@index')->name('tienda.index')
->middleware('can:tiendas.index');

Route::get('tienda/control','TiendaController@control')->name('tienda.control')
->middleware('can:tiendas.index');

Route::get('tienda/{campaign}/campaignstores','TiendaController@campaignstores')->name('tienda.campaignstores')
->middleware('can:tiendas.index');

Route::get('tienda/{campaign}/{store}/edit','TiendaController@edit')->name('tienda.edit')
    ->middleware('can:tiendas.index');

Route::get('tienda/{campaign}/{store}/show','TiendaController@show')->name('tienda.show')
    ->middleware('can:campaign.index');

Route::put('tienda/update','TiendaController@update')->name('tienda.update')
    ->middleware('can:tiendas.edit');

// Route::post('campaign/store','CampaignController@store')->name('campaign.store')
// ->middleware('can:campaign.create');

// Route::get('campaign/create','CampaignController@create')->name('campaign.create')
//     ->middleware('can:campaign.create');



// Route::delete('campaign/{campaign}','CampaignController@destroy')->name('campaign.destroy')
//     ->middleware('can:campaign.destroy');


