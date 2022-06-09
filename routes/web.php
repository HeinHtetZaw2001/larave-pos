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



Auth::routes(['register' => true]);
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('category/datatable/ssd','CategoryController@ssd')->name('categorySSD');
    Route::resource('/category','CategoryController');
    Route::resource('/item','ItemController');
    Route::resource('/dailyreport','ReportController');
    Route::get('/daily-sell-overview/table','ReportController@OverTable');
    Route::get('item/datatable/ssd','ItemController@ssd')->name('itemSSD');
    Route::get('dailyincome-export-pdf','ReportController@exportpdf')->name('daily.report.pdf');
    Route::get('/audit','ReportController@daily')->name('audit');

});
Route::get('/','OrderController@index');
Route::post('/order','OrderController@order')->name('order');




