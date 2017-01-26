<?php

namespace scool\enrollment_payments\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use scool\enrollment_payments\Repositories\discountsRepository;
use scool\enrollment_payments\Model\Discounts;
use scool\enrollment_payments\Validators\DiscountsValidator;

/**
 * Class DiscountsRepositoryEloquent
 * @package namespace scool\enrollment_payments\Repositories;
 */
class DiscountsRepositoryEloquent extends BaseRepository implements DiscountsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Discounts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DiscountsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
