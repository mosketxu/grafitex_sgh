<?php

Route::post('permission/store','PermissionController@store')->name('permission.store')
->middleware('can:permission.create');

Route::get('permisos','PermissionController@index')->name('permission.index')
->middleware('can:permission.index');

Route::get('permission/create','PermissionController@create')->name('permission.create')
->middleware('can:permission.create');

Route::put('permission/{permission}','PermissionController@update')->name('permission.update')
->middleware('can:permission.edit');

Route::get('permission/{permission}','PermissionController@show')->name('permission.show')
->middleware('can:permission.show');

Route::delete('permission/{permission}','PermissionController@destroy')->name('permission.destroy')
->middleware('can:permission.destroy');

Route::get('permission/{permission}/edit','PermissionController@edit')->name('permission.edit')
->middleware('can:permission.edit');
