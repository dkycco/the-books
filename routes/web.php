<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\TransactionsController as AdminTransactionsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('', function() {
    return redirect('login');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login-action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UsersController::class);
    Route::resource('books', BooksController::class);
    Route::resource('transactions', AdminTransactionsController::class);
});

Route::middleware(['auth', 'role:member'])->prefix('member')->group(function() {
    Route::resource('dashboard', MemberDashboardController::class);
    Route::resource('transaction', TransactionsController::class);
});