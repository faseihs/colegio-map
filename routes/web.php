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

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/config-cache', function () {
    \Illuminate\Support\Facades\Artisan::call("config:cache");
});

Route::get('/dump-autoload', function () {
    \Illuminate\Support\Facades\Artisan::call("dump-autoload");
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){
    Route::resource('/student','StudentController');
    Route::get('/student/{id}/restore','StudentController@restore');

    Route::post('student-data','StudentController@ajaxData');
    Route::post('student-data-trashed','StudentController@ajaxTrashedData');
    Route::get('/users','UserController@index');
    Route::get('/user/{slug}','UserController@show');
    Route::post('/user/{slug}','UserController@update');
    Route::get('/add-admin','UserController@addAdminShow');
    Route::post('/add-admin','UserController@addAdminPost');
    Route::delete('/delete-admin/{id}','UserController@deleteAdmin');

    Route::get('/student/{id}/payments','PaymentController@index');
    Route::post('/student/{id}/payment/create','PaymentController@create');
    Route::post('/student/{id}/receipt/create','PaymentController@createReceipt');
});
