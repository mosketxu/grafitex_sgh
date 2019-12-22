<?php
      Route::post('medida/store','MedidaController@store')->name('medida.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('medida','MedidaController@index')->name('medida.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('medida/create','MedidaController@create')->name('medida.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('medida/{medida}','MedidaController@update')->name('medida.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('medida/{medida}','MedidaController@show')->name('medida.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('medida/{medida}','MedidaController@destroy')->name('medida.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('medida/{medida}/edit','MedidaController@edit')->name('medida.edit')
      ->middleware('can:auxiliares.edit');
