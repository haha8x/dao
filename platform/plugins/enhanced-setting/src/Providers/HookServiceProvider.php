<?php

namespace Botble\EnhancedSetting\Providers;

use Event;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->removeItem('cms-core-plugins')
                ->removeItem('cms-core-media')
                ->removeItem('cms-core-system-information')
                // ->removeItem('cms-core-platform-administration')
                ;
        });
    }
}
