<?php

Route::post('store/storeelementos/{storeelemento}/store', 'StoreElementosController@store')->name('storeelementos.store')
->middleware('can:storeelementos.create'); 

Route::get('/store/storeelementos/{store}','StoreElementosController@index')->name('storeelementos.index')
->middleware('can:storeelementos.index'); 

// Route::get('store/storeelementos/{storeelemento}', 'StoreElementosController@create')->name('storeelementos.create')
// ->middleware('can:storeelementos.create'); 

// Route::put('store/storeelementos/{storeelemento}', 'StoreElementosController@update')->name('storeelementos.update')
// ->middleware('can:storeelementos.create'); 

Route::get('/store/storeelementos/{storeelemento}','StoreElementosController@show')->name('storeelementos.show')
->middleware('can:storeelementos.index'); 

Route::delete('/store/storeelementos/{storeId}/{storeelemento}','StoreElementosController@destroy')->name('storeelementos.destroy')
->middleware('can:storeelementos.destroy'); 

Route::get('/store/storeelementos/{storeelemento}/edit','StoreElementosController@edit')->name('storeelementos.edit')
->middleware('can:storeelementos.edit'); 