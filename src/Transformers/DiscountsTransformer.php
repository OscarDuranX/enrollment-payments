<?php

namespace scool\enrollment_payments\Transformers;

use League\Fractal\TransformerAbstract;
use scool\enrollment_payments\Model\Discounts;

/**
 * Class DiscountsTransformer
 * @package namespace scool\enrollment_payments\Transformers;
 */
class DiscountsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Discounts entity
     * @param \Discounts $model
     *
     * @return array
     */
    public function transform(Discounts $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
