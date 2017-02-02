<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 2/02/17
 * Time: 21:23
 */

namespace scool\enrollment_payments\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use scool\enrollment_payments\Model\Payment;
use scool\enrollment_payments\Validators\PaymentValidator;
use scool\enrollment_payments\Validators\StudyValidator;


class PaymentRepositoryEloquent extends BaseRepository implements PaymentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Payment::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return PaymentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}