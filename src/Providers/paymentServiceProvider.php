<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 10/11/16
 * Time: 20:59
 */

namespace CreditSintesi\enrollment_payments\Providers;


use Illuminate\Support\ServiceProvider;

class paymentServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrations();
        $this->publishFactories();

    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'../../database/migrations');
    }

    private function publishFactories()
    {
        $this->publishes(
            [
                __DIR__.'/../../database/factories/PaymentFactory.php' =>
                    database_path() . '/factories/PaymentFactory'
            ],"CreditSintesi_enrollment_payments"
        );
    }

}