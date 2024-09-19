<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Categories;
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
        // Bind the categories data to the layout view
        View::composer('layout.layout_client', function ($view) {
            logger('View composer for layout.layout was called');
            $categories = Categories::all(); // Fetch categories from the database
            $view->with('categories', $categories);
        });
    }
}
