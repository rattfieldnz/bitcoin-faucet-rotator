<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 05-Mar-2015
 * Time: 15:37
 */

namespace Helpers\Transformers;

class PaymentProcessorTransformer extends Transformer{

    public function transform($payment_processor)
    {
        return [
            'id' => (int)$payment_processor['id'],
            'name' => $payment_processor['name'],
            'url' => $payment_processor['url']
        ];
    }
}