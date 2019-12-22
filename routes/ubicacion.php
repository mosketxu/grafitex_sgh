<?php
      Route::post('ubicacion/store','UbicacionController@store')->name('ubicacion.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('ubicacion','UbicacionController@index')->name('ubicacion.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('ubicacion/create','UbicacionController@create')->name('ubicacion.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('ubicacion/{ubicacion}','UbicacionController@update')->name('ubicacion.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('ubicacion/{ubicacion}','UbicacionController@show')->name('ubicacion.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('ubicacion/{ubicacion}','UbicacionController@destroy')->name('ubicacion.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('ubicacion/{ubicacion}/edit','UbicacionController@edit')->name('ubicacion.edit')
      ->middleware('can:auxiliares.edit');
