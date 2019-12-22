<?php
      Route::post('carteleria/store','CarteleriaController@store')->name('carteleria.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('carteleria','CarteleriaController@index')->name('carteleria.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('carteleria/create','CarteleriaController@create')->name('carteleria.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('carteleria/{carteleria}','CarteleriaController@update')->name('carteleria.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('carteleria/{carteleria}','CarteleriaController@show')->name('carteleria.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('carteleria/{carteleria}','CarteleriaController@destroy')->name('carteleria.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('carteleria/{carteleria}/edit','CarteleriaController@edit')->name('carteleria.edit')
      ->middleware('can:auxiliares.edit');
