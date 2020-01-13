<?php
      Route::post('furniture/store','FurnitureController@store')->name('furniture.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('furniture','FurnitureController@index')->name('furniture.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('furniture/create','FurnitureController@create')->name('furniture.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('furniture/{furniture}','FurnitureController@update')->name('furniture.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('furniture/{furniture}','FurnitureController@show')->name('furniture.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('furniture/{furniture}','FurnitureController@destroy')->name('furniture.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('furniture/{furniture}/edit','FurnitureController@edit')->name('furniture.edit')
      ->middleware('can:auxiliares.edit');
