<?php

namespace Botble\EnhancedUser\Providers;

use Botble\EnhancedUser\Models\EnhancedUser;
use Illuminate\Support\ServiceProvider;
use Botble\EnhancedUser\Repositories\Caches\EnhancedUserCacheDecorator;
use Botble\EnhancedUser\Repositories\Eloquent\EnhancedUserRepository;
use Botble\EnhancedUser\Repositories\Interfaces\EnhancedUserInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class EnhancedUserServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(EnhancedUserInterface::class, function () {
            return new EnhancedUserCacheDecorator(new EnhancedUserRepository(new EnhancedUser));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/enhanced-user')
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        $this->app->register(HookServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([EnhancedUser::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-enhanced-user',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/enhanced-user::enhanced-user.name',
                'icon'        => 'fa fa-list',
                'url'         => route('enhanced-user.index'),
                'permissions' => ['enhanced-user.index'],
            ]);
        });
    }
}
