<?php
      Route::post('segmento/store','SegmentoController@store')->name('segmento.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('segmento','SegmentoController@index')->name('segmento.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('segmento/create','SegmentoController@create')->name('segmento.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('segmento/{segmento}','SegmentoController@update')->name('segmento.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('segmento/{segmento}','SegmentoController@show')->name('segmento.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('segmento/{segmento}','SegmentoController@destroy')->name('segmento.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('segmento/{segmento}/edit','SegmentoController@edit')->name('segmento.edit')
      ->middleware('can:auxiliares.edit');
