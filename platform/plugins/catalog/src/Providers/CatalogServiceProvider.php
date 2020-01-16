<?php

namespace Botble\Catalog\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class CatalogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(\Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface::class, function () {
            return new \Botble\Catalog\Repositories\Caches\CatalogPositionCacheDecorator(
                new \Botble\Catalog\Repositories\Eloquent\CatalogPositionRepository(new \Botble\Catalog\Models\CatalogPosition)
            );
        });

        $this->app->bind(\Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface::class, function () {
            return new \Botble\Catalog\Repositories\Caches\CatalogZoneCacheDecorator(
                new \Botble\Catalog\Repositories\Eloquent\CatalogZoneRepository(new \Botble\Catalog\Models\CatalogZone)
            );
        });

        $this->app->bind(\Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface::class, function () {
            return new \Botble\Catalog\Repositories\Caches\CatalogBranchCacheDecorator(
                new \Botble\Catalog\Repositories\Eloquent\CatalogBranchRepository(new \Botble\Catalog\Models\CatalogBranch)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/catalog')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-catalog',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => __('Danh mục'),
                'icon'        => 'fa fa-list',
                'url'         => null,
                'permissions' => ['catalog.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-catalog-position',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-catalog',
                'name'        => __('Chức danh'),
                'icon'        => null,
                'url'         => route('catalog-position.index'),
                'permissions' => ['catalog-position.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-catalog-zone',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-catalog',
                'name'        => __('Vùng'),
                'icon'        => null,
                'url'         => route('catalog-zone.index'),
                'permissions' => ['catalog-zone.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-catalog-branch',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-catalog',
                'name'        => __('Chi nhánh'),
                'icon'        => null,
                'url'         => route('catalog-branch.index'),
                'permissions' => ['catalog-branch.index'],
            ]);
        });
    }
}
