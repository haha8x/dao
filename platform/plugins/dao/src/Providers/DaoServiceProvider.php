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

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\DaoRegisterInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\DaoRegisterCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\DaoRegisterRepository(new \Botble\Dao\Models\DaoRegister)
            );
        });

        $this->app->bind(\Botble\Dao\Repositories\Interfaces\CustomerInterface::class, function () {
            return new \Botble\Dao\Repositories\Caches\CustomerCacheDecorator(
                new \Botble\Dao\Repositories\Eloquent\CustomerRepository(new \Botble\Dao\Models\Customer)
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
                'url'         => null,
                'permissions' => ['dao.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-create',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu cấp mới mã DAO'),
                'icon'        => null,
                'url'         => route('dao-register.index'),
                'permissions' => ['dao-register.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-update',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu cập nhật thông tin mã DAO'),
                'icon'        => null,
                'url'         => route('dao-register.index'),
                'permissions' => ['dao-register.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-change',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu chuyển mã DAO'),
                'icon'        => null,
                'url'         => route('dao-register.index'),
                'permissions' => ['dao-register.index'],
            ])->registerItem([
                'id'          => 'cms-plugins-dao-close',
                'priority'    => 0,
                'parent_id'   => 'cms-plugins-dao',
                'name'        => __('Yêu cầu đóng mã DAO'),
                'icon'        => null,
                'url'         => route('dao-register.index'),
                'permissions' => ['dao-register.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-customer',
                'priority'    => 0,
                'parent_id'   => null,
                'name'        => __('Danh sách khách hàng'),
                'icon'        => null,
                'url'         => route('customer.index'),
                'permissions' => ['customer.index'],
            ]);
        });

        $this->app->register(HookServiceProvider::class);
    }
}
