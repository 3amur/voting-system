<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register API routes
        Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

        // Default web routes
        Route::middleware('web')
                ->group(base_path('routes/web.php'));
    }
}
