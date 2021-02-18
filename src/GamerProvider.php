<?php
/**
 * | Events
 * | ---------------------------------
 * | Illuminate\Auth\Events\Attempting
 * | Illuminate\Auth\Events\Login
 * | Illuminate\Auth\Events\Logout
 * |
 * | Illuminate\Cache\Events\CacheMissed
 * | Illuminate\Cache\Events\CacheHit
 * | Illuminate\Cache\Events\KeyWritten
 * | Illuminate\Cache\Events\KeyForgotten
 * |
 * | Illuminate\Database\Events\TransactionBeginning
 * | Illuminate\Database\Events\TransactionCommitted
 * | Illuminate\Database\Events\TransactionRolledBack
 * | Illuminate\Database\Events\QueryExecuted
 * |
 * | Illuminate\Queue\Events\JobProcessed
 * | Illuminate\Queue\Events\JobFailed
 * | Illuminate\Queue\Events\WorkerStopping
 * |
 * | Illuminate\Mail\Events\MessageSending
 * | Illuminate\Routing\Events\RouteMatched
 * |
 * | eloquent.booting
 * | eloquent.booted
 * | eloquent.deleting
 * | eloquent.deleted
 * | eloquent.saving
 * | eloquent.saved
 * | eloquent.updating
 * | eloquent.updated
 * | eloquent.creating
 * | eloquent.created
 * | eloquent.restoring
 * | eloquent.restored
 * |
 * | kernel.handled
 * | locale.changed
 */
namespace Gamer;

use App;
use Config;
use Gamer\Facades\Gamer as GamerFacade;
use Gamer\Services\GamerService;
use Illuminate\Foundation\AliasLoader;

use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use Log;

use Muleta\Traits\Providers\ConsoleTools;
use Route;

class GamerProvider extends ServiceProvider
{
    use ConsoleTools;

    public $packageName = 'gamer';
    const pathVendor = 'sierratecnologia/gamer';

    public static $aliasProviders = [
        'Gamer' => \Gamer\Facades\Gamer::class,
    ];

    public static $providers = [
        \Tracking\TrackingProvider::class,
        \Finder\FinderProvider::class,
        \Spatie\EventSourcing\EventSourcingServiceProvider::class,
    ];

    /**
     * Rotas do Menu
     */
    public static $menuItens = [
        [
            'text'        => 'Meus Pontos',
            'route'       => 'profile.gamer.home',
            'icon'        => 'fas fa-fw fa-gamepad',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            'section' => "profile",
            'feature' => 'gamer',
            'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
            'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
            // 'access' => \Porteiro\Models\Role::$ADMIN
        ],
        [
            'text' => 'Gamificação',
            'icon' => 'fas fa-fw fa-search',
            'icon_color' => "blue",
            'label_color' => "success",
            'section'   => 'admin',
            'feature' => 'gamer',
            'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
            'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
        ],
        'Gamificação' => [
            [
                'text'        => 'Tipos de Pontos',
                'route'       => 'rica.gamer.pointTypes.index',
                'icon'        => 'fas fa-fw fa-gamepad',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                'section' => "admin",
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Challenges (Competições)',
                'route'       => 'rica.gamer.competitions.index',
                'icon'        => 'fas fa-fw fa-flag',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                'section' => "admin",
                'feature' => 'gamer',
                'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Score de Pontos',
                'route'       => 'profile.gamer.home',
                'icon'        => 'fas fa-fw fa-gamepad',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                'section' => "admin",
                'feature' => 'gamer',
                'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Badges (Metalhas)',
                'route'       => 'rica.gamer.home',
                'icon'        => 'fas fa-fw fa-flag',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                'section' => "admin",
                'feature' => 'gamer',
                'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
            [
                'text'        => 'Guests (Desafios)',
                'route'       => 'rica.gamer.home',
                'icon'        => 'fas fa-fw fa-flag',
                'icon_color'  => 'blue',
                'label_color' => 'success',
                'section' => "admin",
                'feature' => 'gamer',
                'dev_status'  => 2, // 0 (Desabilitado), 1 (Ativo), 2 (Em Dev)
                'level'       => 2, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                // 'access' => \Porteiro\Models\Role::$ADMIN
            ],
        ],
    ];

    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        
        // Register configs, migrations, etc
        $this->registerDirectories();

        // COloquei no register pq nao tava reconhecendo as rotas para o adminlte
        $this->app->booted(function () {
            $this->routes();
        });

        //
        $this->app['events']->listen(
            'eloquent.*',
            'Gamer\Observers\ModelCallbacks'
        );
        $this->app['events']->listen(
            'Illuminate\Auth\Events\Login',
            'Gamer\Observers\LoginObserver'
        );
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        /**
         * Transmissor; Routes
         */
        $this->loadRoutesForRiCa(__DIR__.'/../routes');
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../publishes/config/gamer.php', 'gamer');
        // $this->mergeConfigFrom(__DIR__.'/../publishes/config/horizon.php', 'horizon');
        // $this->mergeConfigFrom(__DIR__.'/../publishes/config/event-sourcing.php', 'event-sourcing');
        

        $this->setProviders();
        // $this->routes();



        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $loader = AliasLoader::getInstance();
        $loader->alias('Gamer', GamerFacade::class);

        $this->app->singleton(
            'gamer', function () {
                return new Gamer();
            }
        );
        
        /*
        |--------------------------------------------------------------------------
        | Register the Utilities
        |--------------------------------------------------------------------------
        */
        /**
         * Singleton Gamer
         */
        $this->app->singleton(
            GamerService::class, function ($app) {
                Log::info('Singleton Gamer');
                return new GamerService(\Illuminate\Support\Facades\Config::get('sitec.gamer'));
            }
        );

        // Register commands
        $this->registerCommandFolders(
            [
            base_path('vendor/sierratecnologia/gamer/src/Console/Commands') => '\Gamer\Console\Commands',
            ]
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'gamer',
        ];
    }

