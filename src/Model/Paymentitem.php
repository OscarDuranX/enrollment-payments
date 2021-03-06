<?php

namespace scool\enrollment_payments\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Paymentitem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'paymentitems_id','name','unitats','preu'
    ];

    public function Payment()
    {
        return $this->belongsTo('App\Payment');
    }

}
