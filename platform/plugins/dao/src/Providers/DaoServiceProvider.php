<?php

namespace Botble\Dao\Providers;

use Botble\Dao\Models\Dao;
use Illuminate\Support\ServiceProvider;
use Botble\Dao\Repositories\Caches\DaoCacheDecorator;
use Botble\Dao\Repositories\Eloquent\DaoRepository;
use Botble\Dao\Repositories\Interfaces\DaoInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class DaoServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(DaoInterface::class, function () {
            return new DaoCacheDecorator(new DaoRepository(new Dao));
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\CustomerInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\CustomerCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\CustomerRepository(new \Botble\Dao\Models\Customer)
            );
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\DaoRequestNewInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\DaoRequestNewCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\DaoRequestNewRepository(new \Botble\Dao\Models\DaoRequestNew)
            );
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\DaoRequestUpdateInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\DaoRequestUpdateCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\DaoRequestUpdateRepository(new \Botble\Dao\Models\DaoRequestUpdate)
            );
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\DaoRequestTransferInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\DaoRequestTransferCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\DaoRequestTransferRepository(new \Botble\Dao\Models\DaoRequestTransfer)
            );
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\DaoRequestCloseInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\DaoRequestCloseCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\DaoRequestCloseRepository(new \Botble\Dao\Models\DaoRequestClose)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/dao')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-dao',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => __('Quản lý DAO'),
                'icon'        => 'fa fa-list',
                'url'         => route('dao.index'),
                'permissions' => ['dao.index'],
            ])
            ->registerItem([
                'id'          => 'cms-plugins-dao-request-new',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu cấp mới mã DAO'),
                'icon'        => null,
                'url'         => route('dao-request-new.index'),
                'permissions' => ['dao-request-new.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-request-update',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu cập nhật thông tin mã DAO'),
                'icon'        => null,
                'url'         => route('dao-request-update.index'),
                'permissions' => ['dao-request-update.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-request-transfer',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu chuyển mã DAO'),
                'icon'        => null,
                'url'         => route('dao-request-transfer.index'),
                'permissions' => ['dao-request-transfer.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-request-close',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu đóng mã DAO'),
                'icon'        => null,
                'url'         => route('dao-request-close.index'),
                'permissions' => ['dao-request-close.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-customer',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => __('Danh sách khách hàng'),
                'icon'        => 'fa fa-list',
                'url'         => route('customer.index'),
                'permissions' => ['customer.index'],
            ]);
        });

        $this->app->register(HookServiceProvider::class);
    }
}
