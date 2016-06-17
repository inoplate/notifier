<?php

namespace Inoplate\Notifier\Laravel;

use InvalidArgumentException;
use Illuminate\Contracts\Foundation\Application;

class NotifierFactory
{
    /**
     * @var Illuminate\Contracts\Foundation\Application
     */
    protected $app;
    /**
     * @var array
     */
    protected $drivers = [];

    /**
     * @var array
     */
    protected $customCreators = [];

    /**
     * Create new NotifierFactory instace
     * 
     * @param Application $app
     * */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get a Challange instance
     * 
     * @param  string $driver
     * @return Challange
     */
    public function drive($driver)
    {
        if(isset($this->drivers[$driver])) {
            return $this->drivers[$driver];
        }else {
            return $this->drivers[$driver] = $this->resolve($driver);
        }
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string    $driver
     * @param  \Closure  $callback
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * Create new Database notifier instance
     * @return Inoplate\Notifier\DatabaseNotifier
     */
    protected function createDatabaseNotifier()
    {
        return $this->app->make('Inoplate\Notifier\DatabaseNotifier');
    }

    /**
     * Resolve driver
     * 
     * @param  string $drive
     * @return Notifier
     */
    protected function resolve($driver)
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator();
        }

        $driverMethod = 'create'.ucfirst($driver).'Notifier';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}();
        } else {
            throw new InvalidArgumentException("Driver [{$driver}] is not supported.");
        }
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string  $driver
     * @return Notifier
     */
    protected function callCustomCreator($driver)
    {
        return $this->customCreators[$driver]($this->app);
    }
}