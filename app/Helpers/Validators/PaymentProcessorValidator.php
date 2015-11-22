<?php namespace Helpers\Validators;

use App\PaymentProcessor;
use Illuminate\Validation\Validator;

/**
 * Class FaucetValidator
 *
 * This class is used to validate faucet
 * entries and updates.
 * @package Helpers\Validators
 */
class PaymentProcessorValidator extends Validator
{

    /**
     * Validates new payment processor entries.
     * @return array
     */
    public static function validationRulesNew()
    {
        return [
            'name' => 'required|unique:payment_processors,name|min:3',
            'url' => 'required|url|active_url|unique:payment_processors,url',
            'meta_title' => 'string|max:70',
            'meta_description' => 'string|max:160',
            'meta_keywords' => 'string|max:255'
        ];
    }

    /**
     * Validates updates to a payment processor.
     * I.D is used so unchanged unique attributes can
     * still be submitted without any duplication
     * errors.
     *
     * @param $paymentProcessorId
     * @return array
     */
    public static function validationRulesEdit($paymentProcessorId)
    {
        return [
            'name' => 'required|unique:payment_processors,name,' . $paymentProcessorId . '|min:3',
            'url' => 'required|url|active_url|unique:payment_processors,url,' . $paymentProcessorId,
            'meta_title' => 'string|max:70|unique:payment_processors,meta_title,' . $paymentProcessorId,
            'meta_description' => 'string|max:160|unique:payment_processors,meta_description,' . $paymentProcessorId,
            'meta_keywords' => 'string|max:255|unique:payment_processors,meta_keywords,' . $paymentProcessorId,
        ];
    }
}
