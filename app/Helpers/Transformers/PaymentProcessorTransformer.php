<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 05-Mar-2015
 * Time: 15:37
 */

namespace Helpers\Transformers;

/**
 * Class PaymentProcessorTransformer
 * This class is responsible for showing
 * payment processor related data in
 * a specified format.
 * @package Helpers\Transformers
 */
class PaymentProcessorTransformer extends Transformer{

    /**
     * The method which transforms the
     * payment processor related data.
     * @param $payment_processor
     * @return array
     */
    public function transform($payment_processor)
    {
        return [
            'id' => (int)$payment_processor['id'],
            'name' => $payment_processor['name'],
            'url' => $payment_processor['url']
        ];
    }
}