    /**
     * Register configs, migrations, etc
     *
     * @return void
     */
    public function registerDirectories()
    {

        $this->publishConfig();
        $this->publishMigration();

        // // Publish gamer css and js to public directory
        // $this->publishes([
        //     $this->getDistPath('gamer') => public_path('assets/gamer')
        // ], ['public',  'sitec', 'sitec-public']);

        $this->loadViews();
        $this->loadTranslations();
    }

    /**
     * Publish Gamer configuration.
     */
    protected function publishConfig()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../publishes/config/gamer.php' => config_path('gamer.php'),
            __DIR__.'/../publishes/config/event-sourcing.php' => config_path('event-sourcing.php'),
            __DIR__.'/../publishes/config/horizon.php' => config_path('horizon.php'),
        ], ['config', 'gamer', 'gamer-config', 'rica', 'rica-config']);
    }

    /**
     * Publish Gamer migration.
     */
    protected function publishMigration()
    {
        $this->publishes(
            [
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], ['migrations', 'gamer', 'gamer-migrations', 'rica', 'rica-migrations']
        );
        // @todo
        // if (! class_exists('GamerSetupTables')) {
        //     // Publish the migration
        //     $timestamp = date('Y_m_d_His', time());
        //     $this->publishes([
        //         __DIR__.'/../database/migrations/2016_05_18_000000_tecnico_setup_tables.php' => database_path('migrations/'.$timestamp.'_tecnico_setup_tables.php'),
        //       ],, ['migrations', 'gamer', 'gamer-migrations', 'rica', 'rica-migrations']);
        // }
    }

    private function loadViews()
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'gamer');
        $this->publishes(
            [
            $viewsPath => base_path('resources/views/vendor/gamer'),
            ], ['views', 'gamer', 'gamer-views', 'rica', 'rica-views']
        );
    }
    
    private function loadTranslations()
    {
        // Publish lanaguage files
        $this->publishes(
            [
            $this->getResourcesPath('lang') => resource_path('lang/vendor/gamer')
            ], ['lang', 'gamer', 'gamer-lang', 'rica', 'rica-lang', 'translations']
        );

        // Load translations
        $this->loadTranslationsFrom($this->getResourcesPath('lang'), 'gamer');
    }
}
