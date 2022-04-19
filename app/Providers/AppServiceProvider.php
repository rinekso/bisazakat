<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('REDIRECT_HTTPS'))
        {
            URL::forceScheme('https');
        }

        Blade::directive('rp', function ($amount) {
            return "<?php echo 'Rp' . number_format($amount, 2) . ',-'; ?>";
        });

        if (!defined('ADMIN')) {
           define('ADMIN', config('variables.APP_ADMIN', 'admin'));
        }

        if (!defined('USER')) {
            define('USER', config('variables.APP_USER', 'admin'));
        }

        require_once base_path('resources/macros/form.php');
        Schema::defaultStringLength(255);

        \Carbon\Carbon::setlocale('id');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
