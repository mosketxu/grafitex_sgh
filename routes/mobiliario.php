<?php
      Route::post('mobiliario/store','Mobiliario@store')->name('mobiliario.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('mobiliario','Mobiliario@index')->name('mobiliario.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('mobiliario/create','Mobiliario@create')->name('mobiliario.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('mobiliario/{mobiliario}','Mobiliario@update')->name('mobiliario.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('mobiliario/{mobiliario}','Mobiliario@show')->name('mobiliario.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('mobiliario/{mobiliario}','Mobiliario@destroy')->name('mobiliario.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('mobiliario/{mobiliario}/edit','Mobiliario@edit')->name('mobiliario.edit')
      ->middleware('can:auxiliares.edit');
