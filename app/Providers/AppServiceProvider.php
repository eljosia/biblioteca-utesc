<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Carbon\Carbon;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191);

        KTBootstrap::init();
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

        Blade::directive('datetime', function ($date) {
            if (is_null($date))
                return "";
            if ($date != "") :
                return "<?php echo \Carbon\Carbon::parse($date)->formatLocalized('%d de %B de %Y a las %H:%M'); ?>";
            else :
                return "";
            endif;
        });
    }
}
