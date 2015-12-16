<?php namespace Helpers\Transformers;

/**
 * Class PaymentProcessorTransformer
 * This class is responsible for showing
 * payment processor related data in
 * a specified format.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package Helpers\Transformers
 */
class PaymentProcessorTransformer extends Transformer
{

    /**
     * The method which transforms the
     * payment processor related data.
     * @param $paymentProcessor
     * @return array
     */
    public function transform($paymentProcessor)
    {
        return [
            'id' => (int)$paymentProcessor['id'],
            'name' => $paymentProcessor['name'],
            'url' => $paymentProcessor['url']
        ];
    }
}
