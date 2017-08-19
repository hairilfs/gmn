<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'DashboardController@getDashboard');

Route::get('/performance_budget', 'PerformanceBudgetController@getPerformanceBudget');
Route::get('/performance_budget/datatables', 'PerformanceBudgetController@getDatatables');
Route::get('/performance_budget/add', 'PerformanceBudgetController@getAdd');
Route::post('/performance_budget/add', 'PerformanceBudgetController@doAdd');
Route::get('/performance_budget/edit/{id?}', 'PerformanceBudgetController@getAdd');
Route::post('/performance_budget/edit/{id?}', 'PerformanceBudgetController@doAdd');
Route::get('/performance_budget/detail/{id?}', 'PerformanceBudgetController@getDetail');
Route::post('/performance_budget/detail/{id?}', 'PerformanceBudgetController@doDetail');
Route::get('/performance_budget/detail/delete/{id?}', 'PerformanceBudgetController@doDetailDelete');
Route::get('/performance_budget/detail/datatables/{id?}', 'PerformanceBudgetController@getDetailDatatables');
