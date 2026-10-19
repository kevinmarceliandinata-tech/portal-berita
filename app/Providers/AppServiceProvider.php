<?php

namespace App\Providers;

use App\Models\Kategori;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Data menu kategori untuk navbar frontend
        View::composer('layouts.frontend', function ($view) {
            $view->with('menuKategori', Kategori::orderBy('nama')->get());
        });
    }
}