<?php

Route::post('store/store','StoreController@store')->name('store.store')
->middleware('can:store.create'); 

Route::get('store','StoreController@index')->name('store.index')
->middleware('can:store.index');

Route::get('store/create','StoreController@create')->name('store.create')
->middleware('can:store.create');

Route::put('store/{store}','StoreController@update')->name('store.update')
->middleware('can:store.edit');

Route::get('store/{store}','StoreController@show')->name('store.show')
->middleware('can:store.show');

Route::delete('store/{store}','StoreController@destroy')->name('store.destroy')
->middleware('can:store.destroy');

Route::get('store/{store}/edit','StoreController@edit')->name('store.edit')
->middleware('can:store.edit');

Route::post('store/updateimagenindex', 'StoreController@updateimagenindex')->name('store.updateimagenindex')
->middleware('can:store.create');
