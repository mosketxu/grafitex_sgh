<?php
      Route::post('propxelemento/store','PropxelementoController@store')->name('propxelemento.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('propxelemento','PropxelementoController@index')->name('propxelemento.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('propxelemento/create','PropxelementoController@create')->name('propxelemento.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('propxelemento/{propxelemento}','PropxelementoController@update')->name('propxelemento.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('propxelemento/{propxelemento}','PropxelementoController@show')->name('propxelemento.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('propxelemento/{propxelemento}','PropxelementoController@destroy')->name('propxelemento.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('propxelemento/{propxelemento}/edit','PropxelementoController@edit')->name('propxelemento.edit')
      ->middleware('can:auxiliares.edit');
