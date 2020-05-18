<?php

namespace Botble\Staff\Providers;

use Botble\Staff\Models\Staff;
use Illuminate\Support\ServiceProvider;
use Botble\Staff\Repositories\Caches\StaffCacheDecorator;
use Botble\Staff\Repositories\Eloquent\StaffRepository;
use Botble\Staff\Repositories\Interfaces\StaffInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class StaffServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(StaffInterface::class, function () {
            return new StaffCacheDecorator(new StaffRepository(new Staff));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/staff')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Staff::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-staff',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => __('Quản lý nhân sự'),
                'icon'        => 'fas fa-user',
                'url'         => route('staff.index'),
                'permissions' => ['staff.index'],
            ]);
        });
    }
}
