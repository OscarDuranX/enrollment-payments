<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 10/11/16
 * Time: 20:59
 */

namespace scool\enrollment_payments\Providers;


use Acacha\Names\Providers\NamesServiceProvider;
use Illuminate\Support\ServiceProvider;
use scool\enrollment_payments;

class paymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        if(!defined('SCOOL_PAYMENT_PATH')){
            define('SCOOL_PAYMENT_PATH', realpath(__DIR__.'/../../'));
        }

        $this->bindRepositories();


    }

    public function boot()
    {
        $this->defineRoutes();
        $this->loadMigrations();
        $this->publishConfig();
        $this->publishFactories();
        $this->publishTests();
        $this->registerNamesServiceProvider();
    }

    /**
     * Bind repositories
     */
    protected function bindRepositories()
    {
        $this->app->bind(
            \scool\enrollment_payments\Repositories\StudyRepository::class,
            \scool\enrollment_payments\Repositories\StudyRepositoryEloquent::class);
        $this->app->bind(\scool\enrollment_payments\Repositories\ProvaRepository::class, \scool\enrollment_payments\Repositories\ProvaRepositoryEloquent::class);
        //:end-bindings:
    }

    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');
            $router->group(['namespace' => 'scool\enrollment_payments\Http\Controllers'], function () {
                require __DIR__.'/../Http/routes.php';
            });
        }
    }

    private function publishConfig() {
        $this->publishes(
            ScoolCurriculum::configs(),"scool_curriculum"
        );
        $this->mergeConfigFrom(
            SCOOL_PAYMENT_PATH . '/config/curriculum.php', 'scool_curriculum'
        );
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(SCOOL_PAYMENT_PATH.'/database/migrations');
    }

    private function publishFactories()
    {
        $this->publishes(
            [
                __DIR__.'/../../database/factories/PaymentFactory.php' =>
                    database_path() . '/factories/PaymentFactory'
            ],"enrollment_payments"
        );
    }

    public function publishTests()
    {
        $this->publishes([
           [SCOOL_PAYMENT_PATH.'/tests/MisTestosTest.php' , 'tests/MisTestosTest.php'] .
           'scool_payment'
        ]);
    }

    public function registerNamesServiceProvider()
    {
        $this->app->register(NamesServiceProvider::class);
    }

}