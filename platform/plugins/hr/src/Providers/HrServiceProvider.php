<?php

namespace Botble\Hr\Providers;

use Botble\Hr\Models\Hr;
use Illuminate\Support\ServiceProvider;
use Botble\Hr\Repositories\Caches\HrCacheDecorator;
use Botble\Hr\Repositories\Eloquent\HrRepository;
use Botble\Hr\Repositories\Interfaces\HrInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class HrServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        // $this->app->bind(HrInterface::class, function () {
        //     return new HrCacheDecorator(new HrRepository(new Hr));
        // });

        $this->app->bind(\Botble\Hr\Repositories\Interfaces\UserPositionInterface::class, function () {
            return new \Botble\Hr\Repositories\Caches\UserPositionCacheDecorator(
                new \Botble\Hr\Repositories\Eloquent\UserPositionRepository(new \Botble\Hr\Models\UserPosition)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/hr')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        $this->app->register(HookServiceProvider::class);

        Event::listen(RouteMatched::class, function () {

            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-hr',
                    'priority'    => 100,
                    'parent_id'   => null,
                    'name'        => 'Quản lý nhân sự',
                    'icon'        => 'fas fa-user-lock',
                    'url'         => null,
                    'permissions' => ['hr.index'],
                ])->registerItem([
                    'id'          => 'cms-plugins-hr-list',
                    'priority'    => 0,
                    'parent_id'   => 'cms-plugins-hr',
                    'name'        => 'Danh sách tài khoản',
                    'icon'        => null,
                    'url'         => route('hr.index'),
                    'permissions' => ['hr.user']
                ])->registerItem([
                    'id'          => 'cms-plugins-hr-new-user-list',
                    'priority'    => 0,
                    'parent_id'   => 'cms-plugins-hr',
                    'name'        => 'Danh sách cấp mới',
                    'icon'        => null,
                    'url'         => route('hr.new-user'),
                    'permissions' => ['hr.new-user']
                ])->registerItem([
                    'id'          => 'cms-plugins-hr-cbbh-list',
                    'priority'    => 0,
                    'parent_id'   => 'cms-plugins-hr',
                    'name'        => 'Danh sách CBBH',
                    'icon'        => null,
                    'url'         => route('hr.cbbh'),
                    'permissions' => ['hr.cbbh']
                ]);
        });
    }
}
