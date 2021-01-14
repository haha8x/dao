<?php

namespace Botble\Webconf\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class WebconfServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('packages/webconf')
            ->loadAndPublishViews()
            ->loadAndPublishTranslations();

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->removeItem('cms-core-packages')
                ->removeItem('cms-core-media')
                ->removeItem('cms-core-settings-media', 'cms-core-platform-administration')
                ->removeItem('cms-core-system-information', 'cms-core-platform-administration');
        });

        $this->app->register(HookServiceProvider::class);
    }
}
