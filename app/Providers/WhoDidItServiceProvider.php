<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Observers\WhoDidIt;
use Illuminate\Support\ServiceProvider;

class WhoDidItServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(WhoDidIt::class);
        Category::observe(WhoDidIt::class);
        Sale::observe(WhoDidIt::class);
    }
}
