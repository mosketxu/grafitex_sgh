<?php

Route::post('roles/store','RoleController@store')->name('roles.store')
->middleware('can:roles.create');

Route::get('roles','RoleController@index')->name('roles.index')
->middleware('can:roles.index');

Route::get('roles/create','RoleController@create')->name('roles.create')
->middleware('can:roles.create');

Route::put('roles/{role}','RoleController@update')->name('roles.update')
->middleware('can:roles.edit');

Route::get('roles/{role}','RoleController@show')->name('roles.show')
->middleware('can:roles.show');

Route::delete('roles/{role}','RoleController@destroy')->name('roles.destroy')
->middleware('can:roles.destroy');

Route::get('roles/{role}/edit','RoleController@edit')->name('roles.edit')
->middleware('can:roles.edit');
