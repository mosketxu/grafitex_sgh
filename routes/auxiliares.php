<?php

Route::group(['prefix'=>'auxiliares'],function(){
    Route::get('/', 'AuxiliaresController@index')->name('auxiliares.index')
        ->middleware('can:auxiliares.index'); 

        require __DIR__ .'/country.php';
        require __DIR__ .'/area.php';
        require __DIR__ .'/segmento.php';
        require __DIR__ .'/storeconcept.php';
        require __DIR__ .'/ubicacion.php';
        require __DIR__ .'/mobiliario.php';
        require __DIR__ .'/propxelemento.php';
        require __DIR__ .'/carteleria.php';
        require __DIR__ .'/medida.php';
        require __DIR__ .'/material.php';
});
