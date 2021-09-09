<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class)
            ->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::resource('products', ProductController::class)
            ->only('index', 'create', 'store', 'edit', 'update', 'destroy');
        Route::prefix('products')->group(function () {
            Route::delete('/images/{image}', [ProductController::class, 'imagesDestroy'])
                ->name('products.images.destroy');
        });

        Route::resource('categories', CategoryController::class);
    });
