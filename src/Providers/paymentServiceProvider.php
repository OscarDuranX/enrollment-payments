<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 10/11/16
 * Time: 20:59
 */

namespace scool\enrollment_payments\Providers;


use Illuminate\Support\ServiceProvider;

class paymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        if(!defined('SCOOL_PAYMENT_PATH')){
            define('SCOOL_PAYMENT_PATH', realpath(__DIR__.'/../../'));
        }
    }

    public function boot()
    {
        $this->loadMigrations();
        $this->publishFactories();
        $this->publishTests();

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

}