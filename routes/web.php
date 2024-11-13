<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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
    return view('welcome');
});


Route::get('/products',[ProductController::class,'makeProductArray']);

Route::get('/products/{id}',[ProductController::class,'getProductWithId']);

Route::post('/products/store',[ProductController::class,'addNewProduct']);

Route::delete('/products',function(){
    return response()->json(['msg'=>'sucess']);
});