<?php

use App\Livewire\Movil\IndexMoviles;
use App\Models\Historial;
use App\Models\Movil;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $moviles = Movil::count();
        $empresa = '';
        $historial = Historial::count();
        $centro_trabajo = '';
        return view('dashboard', compact('moviles', 'historial'));
    })->name('dashboard');
    Route::get('movil' , IndexMoviles::class)->name('moviles');
});
