<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
]);
// Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/home', 'CampaignController@index')->name('home');
// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::get('/home','HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    //User
    require __DIR__ .'/user.php';
    //Roles
    require __DIR__ .'/roles.php';
    //Permisos
    require __DIR__ .'/permisos.php';
    //Maestro
    require __DIR__ .'/maestro.php';
    //Store
    require __DIR__ .'/store.php';
    //Tienda
    require __DIR__ .'/tienda.php';
    //Store elementos
    require __DIR__ .'/storeelementos.php';
    // Elementos
    require __DIR__ .'/elemento.php';
    //Auxiliares
    require __DIR__ .'/auxiliares.php';
    //Campañas
    require __DIR__ .'/campaign.php';
    // Tarifa
    require __DIR__ .'/tarifa.php';
    // Tarifa Familia
    require __DIR__ .'/tarifafamilia.php';
});



