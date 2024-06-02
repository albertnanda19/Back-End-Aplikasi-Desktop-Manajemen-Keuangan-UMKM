<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", [DashboardController::class, "index"]);
Route::get("/categories", [CategoryController::class, "index"]);
