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

use Botble\Dao\Models\Customer;
use Botble\Dao\Repositories\Caches\CustomerCacheDecorator;
use Botble\Dao\Repositories\Eloquent\CustomerRepository;
use Botble\Dao\Repositories\Interfaces\CustomerInterface;

use Botble\Dao\Models\DaoRequestNew;
use Botble\Dao\Repositories\Caches\DaoRequestNewCacheDecorator;
use Botble\Dao\Repositories\Eloquent\DaoRequestNewRepository;
use Botble\Dao\Repositories\Interfaces\DaoRequestNewInterface;

use Botble\Dao\Models\DaoRequestUpdate;
use Botble\Dao\Repositories\Caches\DaoRequestUpdateCacheDecorator;
use Botble\Dao\Repositories\Eloquent\DaoRequestUpdateRepository;
use Botble\Dao\Repositories\Interfaces\DaoRequestUpdateInterface;

use Botble\Dao\Models\DaoRequestTransfer;
use Botble\Dao\Repositories\Caches\DaoRequestTransferCacheDecorator;
use Botble\Dao\Repositories\Eloquent\DaoRequestTransferRepository;
use Botble\Dao\Repositories\Interfaces\DaoRequestTransferInterface;

use Botble\Dao\Models\DaoRequestClose;
use Botble\Dao\Repositories\Caches\DaoRequestCloseCacheDecorator;
use Botble\Dao\Repositories\Eloquent\DaoRequestCloseRepository;
use Botble\Dao\Repositories\Interfaces\DaoRequestCloseInterface;
use Botble\Demo\Models\Staff;
use Botble\Demo\Repositories\Caches\StaffCacheDecorator;
use Botble\Demo\Repositories\Eloquent\StaffRepository;
use Botble\Demo\Repositories\Interfaces\StaffInterface;

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
            return new DaoCacheDecorator(
                new DaoRepository(new Dao)
            );
        });

        $this->app->bind(CustomerInterface::class, function () {
            return new CustomerCacheDecorator(
                new CustomerRepository(new Customer)
            );
        });

        $this->app->bind(DaoRequestNewInterface::class, function () {
            return new DaoRequestNewCacheDecorator(
                new DaoRequestNewRepository(new DaoRequestNew)
            );
        });

        $this->app->bind(DaoRequestUpdateInterface::class, function () {
            return new DaoRequestUpdateCacheDecorator(
                new DaoRequestUpdateRepository(new DaoRequestUpdate)
            );
        });

        $this->app->bind(DaoRequestTransferInterface::class, function () {
            return new DaoRequestTransferCacheDecorator(
                new DaoRequestTransferRepository(new DaoRequestTransfer)
            );
        });

        $this->app->bind(DaoRequestCloseInterface::class, function () {
            return new DaoRequestCloseCacheDecorator(
                new DaoRequestCloseRepository(new DaoRequestClose)
            );
        });

        $this->app->bind(StaffInterface::class, function () {
            return new StaffCacheDecorator(
                new StaffRepository(new Staff)
            );
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('packages/dao')
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
                'icon'        => 'fas fa-clipboard-list',
                'url'         => route('dao.index'),
                'permissions' => ['dao.index'],
            ])
                ->registerItem([
                    'id'          => 'cms-plugins-dao-index',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins-dao',
                    'name'        => __('Danh sách DAO'),
                    'icon'        => null,
                    'url'         => route('dao.index'),
                    'permissions' => ['dao.index'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-request-new',
                    'priority'    => 2,
                    'parent_id'   => 'cms-plugins-dao',
                    'name'        => __('Yêu cầu cấp mới mã DAO'),
                    'icon'        => null,
                    'url'         => route('request-new.index'),
                    'permissions' => ['request-new.index'],
                ])->registerItem([
                    'id'          => 'cms-plugins-request-update',
                    'priority'    => 3,
                    'parent_id'   => 'cms-plugins-dao',
                    'name'        => __('Yêu cầu cập nhật mã DAO'),
                    'icon'        => null,
                    'url'         => route('request-update.index'),
                    'permissions' => ['request-update.index'],
                ])->registerItem([
                    'id'          => 'cms-plugins-request-transfer',
                    'priority'    => 4,
                    'parent_id'   => 'cms-plugins-dao',
                    'name'        => __('Yêu cầu chuyển mã DAO'),
                    'icon'        => null,
                    'url'         => route('request-transfer.index'),
                    'permissions' => ['request-transfer.index'],
                ])->registerItem([
                    'id'          => 'cms-plugins-request-close',
                    'priority'    => 5,
                    'parent_id'   => 'cms-plugins-dao',
                    'name'        => __('Yêu cầu đóng mã DAO'),
                    'icon'        => null,
                    'url'         => route('request-close.index'),
                    'permissions' => ['request-close.index'],
                ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-customer',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => __('Quản lý khách hàng'),
                'icon'        => 'fas fa-users',
                'url'         => route('customer.index'),
                'permissions' => ['customer.index'],
            ]);

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-staff',
                'priority'    => 10,
                'parent_id'   => null,
                'name'        => __('Quản lý tài khoản'),
                'icon'        => 'fas fa-user',
                'url'         => route('staff.index'),
                'permissions' => ['staff.index'],
            ]);
        });

        $this->app->register(HookServiceProvider::class);
    }
}
