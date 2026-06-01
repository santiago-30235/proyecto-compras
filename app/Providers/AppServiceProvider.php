<?php

namespace App\Providers;

// =========================
// Importamos Paginator
// para usar Bootstrap
// en la paginación Laravel
// =========================
use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registrar servicios
     */
    public function register(): void
    {
        //
    }

    /**
     * Configuración al iniciar Laravel
     */
    public function boot(): void
    {
        // =========================
        // Hace que la paginación
        // use estilos Bootstrap
        // y no Tailwind
        // =========================
        Paginator::useBootstrap();
    }
}