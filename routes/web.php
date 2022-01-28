<?php

use App\Http\Controllers\GetContentApiController;
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

Route::get('/home', function(){
    return view('home');
});

Route::get('/', [GetContentApiController::class, 'getAllCharacters']);
Route::get('/search', [GetContentApiController::class, 'singleCharacter'])->name('search')->where('name', '[A-Za-z]+');
Route::get('/comics', [GetContentApiController::class, 'getAllComics']);
Route::get('/comics/{name}/', [GetContentApiController::class, 'singleComic']);