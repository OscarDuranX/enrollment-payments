<?php

namespace scool\enrollment_payments\Model;

use Acacha\Names\Traits\Nameable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Study extends Model implements Transformable
{
    use Nameable,TransformableTrait;

    protected $fillable = ['name'];

}
