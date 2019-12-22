<?php
      Route::post('area/store','AreaController@store')->name('area.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('area','AreaController@index')->name('area.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('area/create','AreaController@create')->name('area.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('area/{area}','AreaController@update')->name('area.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('area/{area}','AreaController@show')->name('area.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('area/{area}','AreaController@destroy')->name('area.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('area/{area}/edit','AreaController@edit')->name('area.edit')
      ->middleware('can:auxiliares.edit');
