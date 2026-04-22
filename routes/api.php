<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\TransactionController;

Route::middleware('api')->group(function () {
    // Fruit routes
    Route::get('/fruits', [FruitController::class, 'index']);
    Route::post('/fruits', [FruitController::class, 'store']);
    Route::delete('/fruits/{name}', [FruitController::class, 'destroy']);

    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

    // Daily summary route
    Route::get('/daily-summary', [TransactionController::class, 'dailySummary']);

    // Overall summary route (total profit/loss)
    Route::get('/overall-summary', [TransactionController::class, 'overallSummary']);

    // Summary by fruit type
    Route::get('/summary-by-fruit', [TransactionController::class, 'summaryByFruit']);
});
