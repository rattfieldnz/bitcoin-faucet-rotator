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
            'name' => 'required|unique:faucets,name|min:3',
            'url' => 'required|unique:faucets,url',
        ];
    }

    /**
     * Validates updates to a payment processor.
     * I.D is used so unchanged unique attributes can
     * still be submitted without any duplication
     * errors.
     *
     * @param $faucet_id
     * @return array
     */
    public static function validationRulesEdit($payment_processor_id)
    {
        return [
            'name' => 'required|unique:faucets,name, ' . $payment_processor_id . '|min:3',
            'url' => 'required|unique:faucets,url, ' . $payment_processor_id
        ];
    }
}