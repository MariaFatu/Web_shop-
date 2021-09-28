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

Route::get('/', 'CartController@show'); //afisare pagina de start
Auth::routes();
Route::get('/home', 'CartController@show')->name('show');
Route::get('/cart', 'CartController@cart')->name('show');
Route::get('product-details/{id}', 'ProductController@showDetails');//detalii produs
Route::post('store-review', 'ReviewsController@store')->name('store-review');//inregistrare review in bd
Route::get('review-form/{id}', 'ReviewsController@review_form');
Route::get('view-reviews/{id}', 'ReviewsController@index')->name('view-reviews');
Route::resource('products-list', 'CartController');

Route::group(['middleware' => 'auth'], function(){
Route::get('admin', 'ProductController@index');
Route::resource('products', 'ProductController');
Route::patch('update-cart', 'CartController@update'); //modific cos
Route::delete('remove-from-cart', 'CartController@remove');//sterg din cos
Route::get('show', 'CartController@show');
Route::get('add-to-cart/{id}', 'CartController@addToCart');//adaug in cos
Route::delete('remove-from-cart', 'CartController@remove');//sterg din cos
Route::get('finalize_cmd', 'CartController@finalize_cmd');//finalzare comanda

});
