<?php

namespace App\Providers;

use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Paginator\LaravelPaginator;
use App\Services\HtmlTableGenerator\Paginator\PaginatorInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaginatorInterface::class, LaravelPaginator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
