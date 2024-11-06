<?php

namespace App\Providers;

use App\Models\Carousel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('frontend.layouts.main', function ($view) {
            $carousels = Carousel::where('is_active', 1)->get();
            $view->with('carousels', $carousels);
        });
    }
}
