<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');
Route::get('/reports/pdf', [ReportController::class, 'pdf'])
    ->name('reports.pdf');
Route::get('/transactions', [TransactionController::class, 'index'])
    ->name('transactions.index');

Route::get('/transactions/create', [TransactionController::class, 'create'])
    ->name('transactions.create');

Route::post('/transactions', [TransactionController::class, 'store'])
    ->name('transactions.store');

Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->name('transactions.edit');

Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])
    ->name('transactions.update');  

Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->name('transactions.destroy');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])
    ->name('categories.create');

Route::post('/categories', [CategoryController::class, 'store'])
    ->name('categories.store');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit');

Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('categories.update');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');