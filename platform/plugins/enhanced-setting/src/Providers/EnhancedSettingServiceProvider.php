<?php

namespace Botble\EnhancedSetting\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Event;
use Illuminate\Support\ServiceProvider;
use Botble\Base\Supports\Helper;

class EnhancedSettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/enhanced-setting')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadAndPublishViews();

        $this->app->register(HookServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->removeItem('cms-core-plugins')
                ->removeItem('cms-core-media')
                ->removeItem('cms-core-settings')
            //    ->removeItem('cms-core-platform-administration')
                ;
        });

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-enhanced-setting',
                'priority'    => 100,
                'parent_id'   => null,
                'name'        => __('Cài đặt hệ thống'),
                'icon'        => 'fa fa-cogs',
                'url'         => route('enhanced-setting.settings'),
                'permissions' => ['enhanced-setting.settings'],
            ]);
        });
    }
}
