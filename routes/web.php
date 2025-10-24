<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminCatalogController;
use App\Http\Controllers\AdminServiceController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', function () {
    return view('layouts.main');
})->name('main');
Route::get('/catalog', function () {
    return view('site.catalog');
})->name('catalog');

Route::get('/portfolio', function () {
    return view('site.portfolio');
})->name('portfolio');

Route::get('/reviews', function () {
    return view('site.reviews');
})->name('reviews');
Route::get('/services', function () {
    return view('site.services');
})->name('services');

Route::get('/auth', function () {
    return view('site.auth');
})->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');

// Выход пользователя
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('site.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');

Route::get('/mens-clothing', function () {
    return view('site.mens_clothing');
})->name('mens_clothing');

Route::group(['prefix' => 'adminpanel'], function () {
    Route::get('/catalog', [AdminCatalogController::class, 'index'])->name('admin_catalog');
    Route::post('/catalog', [AdminCatalogController::class, 'store'])->name('catalog.store');
    Route::put('/catalog/{id}', [AdminCatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{id}', [AdminCatalogController::class, 'destroy'])->name('catalog.destroy');
});

Route::prefix('adminpanel')->group(function () {
    Route::get('/services', [AdminServiceController::class, 'index'])->name('admin_services');
    Route::post('/services/store', [AdminServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('services.destroy');
});

