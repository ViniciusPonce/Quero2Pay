<?php

    use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

//    <!-- Company View Routes -->
Route::get('/companies', function(){
    return view('companies.index');
})->middleware('auth');

Route::get('/companies-register', function(){
    return view('companies.registerCompany');
})->middleware('auth');;
Route::get('companies-show/{id}', function(){
    return view ('companies.showCompany');
})->middleware('auth');;


//    <!-- Emplyee View Routes -->
Route::get('/employees', function(){
    return view('employees.index');
})->middleware('auth');;

Route::get('/employees-register', function(){
    return view('employees.registerEmployee');
})->middleware('auth');;




//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//
//Auth::routes(['verify' => true]);
//
//Route::get('/home', 'HomeController@index')->middleware('verified');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
