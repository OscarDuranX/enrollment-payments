<?php

namespace scool\enrollment_payments\Presenters;

use scool\enrollment_payments\Transformers\DiscountsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DiscountsPresenter
 *
 * @package namespace scool\enrollment_payments\Presenters;
 */
class DiscountsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DiscountsTransformer();
    }
}
