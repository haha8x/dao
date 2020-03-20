<?php

namespace Botble\Dao\Providers;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Auth;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_filter(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, [$this, 'addLoginOptions'], 25, 2);

            // Event::listen(RouteMatched::class, function () {
            //     dashboard_menu()
            //         ->removeItem('cms-core-media')
            //         ->removeItem('cms-core-settings')
            //         ->removeItem('cms-core-platform-administration');
            // });
    }

    /**
     * @param string $html
     * @param string $module
     * @return null|string
     * @throws \Throwable
     */
    public function addLoginOptions($html, $module)
    {
        return $html . view('packages/dao::register.options')->render();
    }
}
