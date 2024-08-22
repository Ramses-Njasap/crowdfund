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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrowdFundController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

// Home Route
Route::get('/', [HomeController::class, 'show'])->name('home');

// Base Layout Route
Route::get('/base', function () {
    return view('layout.base');
})->name('base');

// Detail Route
Route::get('/detail', [CategoryController::class, 'showCategories'])->name('detail');

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Crowdfund Routes
Route::get('crowdfund/create', [CrowdFundController::class, 'create'])->name('crowdfund.create');
Route::post('crowdfund', [CrowdFundController::class, 'store'])->name('crowdfund.store');
Route::get('/crowdfund/{id}', [CrowdFundController::class, 'show'])->name('crowdfund.show');
// Route to edit an existing crowdfund project
Route::patch('crowdfund/{id}/edit', [CrowdFundController::class, 'update'])->name('crowdfund.update');

// Route to update an existing crowdfund project
Route::patch('crowdfund/{id}', [CrowdFundController::class, 'raiseFund'])->name('crowdfund.raiseFund');

// Route to delete an existing crowdfund project
Route::delete('crowdfund/{id}', [CrowdFundController::class, 'destroy'])->name('crowdfund.destroy');

// Category Routes
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');