<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Milon\Barcode\DNS1D;

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
        \Blade::directive('barcode', function ($expression) {
            return "<?php echo DNS1D::getBarcodeHTML($expression, 'C128'); ?>";
        });
    }
}
