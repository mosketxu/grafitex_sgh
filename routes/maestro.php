<?php

// Route::get('/maestro','MaestroController@index')->name('maestro.index');

Route::post('maestro/store','MaestroController@store')->name('maestro.store')
->middleware('can:maestro.create');

Route::get('maestro','MaestroController@index')->name('maestro.index')
->middleware('can:maestro.index');

Route::get('maestro/create','MaestroController@create')->name('maestro.create')
->middleware('can:maestro.create');

Route::put('maestro/{maestro}','MaestroController@update')->name('maestro.update')
->middleware('can:maestro.edit');

Route::get('maestro/{maestro}','MaestroController@show')->name('maestro.show')
->middleware('can:maestro.show');

Route::delete('maestro/{maestro}','MaestroController@destroy')->name('maestro.destroy')
->middleware('can:maestro.destroy');

Route::get('maestro/{maestro}/edit','MaestroController@edit')->name('maestro.edit')
->middleware('can:maestro.edit');

Route::post('/maestro/import', 'MaestroController@import')->name('maestro.import')
->middleware('can:maestro.create');

Route::get('maestros/actualizatablas','MaestroController@actualizartablas')->name('maestro.actualizatablas')
->middleware('can:maestro.edit');;
