<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", [DashboardController::class, "index"]);
Route::get("/categories", [CategoryController::class, "index"]);
Route::post("/income", [IncomeController::class, "store"])->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
]);
