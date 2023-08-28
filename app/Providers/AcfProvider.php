<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AcfProvider extends ServiceProvider
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
        Blade::directive('shortcode', function ($expression) {
            return "<?php echo resolve(App\Acf\Helper\AcfHelper::class)->test($expression); ?>";
        });
    }
}
