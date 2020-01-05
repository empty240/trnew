<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiTrRoutes();	
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
    * TR,WR共通APIルーティング
    *	
    * @return void	
    */	
    protected function mapApiRoutes()	
    {	
    Route::middleware('api')	
        ->prefix('api')	
        ->namespace($this->namespace)	
        ->group(base_path('routes/api.php'));	
    }

    /**	
    * TR用APIルーティング
    *	
    * @return void	
    */	
    protected function mapApiTrRoutes()	
    {	
        Route::domain(config('const.env.tr_domain'))
        ->middleware('api')	
        ->prefix('api')	
        ->namespace('App\Http\Controllers\Tr')	
        ->group(base_path('routes/api_tr.php'));	
    }
}
