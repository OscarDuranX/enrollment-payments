<?php
namespace scool\enrollment_payments;


class ScoolPayment
{
    public static function factories()
    {
        return [
            SCOOL_PAYMENT_PATH . '/database/factories/DiscountsFactory.php' =>
                database_path('/factories/DiscountsFactory.php'),
            SCOOL_PAYMENT_PATH . '/database/factories/PaymentFactory.php' =>
                database_path('/factories/PaymentFactory.php'),
            SCOOL_PAYMENT_PATH . '/database/factories/PaymentitemsFactory.php' =>
                database_path('/factories/PaymentitemsFactory.php'),
        ];
    }

    public static function configs()
    {
        return [
            SCOOL_PAYMENT_PATH . '/config/enrollmentpayments.php' =>
                config_path('enrollmentpayments.php'),
        ];
    }

}