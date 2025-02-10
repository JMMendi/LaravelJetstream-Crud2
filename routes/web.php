<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\InicioController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Livewire\ShowUserPosts;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/userposts', ShowUserPosts::class)->name('showuserposts');
    Route::resource('categories', CategoryController::class)->except('show')->middleware('is_admin');
});

Route::get('contacto', [ContactoController::class, 'pintarFormulario'])->name('contacto.pintar');
Route::post('contacto', [ContactoController::class, 'procesarFormulario'])->name('contacto.procesar');