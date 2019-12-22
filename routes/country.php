<?php
      Route::post('country/store','CountryController@store')->name('country.store')
      ->middleware('can:auxiliares.create'); 
      
      Route::get('country','CountryController@index')->name('country.index')
      ->middleware('can:auxiliares.index');
      
      Route::get('country/create','CountryController@create')->name('country.create')
      ->middleware('can:auxiliares.create');
      
      Route::put('country/{country}','CountryController@update')->name('country.update')
      ->middleware('can:auxiliares.edit');
      
      Route::get('country/{country}','CountryController@show')->name('country.show')
      ->middleware('can:auxiliares.show');
      
      Route::delete('country/{country}','CountryController@destroy')->name('country.destroy')
      ->middleware('can:auxiliares.destroy');
      
      Route::get('country/{country}/edit','CountryController@edit')->name('country.edit')
      ->middleware('can:auxiliares.edit');
