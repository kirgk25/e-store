<?php

use App\Http\Controllers;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Фиксы:
//  - добавил небольшой unit test
//  - добавил service для Product
//  - заюзал resources
//  - cache
//  - routing
//  - constants
//  - namespaces
//  - validation
Route::resource('products', Controllers\ProductController::class)->only([
    'index',
    'show',
    'store',
    'update',
]);
