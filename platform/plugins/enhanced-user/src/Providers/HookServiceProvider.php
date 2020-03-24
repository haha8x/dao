<?php

namespace Botble\EnhancedUser\Providers;

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
    public function addLoginOptions($html)
    {
        Assets::addScriptsDirectly('vendor/core/plugins/enhanced-user/js/enhanced-user.js')
            ->addStylesDirectly('vendor/core/plugins/enhanced-user/css/enhanced-user.css');
        return $html . view('plugins/enhanced-user::form.register.options')->render();
    }
}
