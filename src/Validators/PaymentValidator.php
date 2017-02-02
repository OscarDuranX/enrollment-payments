<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 2/02/17
 * Time: 21:28
 */

namespace scool\enrollment_payments\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PaymentValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}