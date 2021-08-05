<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

//    <!-- Company View Routes -->
Route::get('/companies', function(){
    return view('companies.index');
});
Route::get('/companies-register', function(){
    return view('companies.registerCompany');
});
Route::get('companies-show/{id}', function(){
    return view ('companies.showCompany');
});


//    <!-- Emplyee View Routes -->
Route::get('/employees', function(){
    return view('employees.index');
});

Route::get('/employees-register', function(){
    return view('employees.registerEmployee');
});




//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//
//Auth::routes(['verify' => true]);
//
//Route::get('/home', 'HomeController@index')->middleware('verified');
