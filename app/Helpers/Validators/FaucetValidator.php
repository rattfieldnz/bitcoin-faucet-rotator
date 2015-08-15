<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 11-Mar-2015
 * Time: 15:25
 */

namespace Helpers\Validators;


use App\Faucet;
use Illuminate\Validation\Validator;

/**
 * Class FaucetValidator
 *
 * This class is used to validate faucet
 * entries and updates.
 * @package Helpers\Validators
 */
class FaucetValidator extends Validator{

    /**
     * Validates new faucet entries.
     * @return array
     */
    public static function validationRulesNew()
    {
        return [
            'name' => 'required|unique:faucets,name|min:5',
            'url' => 'required|url|active_url|unique:faucets,url',
            'interval_minutes' => 'required|integer',
            'min_payout' => 'required|numeric',
            'max_payout' => 'required|numeric',
            'faucet_payment_processors[]' => 'each:exists,faucet_payment_processors, id',
            'has_ref_program' => 'required|boolean',
            'ref_payout_percent' => 'required|numeric|min:0',
            'comments' => 'text',
            'is_paused' => 'required|boolean',
            'meta_title' => 'string|max:70',
            'meta_description'  => 'string|max:160',
            'meta_keywords' => 'string|max:255'
        ];
    }

    /**
     * Validates updates to a faucet.
     * I.D is used so unchanged unique attributes can
     * still be submitted without any duplication
     * errors.
     *
     * @param $faucet_id
     * @return array
     */
    public static function validationRulesEdit($faucet_id)
    {
        return [
                'name' => 'required|unique:faucets,name, ' . $faucet_id . '|min:5',
                'url' => 'required|unique:faucets,url, ' . $faucet_id,
                'interval_minutes' => 'required|integer',
                'min_payout' => 'required|numeric',
                'max_payout' => 'required|numeric',
                'faucet_payment_processors[]' => 'each:exists,faucet_payment_processors, id',
                'has_ref_program' => 'required|boolean',
                'ref_payout_percent' => 'required|numeric|min:0',
                'comments' => 'text',
                'is_paused' => 'required|boolean',
                'meta_title' => 'string|max:70',
                'meta_description'  => 'string|max:160',
                'meta_keywords' => 'string|max:255',
        ];
    }
}