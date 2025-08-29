<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('ProvidersPage'));
Route::get('/providers/{id}', fn ($id) => Inertia::render('ProviderDetailsPage', [
    'provider_id' => $id,
]));
