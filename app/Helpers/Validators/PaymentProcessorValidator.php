<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 11-Mar-2015
 * Time: 15:25
 */

namespace Helpers\Validators;


use App\PaymentProcessor;
use Illuminate\Validation\Validator;

/**
 * Class FaucetValidator
 *
 * This class is used to validate faucet
 * entries and updates.
 * @package Helpers\Validators
 */
class PaymentProcessorValidator extends Validator{

    /**
     * Validates new payment processor entries.
     * @return array
     */
    public static function validationRulesNew()
    {
        return [
            'name' => 'required|unique:payment_processors,name|min:3',
            'url' => 'required|url|active_url|unique:payment_processors,url',
            'meta_title' => 'string|max:70|unique:payment_processors,meta_title',
            'meta_description' => 'string|max:160|unique:payment_processors,meta_description',
            'meta_keywords' => 'string|max:255|unique:payment_processors,meta_keywords'
        ];
    }

    /**
     * Validates updates to a payment processor.
     * I.D is used so unchanged unique attributes can
     * still be submitted without any duplication
     * errors.
     *
     * @param $payment_processor_id
     * @return array
     */
    public static function validationRulesEdit($payment_processor_id)
    {
        return [
            'name' => 'required|unique:payment_processors,name,' . $payment_processor_id . '|min:3',
            'url' => 'required|url|active_url|unique:payment_processors,url,' . $payment_processor_id,
            'meta_title' => 'string|max:70|unique:payment_processors,meta_title,' . $payment_processor_id,
            'meta_description' => 'string|max:160|unique:payment_processors,meta_description,' . $payment_processor_id,
            'meta_keywords' => 'string|max:255|unique:payment_processors,meta_keywords,' . $payment_processor_id,
        ];
    }
}