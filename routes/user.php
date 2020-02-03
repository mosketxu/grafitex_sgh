<?php

    Route::post('user/store','UserController@store')->name('user.store')
        ->middleware('can:user.create'); 

    Route::get('user','UserController@index')->name('user.index')
        ->middleware('can:user.index');

    Route::get('user/create','UserController@create')->name('user.create')
        ->middleware('can:user.create');
        
    Route::put('user/{user}','UserController@update')->name('user.update')
        ->middleware('can:user.show');

    Route::get('user/{user}','UserController@show')->name('user.show')
        ->middleware('can:user.show');

    Route::delete('user/{user}','UserController@destroy')->name('user.destroy')
        ->middleware('can:user.destroy');

    Route::get('user/{user}/edit','UserController@edit')->name('user.edit')
        ->middleware('can:user.edit');

    Route::get('usertempo','UserController@tempo')->name('user.tempo');
        
