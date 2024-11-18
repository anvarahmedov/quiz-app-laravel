<?php

namespace App\Providers;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Filament\Facades\Filament;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

use Illuminate\Pagination\Paginator;

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
       // Filament::registerViteTheme('resources/css/filament.css');
       Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }
}
