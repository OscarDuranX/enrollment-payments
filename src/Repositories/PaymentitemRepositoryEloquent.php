<?php

namespace scool\enrollment_payments\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use scool\enrollment_payments\Repositories\PaymentitemRepository;
use scool\enrollment_payments\Model\Paymentitem;
use scool\enrollment_payments\Validators\PaymentitemValidator;

/**
 * Class PaymentitemRepositoryEloquent
 * @package namespace scool\enrollment_payments\Repositories;
 */
class PaymentitemRepositoryEloquent extends BaseRepository implements PaymentitemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Paymentitem::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PaymentitemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
