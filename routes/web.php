<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminCatalogController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\WeddingProjectController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ServiceDetailsController;

// Публичные страницы
Route::view('/', 'welcome');
Route::view('/main', 'layouts.main')->name('main');
Route::view('/portfolio', 'site.portfolio')->name('portfolio');
Route::view('/reviews', 'site.reviews')->name('reviews');
Route::view('/services', 'site.services')->name('services');
Route::view('/catalog', 'site.catalog')->name('catalog');

// Аутентификация
Route::get('/auth', fn() => view('site.auth'))->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('site.register'))->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Каталог товаров
Route::get('/catalog/mens', [CatalogController::class, 'mens'])->name('mens_clothing.mens');
Route::get('/product/{id}', [ProductDetailsController::class, 'index'])->name('product_details.index');

// Услуги
Route::get('/services/catering', [ServicesController::class, 'catering'])->name('services.catering');
Route::get('/service/{id}', [ServiceDetailsController::class, 'index'])->name('service_details.index');

// Личный кабинет
Route::middleware('auth')->prefix('account')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('account');
    Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/orders', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/settings', [AccountController::class, 'settings'])->name('account.settings');
});

// Свадебный проект
Route::middleware('auth')->prefix('project')->group(function () {
    Route::post('/', [WeddingProjectController::class, 'store'])->name('project.store');
    Route::get('/{id}', [WeddingProjectController::class, 'show'])->name('project.show');
    Route::post('/add-product', [WeddingProjectController::class, 'addProduct'])->name('project.addProduct');
    Route::post('/add-service', [WeddingProjectController::class, 'addService'])->name('project.addService');
});

// Админ-панель
Route::middleware('auth')->prefix('adminpanel')->group(function () {
    // Каталог
    Route::get('/catalog', [AdminCatalogController::class, 'index'])->name('admin_catalog');
    Route::post('/catalog', [AdminCatalogController::class, 'store'])->name('catalog.store');
    Route::put('/catalog/{id}', [AdminCatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{id}', [AdminCatalogController::class, 'destroy'])->name('catalog.destroy');

    // Услуги
    Route::get('/services', [AdminServiceController::class, 'index'])->name('admin_services');
    Route::post('/services/store', [AdminServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('services.destroy');
});


