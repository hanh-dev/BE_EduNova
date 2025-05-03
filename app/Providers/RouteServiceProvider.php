<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')  // Thêm tiền tố '/api' cho mọi route
                ->namespace($this->namespace)  // Đảm bảo namespace đúng
                ->group(base_path('routes/api.php'));  // Load file api.php
    
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
