<?php

namespace Botble\Customer\Providers;

use Botble\Customer\Models\Customer;
use Illuminate\Support\ServiceProvider;
use Botble\Customer\Repositories\Caches\CustomerCacheDecorator;
use Botble\Customer\Repositories\Eloquent\CustomerRepository;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class CustomerServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(CustomerInterface::class, function () {
            return new CustomerCacheDecorator(new CustomerRepository(new Customer));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('packages/customer')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-packages-customer',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'Quản lý khách hàng',
                'icon'        => 'fas fa-user',
                'url'         => route('customer.index'),
                'permissions' => ['customer.index'],
            ]);
        });
    }
}
