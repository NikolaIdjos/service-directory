<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->only(['index']);
Route::apiResource('providers', ProviderController::class)->only(['index', 'show']);
