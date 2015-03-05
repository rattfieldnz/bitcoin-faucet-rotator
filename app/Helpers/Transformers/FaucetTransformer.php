<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 05-Mar-2015
 * Time: 13:39
 */

namespace Helpers\Transformers;

/**
 * Class FaucetTransformer
 * This class is responsible for showing faucet
 * related data in a specified format.
 * @package Helpers\Transformers
 */
class FaucetTransformer extends Transformer{

    /**
     * The method which transforms the faucet
     * related data.
     * @param $faucet
     * @return array
     */
    public function transform($faucet)
    {
        return [
            'id' => (int)$faucet['id'],
            'name' => $faucet['name'],
            'url' => $faucet['url'],
            'interval_minutes' => (int)$faucet['interval_minutes'],
            'min_payout' => (int)$faucet['min_payout'],
            'max_payout' => (int)$faucet['max_payout'],
            'has_ref_program' => (boolean)$faucet['has_ref_program'],
            'ref_payout_percent' => (double)$faucet['ref_payout_percent'],
            'comments' => $faucet['comments'],
            'is_paused' => (boolean)$faucet['is_paused']
        ];
    }
}