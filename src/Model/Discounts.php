<?php

namespace scool\enrollment_payments\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Discounts extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'discount_id', 'discountable_type', 'discount'
    ];



}
