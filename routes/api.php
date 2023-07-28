<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('productos','App\Http\Controllers\productoscontroller@getProductos');
Route::get('productosAl','App\Http\Controllers\productoscontroller@getProductosAll');
Route::post('productosp','App\Http\Controllers\productoscontroller@postProductos');
Route::put('productosput/{id}','App\Http\Controllers\productoscontroller@putProductos');
Route::delete('productosdel/{id}','App\Http\Controllers\productoscontroller@delProductos');