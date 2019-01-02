<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('is_set', function($expression) {

            $params = explode(',', $expression);

            $condition = $params[0];

            $positive = $params[1];
            $negative = isset($params[2]) ? $params[2] : "''";

            $parsed = "<?php echo e($condition ?  $positive : $negative) ?>";

            return $parsed;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        app()->singleton('App\User', function () {
            return auth()->user();
        });

    }
}
