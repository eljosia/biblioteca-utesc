<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');

        Blade::directive('date', function ($date) {
            if (is_null($date))
                return "";
            if ($date != "") :
                return "<?php echo \Carbon\Carbon::parse($date)->formatLocalized('%d de %B de %Y'); ?>";
            else :
                return "";
            endif;
        });
    }
}
