<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SyncController;
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
Route::get('/productos', function () {
   return App\Models\Product::factory(989)->create();
});

Route::get('/sync', [SyncController::class, 'index']);
Route::get('/sync/inicio', [SyncController::class, 'ultimoProducto']);