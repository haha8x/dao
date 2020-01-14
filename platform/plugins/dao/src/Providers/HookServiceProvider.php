<?php

namespace Botble\Dao\Providers;

use Illuminate\Support\ServiceProvider;

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
        if ($module === 'core/acl') {
            return $html . view('plugins/dao::login-options')->render();
        }

        return $html;
    }
}
