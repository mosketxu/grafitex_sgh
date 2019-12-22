<?php

// Route::resource('tarifa', 'TarifaController');

Route::post('tarifa/store','TarifaController@store')->name('tarifa.store')
->middleware('can:tarifa.create');

Route::get('tarifa.index','TarifaController@index')->name('tarifa.index')
->middleware('can:tarifa.index');

Route::get('tarifa/create','TarifaController@create')->name('tarifa.create')
->middleware('can:tarifa.create');

Route::put('tarifa/{tarifa}','TarifaController@update')->name('tarifa.update')
->middleware('can:tarifa.edit');

Route::get('tarifa/{tarifa}','TarifaController@show')->name('tarifa.show')
->middleware('can:tarifa.show');

Route::delete('tarifa/{tarifa}','TarifaController@destroy')->name('tarifa.destroy')
->middleware('can:tarifa.destroy');

Route::get('tarifa/{tarifa}/edit','TarifaController@edit')->name('tarifa.edit')
->middleware('can:tarifa.edit');

