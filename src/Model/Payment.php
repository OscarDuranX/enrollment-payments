<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 10/11/16
 * Time: 21:23
 */

namespace scool\enrollment_payments\Model;


use Acacha\Names\Traits\Nameable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Nameable;

    protected $fillable = [
        'payable_id', 'payable_type', 'user_id', 'cantidad',
    ];

    public function Paymentitem()
    {
        return $this->hasMany('App\Paymentitem', 'foreign_key');
    }

}