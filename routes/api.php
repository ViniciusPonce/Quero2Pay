<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//    <!-- Company Api Routes -->
Route::prefix('companies')->group(function(){
        Route::get('/', 'CompanyAPIController@index');
        Route::get('/{id}', 'CompanyAPIController@show');

        Route::post('/', 'CompanyAPIController@store');
        Route::put('/{id}', 'CompanyAPIController@update');

        Route::delete('/{id}', 'CompanyAPIController@destroy');
});

//    <!-- Employee Api Routes -->
    Route::prefix('employees')->group(function(){
        Route::get('/', 'EmployeeAPIController@index');
        Route::get('/{id}', 'EmployeeAPIController@show');
        Route::get('/roles/select', 'EmployeeAPIController@selectRolesEmployee');
        Route::get('/show/{id}', 'EmployeeAPIController@showEmployeeCompany');
        Route::get('/data/{id}', 'EmployeeAPIController@dataEmployeeModal');
        Route::get('/list/all', 'EmployeeAPIController@listAll');


        Route::post('/', 'EmployeeAPIController@store');
        Route::put('/{id}', 'EmployeeAPIController@update');

        Route::delete('/{id}', 'EmployeeAPIController@destroy');
    });




//Route::resource('companies', 'CompanyAPIController');
//
//Route::resource('employees', 'EmployeeAPIController');
