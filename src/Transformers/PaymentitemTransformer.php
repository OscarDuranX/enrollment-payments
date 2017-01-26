<?php

namespace scool\enrollment_payments\Transformers;

use League\Fractal\TransformerAbstract;
use scool\enrollment_payments\Model\Paymentitem;

/**
 * Class PaymentitemTransformer
 * @package namespace scool\enrollment_payments\Transformers;
 */
class PaymentitemTransformer extends TransformerAbstract
{

    /**
     * Transform the \Paymentitem entity
     * @param \Paymentitem $model
     *
     * @return array
     */
    public function transform(Paymentitem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
