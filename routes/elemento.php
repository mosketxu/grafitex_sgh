<?php
// Route::resource('elemento', 'ElementoController');

Route::post('elemento/store','ElementoController@store')->name('elemento.store')
->middleware('can:elemento.create');

Route::get('elemento','ElementoController@index')->name('elemento.index')
->middleware('can:elemento.index');

Route::get('elemento/create','ElementoController@create')->name('elemento.create')
->middleware('can:elemento.create');

Route::put('elemento/{elemento}','ElementoController@update')->name('elemento.update')
->middleware('can:elemento.edit');

Route::get('elemento/{elemento}','ElementoController@show')->name('elemento.show')
->middleware('can:elemento.show');

Route::delete('elemento/{elemento}','ElementoController@destroy')->name('elemento.destroy')
->middleware('can:elemento.destroy');

Route::get('elemento/{elemento}/edit','ElementoController@edit')->name('elemento.edit')
->middleware('can:elemento.edit');
