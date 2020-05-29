<?php

namespace Botble\Hr\Providers;

use Illuminate\Support\ServiceProvider;
use Assets;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_filter(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, [$this, 'addLoginOptions'], 25, 2);
    }

    /**
     * @param string $html
     * @param string $module
     * @return null|string
     * @throws \Throwable
     */
    public function addLoginOptions($html, $module)
    {
        Assets::addStylesDirectly('vendor/core/plugins/hr/css/hr.css')
            ->addScriptsDirectly('vendor/core/plugins/hr/js/hr.js');

        return $html . view('plugins/hr::login-options')->render();
    }
}
