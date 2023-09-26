<?php

namespace App\Providers;

use App\Http\Resources\CountryResource;
use App\Http\Resources\FormDocResource;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        FormDocResource::withoutWrapping();
        CountryResource::withoutWrapping();
    }
}
