<?php

namespace Inoplate\Notifier\Laravel;

use Illuminate\Support\ServiceProvider;
use Inoplate\Notifier\Laravel\NotifierFactory;

class NotifierServiceProvider extends ServiceProvider
{
    /**
     * Boot package
     * 
     * @return void
     */
    public function boot()
    {
        $this->loadMigration();   
    }

    /**
     * Register package
     * 
     * @return void
     */
    public function register()
    {
        $this->app->bind('Inoplate\Notifier\NotifRepository', 
            'Inoplate\Notifier\Laravel\EloquentNotif');

        $this->app->singleton('notifier.factory', function ($app) {
            return new NotifierFactory($app);
        });
    }

    /**
     * Load packages migration
     * 
     * @return void
     */
    protected function loadMigration()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}