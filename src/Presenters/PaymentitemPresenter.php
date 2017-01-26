<?php

namespace scool\enrollment_payments\Presenters;

use scool\enrollment_payments\Transformers\PaymentitemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentitemPresenter
 *
 * @package namespace scool\enrollment_payments\Presenters;
 */
class PaymentitemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaymentitemTransformer();
    }
}
