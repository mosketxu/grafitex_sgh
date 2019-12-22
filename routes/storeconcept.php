<?php
      Route::post('storeconcept/store','StoreconceptController@store')->name('storeconcept.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('storeconcept','StoreconceptController@index')->name('storeconcept.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('storeconcept/create','StoreconceptController@create')->name('storeconcept.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('storeconcept/{storeconcept}','StoreconceptController@update')->name('storeconcept.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('storeconcept/{storeconcept}','StoreconceptController@show')->name('storeconcept.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('storeconcept/{storeconcept}','StoreconceptController@destroy')->name('storeconcept.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('storeconcept/{storeconcept}/edit','StoreconceptController@edit')->name('storeconcept.edit')
      ->middleware('can:auxiliares.edit');
