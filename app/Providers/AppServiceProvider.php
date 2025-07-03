<?php

namespace App\Providers;

use App\Models\Category;
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

      $randomCategories = cache()->remember('footer.categories', 60 * 60, function () {
        return Category::take(4)->get();
      });

      view()->share('randomCategories', $randomCategories);
    }
}
