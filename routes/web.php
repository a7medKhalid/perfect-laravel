<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// simple blade
Route::resource('articles', \App\Http\Controllers\Web\ArticleController::class)->middleware('auth');

//livewire

Route::group(['middleware' => 'auth', 'prefix' => 'spa'], function () {
   Route::get('articles/create', App\Livewire\Article\Create::class)->name('spa.articles.create');
});
