<?php

// Route::resource('tarifafamilia', 'TarifaFamiliaController');//->middleware('admin');

Route::post('tarifafamilia/store','TarifaFamiliaController@store')->name('tarifafamilia.store')
->middleware('can:tarifafamilia.create');

Route::get('tarifa','TarifaFamiliaController@index')->name('tarifafamilia.index')
->middleware('can:tarifafamilia.index');

Route::get('tarifafamilia/create','TarifaFamiliaController@create')->name('tarifafamilia.create')
->middleware('can:tarifafamilia.create');

Route::put('tarifafamilia/update','TarifaFamiliaController@update')->name('tarifafamilia.update')
->middleware('can:tarifafamilia.edit');

Route::get('tarifafamilia/{tarifa}','TarifaFamiliaController@show')->name('tarifafamilia.show')
->middleware('can:tarifafamilia.show');

Route::delete('tarifafamilia/{tarifa}','TarifaFamiliaController@destroy')->name('tarifafamilia.destroy')
->middleware('can:tarifafamilia.destroy');

Route::get('tarifafamilia/{tarifa}/edit','TarifaFamiliaController@edit')->name('tarifafamilia.edit')
->middleware('can:tarifafamilia.edit');

Route::get('tarifafamilia/actualizar/{tarifafamilia}', 'TarifaFamiliaController@actualizar')->name('tarifafamilia.actualizar')
->middleware('can:tarifafamilia.edit');