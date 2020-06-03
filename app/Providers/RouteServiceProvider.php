<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    protected $dashboard_namespace  = 'App\Http\Controllers\Dashboard';
    protected $namespace            = 'App\Http\Controllers';
    public const HOME               = '/dashboard';


    public function boot()
    {
        parent::boot();
    }


    public function map()
    {
        $this->mapDashboardRoutes();
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }


    protected function mapDashboardRoutes()
    {
        Route::middleware('web')
            ->namespace($this->dashboard_namespace)
            ->group(base_path('routes/dashboard/web.php'));
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }


    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
