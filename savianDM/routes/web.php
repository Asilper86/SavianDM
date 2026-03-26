<?php

use App\Livewire\Graficos\DashboardChart;
use App\Livewire\Movil\IndexMoviles;
use App\Livewire\Empresas\IndexEmpresa;
use App\Livewire\Modelos\IndexModelos;
use App\Livewire\Proveedor\IndexProveedor;
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

    // CAMBIO CLAVE: Ahora el dashboard es una clase Livewire, no una función anónima
    // Esto permite que wire:model funcione y los números se actualicen solos.
    Route::get('/dashboard', DashboardChart::class)->name('dashboard');

    // Tu ruta de móviles existente
    Route::get('/movil', IndexMoviles::class)->name('moviles');
    Route::get('/empresas', IndexEmpresa::class)->name('empresas');
    Route::get('/proveedores', IndexProveedor::class)->name('proveedores');
    Route::get('/modelos', IndexModelos::class)->name('modelos');

});