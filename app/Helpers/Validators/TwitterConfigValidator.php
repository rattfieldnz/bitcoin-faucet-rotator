<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 16-Aug-2015
 * Time: 23:00
 */

namespace Helpers\Validators;


use Illuminate\Validation\Validator;

class TwitterConfigValidator extends Validator
{

    /**
     * Validates new twitter config entries.
     * @return array
     */
    public static function validationRulesNew()
    {
        return [
            'consumer_key' => 'required|unique:twitter_config,consumer_key|max:255',
            'consumer_key_secret' => 'required|unique:twitter_config,consumer_key_secret|max:255',
            'access_token' => 'required|unique:twitter_config,access_token|max:255',
            'access_token_secret' => 'required|unique:twitter_config,access_token_secret|max:255',
            'user_id' => 'required|integer'
        ];
    }

    /**
     * Validates new twitter config entries.
     * @param $user_id
     * @return array
     */
    public static function validationRulesEdit($user_id)
    {
        return [
            'consumer_key' => 'required|unique:twitter_config,consumer_key,' . $user_id . '|max:255',
            'consumer_key_secret' => 'required|unique:twitter_config,consumer_key_secret,' . $user_id . '|max:255',
            'access_token' => 'required|unique:twitter_config,access_token,' . $user_id . '|max:255',
            'access_token_secret' => 'required|unique:twitter_config,access_token_secret,' . $user_id . '|max:255',
            'user_id' => 'required|integer'
        ];
    }
}