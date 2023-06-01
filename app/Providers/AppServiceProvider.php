<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Sayedsoft\Dex\Base\Traits\FlashMessages;

class AppServiceProvider extends ServiceProvider
{
   
    use FlashMessages;
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
        //

        view()->composer('dex::alerts.status-alert', function ($view) {

            $messages = self::messages();
  
            return $view->with('messages', $messages);
        });

        $this->app['request']->server->set('HTTPS','on'); // this line
        URL::forceScheme('https');

    }
}
