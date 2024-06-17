<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Middleware\JsonResponseMiddleware;
use App\Http\Middleware\Cors;

Route::middleware([Cors::class])->group(function () {
    Route::get("/", function () {
        return view("welcome");
    });

    Route::get("/dashboard", [DashboardController::class, "index"]);
    Route::get("/categories", [CategoryController::class, "index"]);

    Route::post("/income", [IncomeController::class, "store"])
        ->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ])
        ->middleware([JsonResponseMiddleware::class]);

    Route::post("/expense", [ExpenseController::class, "store"])
        ->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        ])
        ->middleware([JsonResponseMiddleware::class]);

    Route::get('/report', [ReportController::class, 'getReport'])
        ->middleware([JsonResponseMiddleware::class]);
});
