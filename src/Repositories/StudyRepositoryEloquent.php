<?php

namespace scool\enrollment_payments\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use scool\enrollment_payments\Repositories\StudyRepository;
use scool\enrollment_payments\Validators\StudyValidator;
use scool\enrollment_payments\Model\Study;

/**
 * Class StudyRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StudyRepositoryEloquent extends BaseRepository implements StudyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Study::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
