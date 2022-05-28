<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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
Auth::routes();
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::group((['middleware' => 'auth',]), function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::get('uploads/{filename}', [ProductController::class, 'displayImage'])->name('displayimage');
});
Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
