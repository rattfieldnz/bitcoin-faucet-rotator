<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 23-Oct-2015
 * Time: 23:40
 */

namespace Helpers\Validators;
use Illuminate\Validation\Validator;

class FacebookConfigValidator extends Validator
{
    /**
     * Validates new twitter config entries.
     * @return array
     */
    public static function validationRules()
    {
        return [
            'app_id' => 'max:255',
            'app_secret' => 'max:255',
            'access_token' => 'max:255',
            'facebook_id' => 'max:255',
            'user_id' => 'required|integer'
        ];
    }
}