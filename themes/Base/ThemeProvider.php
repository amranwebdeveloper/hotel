<?php


namespace Themes\Base;


use Illuminate\Contracts\Http\Kernel;
use Modules\Core\ModuleProvider;
use Modules\Theme\Abstracts\AbstractThemeProvider;
use Themes\Base\Core\Middleware\RunUpdater;

class ThemeProvider extends AbstractThemeProvider
{

    public static $version = '2.5.1';
    public static $name = 'Tatil Benim';

    public static function info()
    {
        // TODO: Implement info() method.
    }

    public static $modules = [
        'core'=>ModuleProvider::class,
        'api'=>\Modules\Api\ModuleProvider::class,
        'booking'=>\Modules\Booking\ModuleProvider::class,
        'hotel'=>\Modules\Hotel\ModuleProvider::class, 
        'contact'=>\Modules\Contact\ModuleProvider::class,
        'dashboard'=>\Modules\Dashboard\ModuleProvider::class,
        'email'=>\Modules\Email\ModuleProvider::class,
        'sms'=>\Modules\Sms\ModuleProvider::class,
        'language'=>\Modules\Language\ModuleProvider::class,
        'media'=>\Modules\Media\ModuleProvider::class,
        'news'=>\Modules\News\ModuleProvider::class,
        'page'=>\Modules\Page\ModuleProvider::class,
        'user'=>\Modules\User\ModuleProvider::class,
        'template'=>\Modules\Template\ModuleProvider::class,
        'report'=>\Modules\Report\ModuleProvider::class,
        'vendor'=>\Modules\Vendor\ModuleProvider::class,
        'coupon'=>\Modules\Coupon\ModuleProvider::class,
        'location'=>\Modules\Location\ModuleProvider::class,
        'review'=>\Modules\Review\ModuleProvider::class,
        'popup'=>\Modules\Popup\ModuleProvider::class,

    ];

    public function boot(Kernel $kernel){

        $kernel->pushMiddleware(RunUpdater::class);

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    public function register()
    {
        foreach (static::$modules as $module=>$class){
            $this->app->register($class);
        }
    }
}
