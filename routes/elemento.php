<?php
// Route::resource('elemento', 'ElementoController');

Route::post('elemento/store','ElementoController@store')->name('elemento.store')
->middleware('can:auxiliares.create');

Route::get('elemento','ElementoController@index')->name('elemento.index')
->middleware('can:auxiliares.index');

Route::get('elemento/create','ElementoController@create')->name('elemento.create')
->middleware('can:auxiliares.create');

Route::put('elemento/{elemento}','ElementoController@update')->name('elemento.update')
->middleware('can:auxiliares.edit');

Route::get('elemento/{elemento}','ElementoController@show')->name('elemento.show')
->middleware('can:auxiliares.show');

Route::delete('elemento/{elemento}','ElementoController@destroy')->name('elemento.destroy')
->middleware('can:auxiliares.destroy');

Route::get('elemento/{elemento}/edit','ElementoController@edit')->name('elemento.edit')
->middleware('can:auxiliares.edit');
