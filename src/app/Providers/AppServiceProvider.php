<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // ページネーションのスタイル指定に必要

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // ページネーションにBootstrapのスタイルを適用 (古いLaravelバージョン対応)
        Paginator::useBootstrap();
    }
}
