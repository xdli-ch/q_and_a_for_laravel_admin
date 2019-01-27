<?php

namespace Xdli\Q_And_A;

use Illuminate\Support\ServiceProvider;

class Q_And_AServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $commands = [
        Console\InstallCommand::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function boot(Q_And_A $extension)
    {
        if (! Q_And_A::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'q_and_a');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/q_and_a')],
                'q_and_a'
            );
        }

        $this->publishes([__DIR__.'/../config' => config_path()], 'q_and_a');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/q_and_a')],'q_and_a');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'q_and_a');

        $this->app->booted(function () {
            Q_And_A::routes(__DIR__.'/../routes/web.php');
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}