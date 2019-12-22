<?php
      Route::post('material/store','MaterialController@store')->name('material.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('material','MaterialController@index')->name('material.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('material/create','MaterialController@create')->name('material.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('material/{material}','MaterialController@update')->name('material.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('material/{material}','MaterialController@show')->name('material.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('material/{material}','MaterialController@destroy')->name('material.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('material/{material}/edit','MaterialController@edit')->name('material.edit')
      ->middleware('can:auxiliares.edit');
