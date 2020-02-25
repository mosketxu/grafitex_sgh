<?php

Route::post('campaign/store','CampaignController@store')->name('campaign.store')
->middleware('can:campaign.create');

Route::get('campaign','CampaignController@index')->name('campaign.index')
    ->middleware('can:campaign.index');

Route::get('campaign/create','CampaignController@create')->name('campaign.create')
    ->middleware('can:campaign.create');

Route::put('campaign/{campaign}','CampaignController@update')->name('campaign.update')
    ->middleware('can:campaign.edit');

Route::get('campaign/{campaign}','CampaignController@show')->name('campaign.show')
    ->middleware('can:campaign.show');

Route::delete('campaign/{campaign}','CampaignController@destroy')->name('campaign.destroy')
    ->middleware('can:campaign.destroy');

Route::get('campaign/{campaign}/edit','CampaignController@edit')->name('campaign.edit')
    ->middleware('can:campaign.edit');

//Generar Campaña
Route::group(['prefix' => 'campaign'], function () {

    Route::post('/asociar', 'CampaignController@asociar')->name('campaign.asociar')
        ->middleware('can:campaign.edit');
    
    Route::post('/asociarstore', 'CampaignController@asociarstore')->name('campaign.asociarstore')
        ->middleware('can:campaign.edit');

    Route::post('generarcampaign/{tipo}/{campaign}', 'CampaignController@generarcampaign')->name('campaign.generar')
        ->middleware('can:campaign.create');

    Route::get('/{campaign}/filtro', 'CampaignController@filtrar')->name('campaign.filtrar')
        ->middleware('can:campaign.edit');

    Route::get('/{campaign}/address', 'CampaignController@addresses')->name('campaign.addresses')
        ->middleware('can:campaign.index');

    Route::get('/{campaign}/exportaddresses', 'CampaignController@exportadresses')->name('campaign.exportaddresses')
        ->middleware('can:campaign.index');

    Route::delete('/delete/{campaign}', 'CampaignController@destroy')->name('campaign.delete')
        ->middleware('can:campaign.destroy');        

    // Estadisticas campaña
    Route::get('/{campaign}/conteo', 'CampaignController@conteo')->name('campaign.conteo')
        ->middleware('can:campaign.index'); 

    //Elementos de la campaña
    Route::group(['prefix' => 'elementos'], function () { 
        Route::get('/{campaignlemento}', 'CampaignElementoController@index')->name('campaign.elementos')
            ->middleware('can:campaign.index');
        
        Route::get('/{campaign}/{campaigngaleria}/edit', 'CampaignElementoController@editelemento')->name('campaign.elemento.editelemento')
            ->middleware('can:campaign.edit');

        Route::post('/update', 'CampaignElementoController@update')->name('campaign.elemento.update')
            ->middleware('can:campaign.edit');
        
        Route::post('/updateimagenindex', 'CampaignElementoController@updateimagenindex')->name('campaign.elementos.updateimagenindex')
            ->middleware('can:campaign.edit');

        Route::get('/export/conteoidimatmedmob/{campaign}', 'CampaignElementoController@exportConteoIdiomaMatMedMob')->name('campaign.conteo.export')
            ->middleware('can:campaign.index');

        Route::get('/export/campaignelementos/{campaign}', 'CampaignElementoController@exportCampaignElementos')->name('campaign.elementos.export')
            ->middleware('can:campaign.index');
    });
    // galeria
    Route::group(['prefix' => 'galeria'], function () {
        Route::get('/{campaign}', 'CampaignGaleriaController@index')->name('campaign.galeria')
            ->middleware('can:campaign.index');            

        Route::get('/{campaigngaleria}', 'CampaignGaleriaController@edit')->name('campaign.galeria.edit')
            ->middleware('can:campaign.edit');

        Route::get('/{campaign}/{campaigngaleria}/edit', 'CampaignGaleriaController@editgaleria')->name('campaign.galeria.editgaleria')
            ->middleware('can:campaign.edit');

        Route::post('/update', 'CampaignGaleriaController@update')->name('campaign.galeria.update')
            ->middleware('can:campaign.edit');

        Route::post('/updateimagenindex', 'CampaignGaleriaController@updateimagenindex')->name('campaign.galeria.updateimagenindex')
            ->middleware('can:campaign.edit');
    });
    // presupuesto
    Route::group(['prefix' => 'presupuesto'], function () {
        Route::get('/{campaign}', 'CampaignPresupuestoController@index')->name('campaign.presupuesto')
            ->middleware('can:presupuesto.index');            
        
        Route::get('/edit/{campaignpresupuesto}', 'CampaignPresupuestoController@edit')->name('campaign.presupuesto.edit')
            ->middleware('can:presupuesto.edit');
            
        Route::get('/cotizacion/{campaignpresupuesto}', 'CampaignPresupuestoController@cotizacion')->name('campaign.presupuesto.cotizacion')
            ->middleware('can:presupuesto.index');            

        Route::get('/cotizacion/elementos/{campaignid}/{familiaid}/{presupuestoid}', 'CampaignPresupuestoController@elementosfamilia')->name('campaign.presupuesto.elementosfamilia')
            ->middleware('can:presupuesto.index');            
            
        Route::post('/update/{campaignpresupuesto}', 'CampaignPresupuestoController@update')->name('campaign.presupuesto.update')
            ->middleware('can:presupuesto.edit');

        Route::put('/updateelemento', 'CampaignPresupuestoController@updateelemento')->name('campaign.presupuesto.updateelemento')
            ->middleware('can:presupuesto.edit');
    
        Route::get('/refresh/{campaign}/{campaignpresupuesto}', 'CampaignPresupuestoController@refresh')->name('campaign.presupuesto.refresh')
            ->middleware('can:presupuesto.edit');
                
        Route::post('/store','CampaignPresupuestoController@store')->name('campaign.presupuesto.store')
            ->middleware('can:presupuesto.create');
    
        Route::delete('/delete/{campaignpresupuesto}', 'CampaignPresupuestoController@destroy')->name('campaign.presupuesto.delete')
            ->middleware('can:presupuesto.destroy');

        //presupuesto detalles
        // Route::group(['prefix' => 'detalle'], function () {
        //     Route::post('/update/{campaignpresupuestodetalle}', 'CampaignPresupuestoDetalleController@update')->name('campaign.presupuesto.detalle.update')
        //         ->middleware('can:campaign.edit');
            
        //     Route::post('/store', 'CampaignPresupuestoDetalleController@store')->name('campaign.presupuesto.detalle.store')
        //         ->middleware('can:campaign.create');

        //     Route::get('/delete/{campaignpresupuestodetalle}', 'CampaignPresupuestoDetalleController@destroy')->name('campaign.presupuesto.detalle.delete')
        //         ->middleware('can:campaign.destroy');
        // });

        //presupuesto extras
        Route::group(['prefix' => 'extra'], function () {
            Route::post('/update/{campaignpresupuestoextra}', 'CampaignPresupuestoExtraController@update')->name('campaign.presupuesto.extra.update')
                ->middleware('can:campaign.edit');
            
            Route::post('/store', 'CampaignPresupuestoExtraController@store')->name('campaign.presupuesto.extra.store')
                ->middleware('can:campaign.store');

            Route::delete('/delete/{campaignpresupuestoextra}', 'CampaignPresupuestoExtraController@destroy')->name('campaign.presupuesto.extra.delete') 
                ->middleware('can:campaign.destroy');
        });
    });
    
    // Reporting
    Route::group(['prefix' => 'reporting'], function () {
        // etiquetas
        Route::get('/etiquetas/pdf/{campaign}', 'CampaignReportingController@pdf')->name('campaign.etiquetas.pdf')
            ->middleware('can:campaign.index');
        
        Route::get('/etiquetas/{campaign}', 'CampaignReportingController@index')->name('campaign.etiquetas.index')
        ->middleware('can:campaign.index');
        
        // presupuesto
        Route::get('/presupuesto/pdf/{campaignreportingcontroller}', 'CampaignReportingController@pdfPresupuesto')->name('campaign.presupuesto.pdfPresupuesto')
            ->middleware('can:campaign.index');
        
        Route::get('/presupuesto/preview/{campaignreportingcontroller}', 'CampaignReportingController@previewPresupuesto')->name('campaign.presupuesto.previewPresupuesto')
            ->middleware('can:campaign.index');
        
    }); 

});